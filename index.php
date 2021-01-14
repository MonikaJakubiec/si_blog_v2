<?php
session_start();

setlocale(LC_ALL, 'pl_pl.UTF8', 'pol.UTF-8', 'plk.UTF-8'); //ustawienie dla formatowania dat

/** katalog w ktorym znajduje się aplikajca */
$routingCurrDir = str_replace("index.php", "", $_SERVER['SCRIPT_NAME']);
$opisStrony = ('Najciekawsze artykuły o technologii'); //tytuł strony (wyświetlany w title strony głównej)

/** katalog w ktorym znajduje się aplikajca */
define('_RHOME', $routingCurrDir);

/** katalog z widokami */
define('_VIEWS_PATH',  'app' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);

/** katalog z kontrolerami */
define('_ACTIONS_PATH',  'app' . DIRECTORY_SEPARATOR . 'actions' . DIRECTORY_SEPARATOR);

/** katalog z klasami */
define('_CLASSES_PATH', 'app' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR);

/** katalog z danymi prywatnymi */
define('_PRIVATE_PATH', 'app' . DIRECTORY_SEPARATOR . 'private' . DIRECTORY_SEPARATOR);

/** katalog z repozytoriami */
define('_REPOSITORIES_PATH', 'app' . DIRECTORY_SEPARATOR . 'repositories' . DIRECTORY_SEPARATOR);

/** plik z polaczeniem z baza danych */
define('_PDO_FILE', 'app' . DIRECTORY_SEPARATOR . 'pdo' . DIRECTORY_SEPARATOR . 'pdo.php');

/** katalog z zasobami css/js/images */
define('_RESOURCES_PATH', _RHOME . 'app' . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR);

/** katalog z wgranymi plikami */
define('_UPLOADS_PATH', 'uploads');

require_once('app' . DIRECTORY_SEPARATOR . 'private' . DIRECTORY_SEPARATOR . 'config.php');
require_once(_VIEWS_PATH  . 'partials' . DIRECTORY_SEPARATOR . 'head.php');
require_once(_VIEWS_PATH  . 'partials' . DIRECTORY_SEPARATOR . 'header.php');
require_once(_VIEWS_PATH  . 'partials' . DIRECTORY_SEPARATOR . 'footer.php');
require_once(_ACTIONS_PATH  . 'functions.php');
require_once(_ACTIONS_PATH . 'redirects.php');


/**
 * Żądanie użytkownika od katalogu, w ktorym znajduje sie aplikacja
 * @var string
 */
$routingRequest = str_replace(_RHOME, "", $_SERVER['REQUEST_URI']);

/**
 * Żądana strona (bez parametrów) z danymi po slashu
 * @var string
 */
$routingRequestPage = str_replace("index.php", "", $routingRequest);
$routingRequestPage = explode('?', $routingRequestPage, 2)[0];
$routingRequestPage = explode('&', $routingRequestPage, 2)[0];
$routingRequestPage = explode('#', $routingRequestPage, 2)[0];
$routingRequestPage = trim($routingRequestPage, "/");

/**
 * Tablica żądanych danych (dane w url rozdzielone slashami)
 * @var string
 */
$routingRequestPageWithData = explode("/", $routingRequestPage);
$routingRequestPageWithDataForArticle = explode("/", str_replace(",", "/", $routingRequestPage));
/**
 * Żądana strona (bez parametrów) bez danych po slashu
 * @var string
 */
$routingRequestPageWithoutData = $routingRequestPageWithData[0];

/**
 * Dostępne strony
 * @var array
 */
$pages = array('edit-article', 'add-article', 'login', 'logout', 'admin-panel', 'articles-list', 'listing', 'article', 'register', 'users-list');

if (in_array($routingRequestPageWithoutData, $pages)) {
    /**
     * Strona do załadowania
     * @var string
     */
    $page = $routingRequestPageWithoutData;
} else {
    if ($routingRequestPageWithoutData == "")
        $page = "listing";
    else {
        $page = 'page-not-found';
    }
}
if ($page == "add-article") {
    $page = "edit-article";
}
$action = _ACTIONS_PATH . $page . '.php';
$view = _VIEWS_PATH . $page . '.php';

if (file_exists($action)) {
    include($action);
}

if (file_exists($view)) {
    include($view);
}
