<?php 

function showFeatured($limit=3){
    echo "<h1>showFeatured</h1>";
    require_once(_CLASSES_PATH  . 'Article.php');
    require_once(_REPOSITORIES_PATH  . 'ArticleRepository.php');
    $articleRepository = new ArticleRepository;

    $featuredArticles = $articleRepository->getNumberOfArticlesStartingFromOffset($postPerPage, $offset,true);

}
?>