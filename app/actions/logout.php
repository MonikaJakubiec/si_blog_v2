<?php
redirectIfNotLoggedIn();

unset($_SESSION['login']);
session_unset();
session_destroy();
session_start();
addAlert("Pomyślnie wylogowano<br><a href=\""._RHOME."login/\">Zaloguj ponownie.</a>","success");
header("Location: " . _RHOME);
exit();
?>