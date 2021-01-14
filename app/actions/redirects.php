<?php
require_once _REPOSITORIES_PATH . 'UserRepository.php';
$userRole = null; //jezeli nie zalogowany
if(isset($_SESSION['login'])) {
  $userRole = (new UserRepository)->getUserById($_SESSION['login'])->getRole();
}

/**
 * przekierowanie na strone logowania jezeli niezalogowany
 */
function redirectIfNotLoggedIn() {
  if(!isset($_SESSION['login'])) {
    header("Location: " . _RHOME . 'login/');
    exit();
  }
}

/**
 * przekierowanie na strone glowna admin-panel jezeli zalogowany
 */
function redirectIfLoggedIn() {
  if(isset($_SESSION['login'])) {
    header("Location: " . _RHOME . 'admin-panel/');
    exit();
  }
}

/**
 * przekierowanie usera do strony glownej admin panel a niezalogowanego do strony logowania
 */
function redirectIfNotAdmin($userRole) {
  if(isset($userRole)) {
    if($userRole != 'administrator') {
      addAlert('Nie masz uprawnień do wyświetlenia podanej strony', 'error');
      header("Location: " . _RHOME . 'admin-panel/');
      exit();
    }
  } else {
    addAlert('Musisz najpierw się zalogować', 'warning');
    header("Location: " . _RHOME . 'login/');
    exit();
  }
}
