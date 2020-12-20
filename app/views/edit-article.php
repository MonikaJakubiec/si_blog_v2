<!DOCTYPE html>
<html lang="pl">

<?php
require_once(_VIEWS_PATH . 'partials' . DIRECTORY_SEPARATOR . 'admin-menu.php');
require_once(_VIEWS_PATH . 'partials' . DIRECTORY_SEPARATOR . 'add-picture.php');
showHtmlHead("Dodawanie artykułu", null, null, true);
?>

<body class="admin">
    <script src="<?= _RESOURCES_PATH . 'js' . DIRECTORY_SEPARATOR . 'manage-article.js' ?>"></script>
    <?php
    showHtmlHeader();
    ?>
    <main id="content">
        <?php showHtmlAdminMenu(); ?>
        <h2 class="no-bcg t-center">Dodaj artykuł</h2>
        <form class="edit-article no-bcg t-center" method="post" action="edit-article" enctype="multipart/form-data">
            <div>
                <label for="title">Tytuł</label><br>
                <input type="text" value="" id="title" name="title" placeholder="Wpisz tytuł" autofocus="true">
            </div>
            <div>
                <label for="title">Treść</label><br>
                <textarea id="content" name="content" placeholder="Wpisz treść" rows=30></textarea>
            </div>
            <div style="float:left; width: 800px; padding-left: 50px;">
                <?php showGalleryInput() ?>
            </div>
            <div id="add-picture-from-file" style="float: right; padding-right: 50px; display: none;">
                <?php showFileInput($errors); ?>
            </div>
            <div style="clear: both;"></div>
            <div>
                <input type="submit" value="Dodaj" class="button">
            </div>
    </main>
    <?php
    showHtmlFooter();
    ?>
</body>

</html>