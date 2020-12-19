<?php
session_start();

/** katalog w ktorym znajduje się aplikajca */
$routingCurrDir = str_replace("index.php", "", $_SERVER['SCRIPT_NAME']);


/** katalog w ktorym znajduje się aplikajca */
define('_RHOME', $routingCurrDir);
require_once('app' . DIRECTORY_SEPARATOR . 'private' . DIRECTORY_SEPARATOR . 'config.php');

/** katalog z widokami */
define('_VIEWS_PATH',  'app' . DIRECTORY_SEPARATOR . 'views'.DIRECTORY_SEPARATOR);

/** katalog z kontrolerami */
define('_ACTIONS_PATH',  'app' . DIRECTORY_SEPARATOR . 'actions'.DIRECTORY_SEPARATOR);

/** katalog z clasami */
define('_CLASSES_PATH', 'app' . DIRECTORY_SEPARATOR . 'classes'.DIRECTORY_SEPARATOR);

/** katalog z repozytoriami */
define('_REPOSITORIES_PATH', 'app' . DIRECTORY_SEPARATOR . 'repositories'.DIRECTORY_SEPARATOR);

/** katalog z zasobami css/js/images */
define('_RESOURCES_PATH', _RHOME . 'app' . DIRECTORY_SEPARATOR . 'resources'.DIRECTORY_SEPARATOR);//TODO:

/** katalog z wgranymi plikami */
define('_UPLOADS_PATH', 'uploads');



require_once(_VIEWS_PATH  . 'partials' . DIRECTORY_SEPARATOR . 'head.php');
require_once(_VIEWS_PATH  . 'partials' . DIRECTORY_SEPARATOR . 'header.php');
require_once(_VIEWS_PATH  . 'partials' . DIRECTORY_SEPARATOR . 'footer.php');

require_once(_REPOSITORIES_PATH . 'ArticleRepository.php');
require_once(_CLASSES_PATH . 'Article.php');

/**
 * Żądanie użytkownika od katalogu, w ktorym znajduje sie aplikacja
 * @var string
 */
$routingRequest = str_replace(_RHOME, "", $_SERVER['REQUEST_URI']);
/** Adres zasobu żądanego przez użytkownika */


/**
 * Żądana strona (bez parametrów)
 * @var string
 */
$routingRequestPage = str_replace("index.php", "", $routingRequest);
$routingRequestPage = explode('?', $routingRequestPage, 2)[0];
$routingRequestPage = explode('&', $routingRequestPage, 2)[0];
$routingRequestPage = explode('#', $routingRequestPage, 2)[0];
$routingRequestPage = trim($routingRequestPage, "/");

/**
 * Dostępne strony
 * @var array
 */
$pages = array('edit-article', 'delete-article', 'homepage', 'login', 'logout', 'admin-panel', 'preview-article', 'add-picture', 'listing', 'article');

if (in_array($routingRequestPage, $pages)) {
    /**
     * Strona do załadowania
     * @var string
     */
    $page = $routingRequestPage;
} else {
    if ($routingRequestPage == "")
        $page = "listing";
    else {
        $page = 'page-not-found';
    }
}


$action = _ACTIONS_PATH . $page . '-controller.php';
$view = _VIEWS_PATH . $page . '-view.php';

if (file_exists($action)) {
    include($action);
}

if (file_exists($view)) {
    include($view);
}
