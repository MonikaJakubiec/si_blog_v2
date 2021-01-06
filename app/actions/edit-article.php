<?php
$errors = [];

require_once(_ACTIONS_PATH . 'add-picture.php');
require_once(_CLASSES_PATH . 'CreateArticleRequest.php');
require_once(_REPOSITORIES_PATH . 'ArticleRepository.php');

$publishButtonText = "Publikuj";
$unpublishButtonText = "Cofnij publikację";
$updateButtonText = "Zaktualizuj";
$saveButtonText = "Zapisz";

$publishButtonTextToDisplay = $publishButtonText;
$saveButtonTextToDisplay = $saveButtonText;

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

    $publishTime = time();
    $status = 'draft';

    $publishButtonClicked = isset($_POST['publish-button']);
    $saveButtonClicked = isset($_POST['save-button']);

    if ($publishButtonClicked) {
        $status = $isArticlePublished ? 'draft' : 'published';
    }    

    if($saveButtonClicked || $isArticlePublished) {
        $publishTime = null;
    }

    if ($title == '') {
        $errors['title'] = "Należy uzupełnić pole tytuł";
    }

    if (count($errors) == 0) {
        if ($articleToEdit == null) {
            if ($pictureId != null) {
                $createArticleRequest = CreateArticleRequest::createWithPhoto($title, $content, $publishTime, $status, $featured, 0, $pictureId);
                (new ArticleRepository)->saveArticleFromRequest($createArticleRequest);
            } else {
                $createArticleRequest = CreateArticleRequest::createWithoutPhoto($title, $content, $publishTime, $status, $featured, 0);
                (new ArticleRepository)->saveArticleFromRequest($createArticleRequest);
            }
        } else {
            $articleToEdit->setTitle($title);
            $articleToEdit->setContent($content);
            $articleToEdit->setFeatured($featured);
            $articleToEdit->setPhotoId($pictureId);

            if($publishButtonClicked) {
                $articleToEdit->setPublishedTimestamp($publishTime);
            }

            if($articleToEdit == null || !$saveButtonClicked)
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
        $publishButtonTextToDisplay = $isArticlePublished ? $unpublishButtonText : $publishButtonText;
        $saveButtonTextToDisplay = $updateButtonText;
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
