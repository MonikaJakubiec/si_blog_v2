<!DOCTYPE html>
<html lang="en">
<?php
require_once(_VIEWS_PATH . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'head.php');
require_once(_VIEWS_PATH . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'header.php');
require_once(_VIEWS_PATH . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'footer.php');
require_once(_VIEWS_PATH . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'admin-menu.php');

showHtmlHead("Dodawanie artykułu");
?>

<body>
    <?php
    showHtmlHeader();
    showHtmlAdminMenu()
    ?>
    <form method="post" action="index.php?page=article-validation">
        <label for="title">Tytuł</label><br>
        <input type="text" value="" id="title" name="title" placeholder="Wpisz tytuł"><br>
        <label for="title">Treść</label><br>
        <textarea id="content" name="content" placeholder="Wpisz treść"></textarea><br>
        <input type="submit" value="Dodaj">
    </form>
    <?php
    showHtmlFooter();
    ?>
</body>

</html>