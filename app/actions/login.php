<?php
require_once(_ACTIONS_PATH . 'redirects.php');
redirectIfLoggedIn();

require_once(_REPOSITORIES_PATH . 'UserRepository.php');

$errors = [];

if(isset($_POST['username'])) {
    $username = secureInputTextWithTrimSpaces($_POST['username']);
    $password = secureInputTextWithTrimSpaces(($_POST['password']));

    $user = (new UserRepository)->getUserByName($username);
    if($user != null && $user->getPassword() === $password) {
      $_SESSION['login'] = $user->getId();
      header('Location: ' . _RHOME . 'admin-panel/');
      exit();
    }
    else {
      $errors['login-validation'] = "Podano niewłaściwe dane logowania!";
    }
}
?>