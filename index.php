<?php
define('_ROOT_PATH', dirname(__FILE__));
require_once(_ROOT_PATH. DIRECTORY_SEPARATOR .'app' .DIRECTORY_SEPARATOR. 'private' . DIRECTORY_SEPARATOR . 'config.php');
define('_RESOURCES_PATH', _ROOT_PATH.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'resources');
define('_VIEWS_PATH', _ROOT_PATH.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'views');
define('_CLASS_PATH', _ROOT_PATH.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'classes');


if (isset($_GET['homepage']))
{
    include(_VIEWS_PATH . DIRECTORY_SEPARATOR . 'listing.php');
}
