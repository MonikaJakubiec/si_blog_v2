<?php

define('_ROOT_PATH', dirname(__FILE__));
require_once(_ROOT_PATH . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'private' . DIRECTORY_SEPARATOR . 'config.php');
define('_RESOURCES_PATH', 'app' . DIRECTORY_SEPARATOR . 'resources');
define('_VIEWS_PATH', _ROOT_PATH . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'views');
define('_ACTIONS_PATH', _ROOT_PATH . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'actions');
define('_CLASS_PATH', _ROOT_PATH . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'classes');
define('_REPOSITORIES_PATH', _ROOT_PATH . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'repositories');
define('_PDO_PATH', _ROOT_PATH . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'pdo');
define('_UPLOADS_PATH', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'uploads');

session_start(); //rozpoczęcie sesji

$pages = array('add-article', 'delete-article', 'edit-article', 'homepage', 'login', 'logout', 'admin-panel', 'preview-article', 'add-picture', 'listing', 'article');

if (array_key_exists('page', $_GET)) {

    if (in_array($_GET['page'], $pages)) {
        $page = $_GET['page']; //przypisanie zmiennej action wartosci przesłanej za pomocą metody GET
    } else {
        $page = 'page-not-found';
    }
} else {

    $page = 'listing';
}

$action = _ACTIONS_PATH . DIRECTORY_SEPARATOR . $page . '.php';
$view = _VIEWS_PATH . DIRECTORY_SEPARATOR . $page . '.php';

if (file_exists($action)) {
    include($action);
}

if (file_exists($view)) {
    include($view);
}
?>
