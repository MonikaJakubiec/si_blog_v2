<?php
$errors = [];
$articleToEdit = null;
require_once(_ACTIONS_PATH . 'add-picture.php');
require_once(_CLASSES_PATH . 'CreateArticleRequest.php');
require_once(_REPOSITORIES_PATH . 'ArticleRepository.php');

$articleTitle = $articleContent = '';

//post z form przy kliknieciu zaktualizuj lub publikuj
if(isset($_POST['title'])) {
    if(isset($_POST['edit-article']) && $_POST['edit-article'] != '') {
        $articleToEdit = (new ArticleRepository)->getArticleById($_POST['edit-article'])['article'];   
    }
    switch($_POST['picture-id']) {
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

    validateArticle($errors, $pictureId, $articleToEdit);
    //edit article - post
}
else {
    //edycja artykulu
    if(isset($_GET['edit-article'])) {
        $articleToEdit = (new ArticleRepository)->getArticleById($_GET['edit-article'])['article'];
        setArticleDataForView($articleTitle ,$articleToEdit->getTitle(), $articleContent, $articleToEdit->getContent(), $articleToEdit->isFeatured(), $articleToEdit->getPhotoId(), $articleToEdit->getStatus());
    }

    //nowy artykul
}

function validateArticle(&$errors, $pictureId, $articleToEdit) {
    $isDataCorrect = true;

    $title = testInput($_POST['title']);
    $content = testInput($_POST['content']);
    $featured = isset($_POST['featured']);
    //setArticleDataForView($articleTitle, $title, $articleContent, $content, $featured, $pictureId, null);

    $isPublishButtonClicked = isset($_POST['publish-button']);

    if($title == '') {
        $isDataCorrect = false;
        $errors['title'] = "Należy uzupełnić pole tytuł";
    }

    if(count($errors) > 0) {
        $isDataCorrect = false;
    }

    if($articleToEdit == null) {
        $status = $isPublishButtonClicked ? "published" : "draft";
    }
    else {
        if($isPublishButtonClicked) {
            if($articleToEdit->getStatus() == "published") {
                $status = "draft";
            }
            else {
                $status = "published";
            }
        }
        else {
            $status = $articleToEdit->getStatus();
        }
    }

    if($isDataCorrect) {
        if($articleToEdit == null) {
            if($pictureId != null) {
                $createArticleRequest = CreateArticleRequest::createWithPhoto($title, $content, time(), $status, $featured, 0, $pictureId);
                (new ArticleRepository)->saveArticleFromRequest($createArticleRequest);
            }
            else {
                $createArticleRequest = CreateArticleRequest::createWithoutPhoto($title, $content, time(), $status, $featured, 0);
                (new ArticleRepository)->saveArticleFromRequest($createArticleRequest);
            }
        }
        else {
            $articleToEdit->setTitle($title);
            $articleToEdit->setContent($content);
            $articleToEdit->setFeatured($featured);
            $articleToEdit->setPhotoId($pictureId);
            $articleToEdit->setStatus($status);
            (new ArticleRepository)->updateArticle($articleToEdit);
        }
        switch($status) {
            case 'draft':
                addAlert("Artykuł został zapisany jako wersja robocza.","success");
                break;
            case 'published':
                echo "addAlert";
                addAlert('Artykuł został opublikowany na blogu.',"success");
                break;
        }   
        header("Location: " . _RHOME . "admin-panel/");
        exit(); 
    }
}

/**
 * konwersja tekstu na postać bezpieczna do wstawienia do bazy sql
 */
function testInput($data) { 
    $data = stripslashes($data); //zabezpieczenia cudzysłowów
    $data = htmlspecialchars($data); //konwersja znaków specjalnych HTML do encji HTML
    return $data;
  }

  function setArticleDataForView($articleTitle, $title, $articleContent, $content, $isFeatured, $pictureId, $status) {
    $articleTitle = $title;
    $_SESSION['content'] = $content;
    $_SESSION['featured'] = $isFeatured;
    $_SESSION['picture-id'] = $pictureId;
    $_SESSION['status'] = $status;
  }