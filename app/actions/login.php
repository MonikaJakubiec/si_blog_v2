<?php
redirectIfLoggedIn();

require_once(_REPOSITORIES_PATH . 'UserRepository.php');

$errors = [];

if(isset($_POST['username'])) {
    $username = secureInputTextWithTrimSpaces($_POST['username']);
    $password = secureInputTextWithTrimSpaces(($_POST['password']));

    $user = null;
    $user = (new UserRepository())->getUserByName($username);

    if($user != null && password_verify($password, $user->getPassword())) {
      $_SESSION['login'] = $user->getId();
      
      $headerSite = 'articles-list/';

      if($user->getRole() == 'administrator') {
        $headerSite = 'admin-panel/';
      }

      header('Location: ' . _RHOME . $headerSite);
      exit();

    }
    else {
      $errors['login-validation'] = "Podano niewłaściwe dane logowania!";
    }
}
?>