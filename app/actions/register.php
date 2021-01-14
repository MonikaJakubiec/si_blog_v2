<?php
redirectIfNotAdmin($userRole);

require_once _REPOSITORIES_PATH . 'UserRepository.php';

$errors = [];

$isEditForm = false;

$username = null;
$role = null;
$id = null;

if (isset($_POST['username'])) {
    if (isset($_POST['edit-user']) && $_POST['edit-user'] != '') {
        $user = (new UserRepository())->getUserById($_POST['edit-user']);
        $username = $user->getName();
        $role = $user->getRole();
        $id = $user->getId();
        $isEditForm = true;
    }

    if (isset($_POST['role']) && ($_POST['role'] == 'user' || $_POST['role'] == 'administrator')) {
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

        //nie weryfikuje długości tylko jeśli został przesłany formularz edycji z pustym hasłem
        if (!($isEditForm && strlen($firstPassword) == 0) && (strlen($firstPassword) < 4 || strlen($firstPassword) > 20)) {
            $errors['register-password'] = "Hasło powinno mieć od 4 do 20 znaków";
        }


        if ($firstPassword != $_POST['first_password']) {
            $errors['register-password'] = "Użyto niedozwolonych znaków w haśle";
        }

        if ($secondPassword != $_POST['second_password']) {
            $errors['register-password'] = "Użyto niedozwolonych znaków w haśle";
        }

        if ($firstPassword != $secondPassword) {
            $errors['register-password'] = "Hasła nie są identyczne";
        }

        if (count($errors) == 0) {
            if (!$isEditForm) {
                if ($role == 'user') {
                    (new UserRepository())->saveUserFromRequest(CreateUserRequest::createUser($username, password_hash($firstPassword, PASSWORD_BCRYPT)));
                } else {
                    if ($role == 'administrator') {
                        (new UserRepository())->saveUserFromRequest(CreateUserRequest::createAdministrator($username, password_hash($firstPassword, PASSWORD_BCRYPT)));
                    }
                }
                addAlert("Zarejestrowano nowego użytkownika", "success");
            } else {
                $user->setName($username);
                $user->setRole($role);

                if (strlen($firstPassword) != 0) {
                    $user->setPassword(password_hash($firstPassword, PASSWORD_BCRYPT));
                }

                (new UserRepository())->updateUser($user);
                addAlert("Zaktualizowano użytkownika", "success");
            }

            header('Location: ' . _RHOME . 'users-list/');
            exit();
        }
    } else {
        $errors['register-role'] = "Proszę wybrać rolę i nie próbować wprowadzać modyfikacji w kodzie strony ;)";
    }
} else {
    if (isset($_GET['edit-user'])) {
        $user = (new UserRepository())->getUserById($_GET['edit-user']);
        $username = $user->getName();
        $role = $user->getRole();
        $id = $user->getId();
        $isEditForm = true;
    }
}
