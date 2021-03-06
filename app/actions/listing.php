<?php
require_once(_CLASSES_PATH  . 'Article.php');
require_once(_REPOSITORIES_PATH  . 'ArticleRepository.php');
$articleRepository = new ArticleRepository;
$page = 1;
$articleId = false;
if (isset($_GET['page'])) {
    $page =  intval($_GET['page']);
} else {
    $page = 1;
}
$featuredForSlider = null;

if ($page == 1)
    $featuredForSlider = prepareFeaturedForSLider(5, false, 4, 1);

$numOfArticles = $articleRepository->getArticlesCount(true);
$lastPageNumber = ceil($numOfArticles / $postPerPage);
if ($page > $lastPageNumber) {
    showNotFoundPage();
}
$offset = ($page - 1) * $postPerPage;
/**
 * Tytuł storny (tag title)
 */
$htmlTitle = _SITE_NAME;
if ($page > 1) {
    $htmlTitle .= ' - strona ' . $page . '/' . $lastPageNumber . ' - ' . $opisStrony;
} else {
    $htmlTitle .= ' - ' . $opisStrony;
}
$newestArticles = $articleRepository->getArticles(true, false, $postPerPage, $offset,null,array(['publishedTime','DESC']));
