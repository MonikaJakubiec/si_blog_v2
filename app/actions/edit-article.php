<?php
require_once(_ACTIONS_PATH . 'add-picture.php');

if(!isset($errors)) $errors = [];

//post z form
if(isset($_POST['title'])) {
    validateArticle();
    $errors = validatePicture();
    $_SESSION['picture-id'] = $_POST['picture-id'];
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