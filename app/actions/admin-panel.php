<?php 
require_once(_CLASSES_PATH  . 'Article.php');
require_once(_REPOSITORIES_PATH  . 'ArticleRepository.php');

//TODO modify
if(isset($_GET['delete-article'])) {
    $articleRepository = new ArticleRepository();
    $articleToArchive = $articleRepository->getArticleById($_GET['delete-article'])["article"];
    $articleToArchive->setStatus("archived");
    $articleRepository->updateArticle($articleToArchive);
}

$articleRepository=new ArticleRepository;
//$allArticles=$articleRepository->getAllArticles(); //TODO restore

//TODO delete
$allArticlesTemp=$articleRepository->getAllArticles();
$allArticles = [];

//TODO delete
foreach($allArticlesTemp as $article) {
    if($article['article']->getStatus() != "archived") array_push($allArticles, $article);
}