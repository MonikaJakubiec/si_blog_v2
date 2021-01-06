<?php
$errors = [];

require_once(_ACTIONS_PATH . 'add-picture.php');
require_once(_CLASSES_PATH . 'CreateArticleRequest.php');
require_once(_REPOSITORIES_PATH . 'ArticleRepository.php');

$publishButtonText = "Publikuj";
$updateButtonText = "Zaktulizuj";
$unpublishButtonText = "Cofnij publikację";

$publishButtonTextToDisplay = $publishButtonText;

$isArticlePublished = false;
$articleToView = $articleToEdit = null;

//artykul przeslany postem z formularza przy kliknieciu zaktualizuj lub publikuj
if (isset($_POST['title'])) {
    if (isset($_POST['edit-article']) && $_POST['edit-article'] != '') {
        $articleToEdit = (new ArticleRepository)->getArticleById($_POST['edit-article'])['article'];
        $isArticlePublished = $articleToEdit->getStatus() == 'published';
    }
    switch ($_POST['picture-id']) {
        case 'picture-from-file':
            $pictureId = validatePicture($errors);
            break;

        case 'without-picture':
            $pictureId = null;
            break;

        default:
            $pictureId = $_POST['picture-id'];
            break;
    }

    $title = testInput($_POST['title']);
    $content = testInput($_POST['content']);
    $featured = isset($_POST['featured']);

    $articleToView = new Article(null, $title, $content, null, null, $featured, null, $pictureId);

    if (isset($_POST['publish-button'])) {
        $status = $isArticlePublished ? 'draft' : 'published';
    } else {
        $status = $articleToEdit->getStatus();
    }

    if ($title == '') {
        $errors['title'] = "Należy uzupełnić pole tytuł";
    }

    if (count($errors) == 0) {
        if ($articleToEdit == null) {
            if ($pictureId != null) {
                $createArticleRequest = CreateArticleRequest::createWithPhoto($title, $content, time(), $status, $featured, 0, $pictureId);
                (new ArticleRepository)->saveArticleFromRequest($createArticleRequest);
            } else {
                $createArticleRequest = CreateArticleRequest::createWithoutPhoto($title, $content, time(), $status, $featured, 0);
                (new ArticleRepository)->saveArticleFromRequest($createArticleRequest);
            }
        } else {
            $articleToEdit->setTitle($title);
            $articleToEdit->setContent($content);
            $articleToEdit->setFeatured($featured);
            $articleToEdit->setPhotoId($pictureId);
            $articleToEdit->setStatus($status);
            (new ArticleRepository)->updateArticle($articleToEdit);
        }
        switch ($status) {
            case 'draft':
                addAlert("Artykuł został zapisany jako wersja robocza.", "success");
                break;
            case 'published':
                echo "addAlert";
                addAlert('Artykuł został opublikowany na blogu.', "success");
                break;
        }
        header("Location: " . _RHOME . "admin-panel/");
        exit();
    }

} else {
    //edycja artykulu
    if (isset($_GET['edit-article'])) {
        $articleToEdit = (new ArticleRepository)->getArticleById($_GET['edit-article'])['article'];
        $articleToView = $articleToEdit;
        $isArticlePublished = $articleToEdit->getStatus() == 'published';
        if ($isArticlePublished) $publishButtonTextToDisplay = $unpublishButtonText;
        else $publishButtonTextToDisplay = $publishButtonText;
    }
    else {
        //dodanie nowego artykulu
        $articleToView = new Article(null, null, null, null, null, null, null, null);
    }
}

/**
 * konwersja tekstu na postać bezpieczna do wstawienia do bazy sql
 */
function testInput($data)
{
    $data = stripslashes($data); //zabezpieczenia cudzysłowów
    $data = htmlspecialchars($data); //konwersja znaków specjalnych HTML do encji HTML
    return $data;
}
