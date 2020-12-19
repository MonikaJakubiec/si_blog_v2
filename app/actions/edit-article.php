<?php
if(isset($_POST['title'])) {
    validateArticle();
    exit();
}

function validateArticle() {
    $articleTitle = testInput($_POST['title']);
    $articleContent = testInput($_POST['content']);

    //sprawdzanie czy tytul istnieje w bazie

    // $articlesFromDB = (new ArticleRepository())->getAllArticles();
    // $sameTitleExist = false;
    // foreach($articlesFromDB as $article) {
    //     if(strcmp($articleTitle, $article->getTitle()) == 0) {
    //         $sameTitleExist = true;
    //     }
    // }
    // if(!$sameTitleExist)
    // {
    //     header("Location: " . _RHOME . "admin-panel?added-article=true");
    // }
    // else {
    //     header("Location: " . _RHOME . "admin-panel?added-article=false");
    // }
}

function testInput($data) { 
    $data = stripslashes($data); //zabezpieczenia cudzysłowów
    $data = htmlspecialchars($data); //konwersja znaków specjalnych HTML do encji HTML
    return $data;
  }
?>