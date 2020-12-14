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

require_once _CLASS_PATH . DIRECTORY_SEPARATOR . 'CreateUserRequest.php';
require_once _REPOSITORIES_PATH . DIRECTORY_SEPARATOR . 'UserRepository.php';

$userRequest = CreateUserRequest::createAdministrator("user1", "user1password");
$userRepo = new UserRepository();
$userRepo->saveUserFromRequest($userRequest);
$userArray = $userRepo->getAllUsers();
var_dump($userArray);

?>