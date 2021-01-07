<?php
require_once(_ACTIONS_PATH . 'redirects.php');
redirectIfNotLoggedIn();

require_once _REPOSITORIES_PATH . 'UserRepository.php';

$errors = [];

$username = null;
$role = null;

if (isset($_POST['username'])) {
    if (isset($_POST['role']) && ($_POST['role'] == 'user' || $_POST['role'] == 'admin')) {
        $username = secureInputTextWithTrimSpaces($_POST['username']);
        $firstPassword = secureInputTextWithTrimSpaces($_POST['first_password']);
        $secondPassword = secureInputTextWithTrimSpaces($_POST['second_password']);
        $role = $_POST['role'];

        if (strlen($username) < 4 || strlen($username) > 20) {
            $errors['register-username'] = "Nazwa użytkownika powinna mieć od 4 do 20 znaków";
        }

        if ($username != $_POST['username']) {
            $errors['register-username'] = "Użyto niedozwolonych znaków w nazwie użytkownika";
        }

        if (strlen($firstPassword) < 4 || strlen($firstPassword) > 20) {
            $errors['register-password'] = "Hasło powinno mieć od 4 do 20 znaków";
        }

        if ($firstPassword != $_POST['first_password']) {
            $errors['register-password'] = "Użyto niedozwolonych znaków w haśle";
        }

        if ($firstPassword != $secondPassword) {
            $errors['register-password'] = "Hasła nie są identyczne";
        }

        if(count($errors) == 0) {
            if ($role == 'user') {
                (new UserRepository())->saveUserFromRequest(CreateUserRequest::createUser($username, password_hash($firstPassword, PASSWORD_BCRYPT)));
            } else {
                if ($role == 'admin') {
                    (new UserRepository())->saveUserFromRequest(CreateUserRequest::createAdministrator($username, password_hash($firstPassword, PASSWORD_BCRYPT)));
                }
            }
            addAlert("Zarejestrowano nowego użytkownika", "success");

            header('Location: '. _RHOME . 'admin-panel/');
            exit();
        }

    } else {
        $errors['register-role'] = "Proszę wybrać rolę i nie próbować wprowadzać modyfikacji w kodzie strony ;)";
    }
}