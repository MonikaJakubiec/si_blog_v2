<?php
require_once(_CLASSES_PATH  . 'Article.php');
require_once(_REPOSITORIES_PATH  . 'ArticleRepository.php');
$articleRepository=new ArticleRepository;

$articleId=false;

$newestArticles=$articleRepository->getNumberOfArticlesStartingFromOffset(10,0);
