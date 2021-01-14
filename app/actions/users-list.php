<?php
redirectIfNotAdmin($userRole);

require_once _REPOSITORIES_PATH . 'UserRepository.php';

$userRepository = new UserRepository();

//usuwanie uzytkowanika na podstawie id z GET
if (isset($_GET['delete-user'])) {
    $userRepository->deleteUser($_GET['delete-user']);
}

$newSortDirections = array(
    "id" => "ASC",
    "username" => "ASC",
    "role" => "ASC",
);

if (isset($_GET['sortBy'])) {
    $sortColumn = $_GET['sortBy'];
    $sortDirection = isset($_GET['sortDir']) ? $_GET['sortDir'] : "ASC";

    //zamiana kierunku sortowania
    if (array_key_exists($sortColumn, $newSortDirections)) {
        if ($sortDirection == "ASC") //zabezpieczenie na wypadek wpisania innej opcji
            $newSortDirections[$sortColumn] = "DESC";
    }
} else //nie zdefiniowano sortowania
{
    $sortColumn = "id";
    $sortDirection = "DESC";
}

$sortArray = array([$sortColumn, $sortDirection]);
$allUsers = $userRepository->getAllUsers($sortArray);
?>