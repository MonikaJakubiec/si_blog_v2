<!DOCTYPE html>
<html lang="en">
<?php
require_once(_VIEWS_PATH . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'head.php');
require_once(_VIEWS_PATH . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'header.php');
require_once(_VIEWS_PATH . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'footer.php');
require_once(_VIEWS_PATH . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'admin-menu.php');

showHtmlHead("Dodawanie artykułu", null, null, true);
?>

<body class="admin">
    <?php
    showHtmlHeader();
    ?>
    <main id="content">
        <?php  showHtmlAdminMenu();?>
        <h2 class="no-bcg t-center">Dodaj artykuł</h2>
    <form class="edit-article no-bcg t-center" method="post" action="index.php?page=article-validation">
        <label for="title">Tytuł</label><br>
        <input type="text" value="" id="title" name="title" placeholder="Wpisz tytuł" autofocus="true" required><br>
        <label for="title">Treść</label><br>
        <textarea id="content" name="content" placeholder="Wpisz treść" required rows=30></textarea><br>
        <input type="submit" value="Dodaj" class="button">
    </form>
    </main>
    <?php
    showHtmlFooter();
    ?>
</body>

</html>