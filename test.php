<?php

define('_ROOT_PATH', dirname(__FILE__));
require_once(_ROOT_PATH . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'private' . DIRECTORY_SEPARATOR . 'config.php');
define('_RESOURCES_PATH', 'app' . DIRECTORY_SEPARATOR . 'resources');
define('_VIEWS_PATH', _ROOT_PATH . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'views');
define('_ACTIONS_PATH', _ROOT_PATH . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'actions');
define('_CLASSES_PATH', _ROOT_PATH . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'classes');
define('_REPOSITORIES_PATH', _ROOT_PATH . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'repositories');
define('_PDO_PATH', _ROOT_PATH . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'pdo');
define('_UPLOADS_PATH', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'uploads');

require_once _CLASSES_PATH . DIRECTORY_SEPARATOR . 'CreateUserRequest.php';
require_once _REPOSITORIES_PATH . DIRECTORY_SEPARATOR . 'UserRepository.php';
require_once _CLASSES_PATH . DIRECTORY_SEPARATOR . 'CreateArticleRequest.php';
require_once _REPOSITORIES_PATH . DIRECTORY_SEPARATOR . 'ArticleRepository.php';
require_once _CLASSES_PATH . DIRECTORY_SEPARATOR . 'AddPhotoRequest.php';
require_once _REPOSITORIES_PATH . DIRECTORY_SEPARATOR . 'PhotoRepository.php';

/*

$userRequest1 = CreateUserRequest::createAdministrator("user1", "user1password");
$userRequest2 = CreateUserRequest::createUser("user2", "user2password");
$userRequest3 = CreateUserRequest::createUser("user3", "user3password");
$userRepo = new UserRepository();
$userRepo->saveUserFromRequest($userRequest1);
$userRepo->saveUserFromRequest($userRequest2);
$userRepo->saveUserFromRequest($userRequest3);

echo "<br><br>";

$articleRequest1 = CreateArticleRequest::createWithoutPhoto("Article 1 without photo", "without photo without photo without photo", time(), "draft", false, 1);
$articleRequest2 = CreateArticleRequest::createWithPhoto("Article 2 with photo", "with photo 2 with photo 2", time(), "draft", false, 2, 2);
$articleRequest3 = CreateArticleRequest::createWithPhoto("Article 3 with photo", "with photo 3 with photo 3", time(), "draft", false, 3, 3);
$articleRepo = new ArticleRepository();
$articleRepo->saveArticleFromRequest($articleRequest1);
$articleRepo->saveArticleFromRequest($articleRequest2);
$articleRepo->saveArticleFromRequest($articleRequest3);

*/

/*
$articleRepo = new ArticleRepository();
$allArticlesInfo = $articleRepo->getNumberOfArticlesStartingFromOffset(10, 0);
var_dump($allArticlesInfo);
*/

/*
$photoRequest = new AddPhotoRequest("/folder1/image.png", "Here should be image");
$photoRepo = new PhotoRepository();
$lastId = $photoRepo->savePhotoFromRequest($photoRequest);
var_dump($lastId);
*/

?>