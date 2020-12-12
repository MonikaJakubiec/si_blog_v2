<!DOCTYPE html>
<html lang="en">
<?php
require_once(_VIEWS_PATH . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'head.php');
showHtmlHead("Dodawanie artykułu");
include _VIEWS_PATH . DIRECTORY_SEPARATOR . 'admin-menu.php';
?>
<body>
    <form method="post" action="index.php?page=article-validation">
        <label for="title" >Tytul</label>
        <input type="text" value="" id="title" name="title" placeholder="Wpisz tytuł"><br>
        <label for="title" >Treść</label>
        <textarea id="content" name="content" placeholder="Wpisz treść"></textarea><br>
        <input type="submit" value="Dodaj">
    </form>
</body>
</html>