<?php
require_once(_CLASSES_PATH  . 'Article.php');
require_once(_REPOSITORIES_PATH  . 'ArticleRepository.php');
$articleRepository = new ArticleRepository;
$page=1;
$articleId = false;
if (isset($_GET['page'])) {
    $page =  intval($_GET['page']);
} else {
    $page =1;
}
$numOfArticles=$articleRepository->getArticlesCount();
$lastPageNumber = ceil($numOfArticles / $postPerPage);
if($page>$lastPageNumber)
$page=$lastPageNumber;
$offset=($page-1)*$postPerPage;
$newestArticles = $articleRepository->getNumberOfArticlesStartingFromOffset($postPerPage, $offset,true);