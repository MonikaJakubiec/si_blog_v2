<?php 
require_once(_ACTIONS_PATH . 'redirects.php');
redirectIfNotLoggedIn();

require_once(_CLASSES_PATH  . 'Article.php');
require_once(_REPOSITORIES_PATH  . 'ArticleRepository.php');

if(isset($_GET['delete-article'])) {
    (new ArticleRepository())->deleteArticle($_GET['delete-article']);    
}

$articleRepository=new ArticleRepository;
$allArticles=$articleRepository->getAllArticles();