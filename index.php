<?php
define('_ROOT_PATH', dirname(__FILE__));
require_once(_ROOT_PATH. DIRECTORY_SEPARATOR .'app' .DIRECTORY_SEPARATOR. 'private' . DIRECTORY_SEPARATOR . 'config.php');
define('_RESOURCES_PATH', _ROOT_PATH.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'resources');
define('_VIEWS_PATH', _ROOT_PATH.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'views');
define('_ACTIONS_PATH', _ROOT_PATH.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'actions');
define('_CLASS_PATH', _ROOT_PATH.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'classes');

$actions = array('add-article', 'delete-article', 'edit-article', 'homepage', 'login');
$action = 'homepage';
if(array_key_exists('page', $_GET) && in_array($_GET['page'], $actions))
	{
		$action = $_GET['page']; //przypisanie zmiennej action wartosci przesłanej za pomocą metody GET
    }
    
include(_ACTIONS_PATH . DIRECTORY_SEPARATOR .$action.'.php');
include(_VIEWS_PATH . DIRECTORY_SEPARATOR .$action.'.php');
?>

