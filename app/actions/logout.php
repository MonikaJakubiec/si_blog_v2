<?php
require_once('app' . DIRECTORY_SEPARATOR . 'actions' . DIRECTORY_SEPARATOR . 'login.php');
isUserLoggedIn();

unset($_SESSION['login']);
session_unset();
session_destroy();
header("Location: " . _RHOME . '?logout=true');
exit();
?>