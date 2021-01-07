<?php
require_once(_ACTIONS_PATH . 'redirects.php');
redirectIfNotLoggedIn();

require_once _REPOSITORIES_PATH . 'UserRepository.php';

$errors = [];

if (isset($_POST['username'])) {
    if (isset($_POST['role'])) {
        $username = secureInputTextWithTrimSpaces($_POST['username']);
        $firstPassword = secureInputTextWithTrimSpaces($_POST['first_password']);
        $secondPassword = secureInputTextWithTrimSpaces($_POST['second_password']);
        $role = $_POST['role'];

        if (strlen($username) < 5 || strlen($username) > 20) {
            $errors['register-username'] = "Nazwa użytkownika powinna mieć od 5 do 20 znaków";
        }

    } else {
        $errors['register-role'] = "Proszę wybrać rolę i nie próbować wprowadzać modyfikacji w kodzie strony ;)";
    }
}