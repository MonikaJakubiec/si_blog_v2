<!DOCTYPE html>
<html lang="pl">

<?php
require_once(_VIEWS_PATH . 'partials' . DIRECTORY_SEPARATOR . 'admin-menu.php');
require_once(_VIEWS_PATH . 'partials' . DIRECTORY_SEPARATOR . 'add-picture.php');
showHtmlHead("Dodawanie artykułu", null, null, true);
?>

<body class="admin">
    <script src="<?= _RESOURCES_PATH . 'js' . DIRECTORY_SEPARATOR . 'manage-article.js' ?>"></script>
    <script src="<?= _RESOURCES_PATH . 'js' . DIRECTORY_SEPARATOR . 'unload-support.js' ?>"></script>
    <?php
    showHtmlHeader();
    ?>
    <main id="content">
        <?php
        showHtmlAdminMenu();
        
        $articleTitle = $articleContent = '';

        if(isset($_SESSION['title'])) {
            $articleTitle = $_SESSION['title'];
            unset($_SESSION['title']);
        }

        if(isset($_SESSION['content'])) {
            $articleContent = $_SESSION['content'];
            unset($_SESSION['content']);
        }

        $isArticleFeatured = false;
        if(isset($_SESSION['featured'])) {
            if($_SESSION['featured']){
                $isArticleFeatured = true;
            }
            unset($_SESSION['featured']);
        }

        $pictureId = "without-picture";
        if(isset($_SESSION['picture-id'])) {
            $pictureId = $_SESSION['picture-id'];
            unset($_SESSION['picture-id']);
        }
        
        ?>
        <h2 class="no-bcg t-center">Dodaj artykuł</h2>
        <form class="edit-article no-bcg t-center" method="post" action="edit-article" enctype="multipart/form-data">
            <div>
                <label for="title">Tytuł</label><br>
                <input type="text" value="" id="title" name="title" placeholder="Wpisz tytuł" autofocus="true" value="<?=$articleTitle?>">
            </div>
            <div class="error">
                <?php
                if (key_exists('title', $errors)) {
                    echo $errors['title'];
                }
                ?>
            </div>
            <div>
                <label for="content">Treść</label><br>
                <textarea id="content" name="content" placeholder="Wpisz treść" rows=30><?=$articleContent?></textarea>
            </div>
            <div>
                <input type="checkbox" name="featured" id="featured" <?php if($isArticleFeatured) echo "checked"; ?>>
                <label for="featured">Polecany</label>
            </div>
            <div id="add-picture-from-file">
                <?php showFileInput($errors); ?>
            </div>
            <?php showGalleryInput($pictureId); ?>
            <script>
                if("<?=$pictureId?>" != "picture-from-file") {
                    document.getElementById('add-picture-from-file').style.display = "none";
                }
            </script>

                <input type="submit" name="save-button" value="Zapisz" class="button" onclick="formSubmit()">
                <input type="submit" name="publish-button" value="Publikuj" class="button" onclick="formSubmit()">


    </main>
    <?php
    showHtmlFooter();
    ?>
</body>

</html>