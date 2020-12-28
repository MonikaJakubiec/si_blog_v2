<?php
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
?>