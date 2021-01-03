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
$featuredForSlider=prepareFeaturedForSLider(3,false,4,2,1,true);
if($page==1)
$featuredForSlider=prepareFeaturedForSLider(5,false,4,1);


$numOfArticles=$articleRepository->getArticlesCount(true);
$lastPageNumber = ceil($numOfArticles / $postPerPage);
/*if($page>$lastPageNumber)
$page=$lastPageNumber;*///todo:show 404
$offset=($page-1)*$postPerPage;
$newestArticles = $articleRepository->getArticles(true,false,$postPerPage, $offset);
