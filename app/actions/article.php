<?php
require_once(_CLASSES_PATH  . 'Article.php');
require_once(_REPOSITORIES_PATH  . 'ArticleRepository.php');
$articleRepository=new ArticleRepository;

$articleId=false;
$routingRequestPageWithData;
//szukanie id posta w adresie url
for($counter=0;$counter<count($routingRequestPageWithData)-1;$counter++)
{
    if($routingRequestPageWithData[$counter]="article")
    {
        if(is_numeric($routingRequestPageWithData[$counter+1]))
        {
            $articleId=$routingRequestPageWithData[$counter+1];
        }
        break;
    }
}

if($articleId){
$articleData=$articleRepository->getArticleById($articleId);
$currentPage=1;//todo:change
$newestArticles=$articleRepository->getNumberOfArticlesStartingFromOffset(10,($currentPage-1)*$postPerPage, true);
}
else
{
    $page = 'page-not-found';
    if (file_exists($view)) {
        include($view);
    }
}