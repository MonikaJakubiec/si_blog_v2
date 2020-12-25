<?php
$errors = [];
require_once(_ACTIONS_PATH . 'add-picture.php');
require_once(_CLASSES_PATH . 'CreateArticleRequest.php');
require_once(_REPOSITORIES_PATH . 'ArticleRepository.php');

//post z form
if(isset($_POST['title'])) {
    $pictureId = validatePicture($errors);
    validateArticle($errors, $pictureId);

    $_SESSION['picture-id'] = $_POST['picture-id'];
}

function validateArticle(&$errors, $pictureId) {
    $isDataCorrect = true;

    $articleTitle = testInput($_POST['title']);
    $articleContent = testInput($_POST['content']);
    $isArticleFeatured = isset($_POST['featured']);
    $isPublishButtonClicked = isset($_POST['publish-button']);

    if($articleTitle == '') {
        $isDataCorrect = false;
        $errors['title'] = "Należy uzupełnić pole tytuł";
    }

    if($isDataCorrect) {
        $createArticleRequest = CreateArticleRequest::createWithPhoto($articleTitle, $articleContent, null, $isPublishButtonClicked ? "published" : "draft", $isArticleFeatured, 0, $pictureId);
        (new ArticleRepository)->saveArticleFromRequest($createArticleRequest);
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
?>