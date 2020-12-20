<?php
require_once(_ACTIONS_PATH . 'add-picture.php');

//post z form
if(isset($_POST['title'])) {
    validateArticle($errors);
    $errors = validatePicture();
    $_SESSION['picture-id'] = $_POST['picture-id'];
}

function validateArticle($errors) {
    $isDataCorrect = true;

    $articleTitle = testInput($_POST['title']);
    $articleContent = testInput($_POST['content']);

    if($articleTitle == '') {
        $isDataCorrect = false;
        $errors['title'] = "Należy uzupełnić pole tytuł";
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