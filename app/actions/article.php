<?php
require_once(_CLASSES_PATH  . 'Article.php');
require_once(_REPOSITORIES_PATH  . 'ArticleRepository.php');
$articleRepository = new ArticleRepository;

$articleId = null; //brak artykulu
$routingRequestPageWithDataForArticle;
//proba pobrania id artykulu z adresu url
for ($counter = 0; $counter < count($routingRequestPageWithDataForArticle) - 1; $counter++) {
    if ($routingRequestPageWithDataForArticle[$counter] = "article") {
        if (is_numeric($routingRequestPageWithDataForArticle[$counter + 1])) {
            $articleId = $routingRequestPageWithDataForArticle[$counter + 1];
        }
        break;
    }
}
$articleData = null;
if ($articleId) {
    $featuredForSliderAside = prepareFeaturedForSLider(3, true, 3, 1);

    $articleData = $articleRepository->getArticleById($articleId);

    if ($articleData != null) {
        $articleMetaDescription = htmlentities(substr(preg_replace('!\s+!', ' ', Strip_tags(html_entity_decode($articleData['article']->getContent()))), 0, 160));
        $newestArticles = $articleRepository->getArticles(true, false, 10, 0,null,array(['publishedTime','DESC']));
        $userArticles = $articleRepository->getArticles(true, false, 10, 0, $articleData["user"]->getId(), array(["publishedTime", "DESC"]), [$articleId]);
    }
} else {
    showNotFoundPage();
}
if ($articleData == null)
    showNotFoundPage();
