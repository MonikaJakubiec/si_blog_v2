<?php
require_once(_CLASSES_PATH  . 'Article.php');
require_once(_REPOSITORIES_PATH  . 'ArticleRepository.php');
$articleRepository = new ArticleRepository;

$articleId = false;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$newestArticles = $articleRepository->getNumberOfArticlesStartingFromOffset($postPerPage, ($page-1)*$postPerPage);
