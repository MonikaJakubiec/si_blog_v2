<?php
$errors = [];

if(isset($_POST['username'])) {
    $username = testInput($_POST['username']);
    $password = testInput(($_POST['password']));

    $user = (new UserRepository)
}

function testInput($data) { 
    $data = trim($data);
    $data = stripslashes($data); //zabezpieczenia cudzysłowów
    $data = htmlspecialchars($data); //konwersja znaków specjalnych HTML do encji HTML
    return $data;
  }
?>