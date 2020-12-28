<?php
require_once(_ACTIONS_PATH . 'login.php');
redirectIfNotLoggedIn();

unset($_SESSION['login']);
session_unset();
session_destroy();
header("Location: " . _RHOME . '?logout=true');
exit();
?>