<?php
redirectIfNotLoggedIn();

require_once(_REPOSITORIES_PATH  . 'ArticleRepository.php');

if (isset($_GET['delete-article'])) {
    (new ArticleRepository())->deleteArticle($_GET['delete-article']);
}
$newSortDirections = array(
    "id" => "ASC",
    "title" => "ASC",
    "author" => "ASC",
    "publishedTime" => "ASC",
);
$articleRepository = new ArticleRepository;
if (isset($_GET['sortBy'])) {
    $sortColumn = $_GET['sortBy'];
    $sortDirection = isset($_GET['sortDir']) ? $_GET['sortDir'] : "ASC";

    //zamiana kierunku sortowania
    if (array_key_exists($sortColumn, $newSortDirections)) {
        if ($sortDirection == "ASC") //zabezpieczenie na wypadek wpisania innej opcji
            $newSortDirections[$sortColumn] = "DESC";
    }
} else //nie zdefiniowano sortowania
{
    $sortColumn = "id";
    $sortDirection = "DESC";
}
//dodanie sortowania po statusie, jeśli wybrano sortowanie po dacie publikacji
if ($sortColumn == "publishedTime") {
    $sortArray=[];
    if ($sortDirection == "DESC")
        array_push($sortArray, ["status", "ASC"]);
    else
    array_push($sortArray, ["status", "DESC"]);
    array_push($sortArray, [$sortColumn, $sortDirection]);
} else
    $sortArray = array([$sortColumn, $sortDirection]);

if($userRole == 'administrator') {
    $allArticles = $articleRepository->getArticles(false, false, null, 0,null,$sortArray);
} else {
    $allArticles = $articleRepository->getArticlesCreatedByUser($_SESSION['login'], $sortArray);
}
