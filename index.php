<?php

define('_ROOT_PATH', dirname(__FILE__));
require_once(_ROOT_PATH . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'private' . DIRECTORY_SEPARATOR . 'config.php');

define('_VIEWS_PATH', _ROOT_PATH . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'views');
define('_ACTIONS_PATH', _ROOT_PATH . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'actions');
define('_CLASS_PATH', _ROOT_PATH . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'classes');
define('_UPLOADS_PATH', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'uploads');


$routingCurrDir = str_replace("index.php", "", $_SERVER['SCRIPT_NAME']);
$routingRequest = str_replace($routingCurrDir, "", $_SERVER['REQUEST_URI']); //TODO: change to string len
define('_RHOME', $routingCurrDir);
define('_RESOURCES_PATH', $routingCurrDir .'app' . DIRECTORY_SEPARATOR . 'resources');

$routingRequest=str_replace("/","",$routingRequest);//TODO
$routingRequest=str_replace("index.php","",$routingRequest);//TODO
session_start(); //rozpoczęcie sesji

$pages = array('add-article', 'delete-article', 'edit-article', 'homepage', 'login', 'logout', 'admin-panel', 'preview-article', 'add-picture', 'listing', 'article');


if (in_array($routingRequest, $pages)) {
    $page = $routingRequest; //przypisanie zmiennej action wartosci przesłanej za pomocą metody GET
} else {
    if ($routingRequest == "")
        $page = "listing";
    else {
        $page = 'page-not-found';
    }
}


/*
if (array_key_exists('page', $_GET)) {

    if (in_array($_GET['page'], $pages)) {
        $page = $_GET['page']; //przypisanie zmiennej action wartosci przesłanej za pomocą metody GET
    } else {
        $page = 'page-not-found';
    }
} else {

    $page = 'listing';
}*/

$action = _ACTIONS_PATH . DIRECTORY_SEPARATOR . $page . '.php';
$view = _VIEWS_PATH . DIRECTORY_SEPARATOR . $page . '.php';

if (file_exists($action)) {
    include($action);
}

if (file_exists($view)) {
    include($view);
}
