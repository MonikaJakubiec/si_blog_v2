<?php
$errors = [];
$articleToEdit = null;
require_once(_ACTIONS_PATH . 'add-picture.php');
require_once(_CLASSES_PATH . 'CreateArticleRequest.php');
require_once(_REPOSITORIES_PATH . 'ArticleRepository.php');

//post z form
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
}
else {
    if(isset($_GET['edit-article'])) {
        $articleToEdit = (new ArticleRepository)->getArticleById($_GET['edit-article'])['article'];
        saveArticleDataToSession($articleToEdit->getTitle(), $articleToEdit->getContent(), $articleToEdit->isFeatured(), $articleToEdit->getPhotoId(), $articleToEdit->getStatus());
    }
}

function validateArticle(&$errors, $pictureId, $articleToEdit) {
    $isDataCorrect = true;

    $articleTitle = testInput($_POST['title']);
    $articleContent = testInput($_POST['content']);
    $isArticleFeatured = isset($_POST['featured']);
    saveArticleDataToSession($articleTitle, $articleContent, $isArticleFeatured, $pictureId, null);

    $isPublishButtonClicked = isset($_POST['publish-button']);

    if($articleTitle == '') {
        $isDataCorrect = false;
        $errors['title'] = "Należy uzupełnić pole tytuł";
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
                $createArticleRequest = CreateArticleRequest::createWithPhoto($articleTitle, $articleContent, time(), $status, $isArticleFeatured, 0, $pictureId);
                (new ArticleRepository)->saveArticleFromRequest($createArticleRequest);
            }
            else {
                $createArticleRequest = CreateArticleRequest::createWithoutPhoto($articleTitle, $articleContent, time(), $status, $isArticleFeatured, 0);
                (new ArticleRepository)->saveArticleFromRequest($createArticleRequest);
            }
        }
        else {
            $articleToEdit->setTitle($articleTitle);
            $articleToEdit->setContent($articleContent);
            $articleToEdit->setFeatured($isArticleFeatured);
            $articleToEdit->setPhotoId($pictureId);
            $articleToEdit->setStatus($status);
            (new ArticleRepository)->updateArticle($articleToEdit);
        }

        header("Location: admin-panel?add-art-status=$status");
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

  function saveArticleDataToSession($title, $content, $isFeatured, $pictureId, $status) {
    $_SESSION['title'] = $title;
    $_SESSION['content'] = $content;
    $_SESSION['featured'] = $isFeatured;
    $_SESSION['picture-id'] = $pictureId;
    $_SESSION['status'] = $status;
  }