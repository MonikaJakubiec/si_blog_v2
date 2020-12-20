<?php
require_once(_ACTIONS_PATH . 'add-picture.php');
$errors = [];
validatePicture($errors);

if(isset($_POST['title'])) {
    validateArticle();
}

function validateArticle() {
    $articleTitle = testInput($_POST['title']);
    $articleContent = testInput($_POST['content']);
}

function testInput($data) { 
    $data = stripslashes($data); //zabezpieczenia cudzysłowów
    $data = htmlspecialchars($data); //konwersja znaków specjalnych HTML do encji HTML
    return $data;
  }
?>