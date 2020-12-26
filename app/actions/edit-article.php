<?php
$errors = [];
$articleToEdit = null;
require_once(_ACTIONS_PATH . 'add-picture.php');
require_once(_CLASSES_PATH . 'CreateArticleRequest.php');
require_once(_REPOSITORIES_PATH . 'ArticleRepository.php');

//post z form
if(isset($_POST['title'])) {
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
    validateArticle($errors, $pictureId);
}
else {
    if(isset($_GET['edit-article'])) {
        $articleToEdit = (new ArticleRepository)->getArticleById($_GET['edit-article'])['article'];
        saveArticleDataToSession($articleToEdit->getTitle(), $articleToEdit->getContent(), $articleToEdit->isFeatured(), $articleToEdit->getPhotoId());
    }
}

function validateArticle(&$errors, $pictureId) {
    $isDataCorrect = true;

    $articleTitle = testInput($_POST['title']);
    $articleContent = testInput($_POST['content']);
    $isArticleFeatured = isset($_POST['featured']);
    saveArticleDataToSession($articleTitle, $articleContent, $isArticleFeatured, $pictureId);

    $isPublishButtonClicked = isset($_POST['publish-button']);

    if($articleTitle == '') {
        $isDataCorrect = false;
        $errors['title'] = "Należy uzupełnić pole tytuł";
    }

    $status = $isPublishButtonClicked ? "published" : "draft";

    if($isDataCorrect) {
        if($pictureId != null) {
            $createArticleRequest = CreateArticleRequest::createWithPhoto($articleTitle, $articleContent, null, $status, $isArticleFeatured, 0, $pictureId);
            (new ArticleRepository)->saveArticleFromRequest($createArticleRequest);
        }
        else {
            $createArticleRequest = CreateArticleRequest::createWithoutPhoto($articleTitle, $articleContent, null, $status, $isArticleFeatured, 0);
            (new ArticleRepository)->saveArticleFromRequest($createArticleRequest);
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

  function saveArticleDataToSession($title, $content, $isFeatured, $pictureId) {
    $_SESSION['title'] = $title;
    $_SESSION['content'] = $content;
    $_SESSION['featured'] = $isFeatured;
    $_SESSION['picture-id'] = $pictureId;
  }