<?php
require_once(_ACTIONS_PATH . 'redirects.php');
redirectIfLoggedIn();

require_once(_REPOSITORIES_PATH . 'UserRepository.php');

$errors = [];

if(isset($_POST['username'])) {
    $username = testInput($_POST['username']);
    $password = testInput(($_POST['password']));

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

function testInput($data) { 
    $data = trim($data);
    $data = stripslashes($data); //zabezpieczenia cudzysłowów
    $data = htmlspecialchars($data); //konwersja znaków specjalnych HTML do encji HTML
    return $data;
  }
?>