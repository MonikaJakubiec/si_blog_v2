<!DOCTYPE html>
<html lang="pl">
<?php require_once(_PRIVATE_PATH. DIRECTORY_SEPARATOR . 'keys.php'); ?>
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
    <main id="content-box">
        <!--changed from content- duplicated id-->
        <?php
        showHtmlAdminMenu();

        $articleTitle = $articleContent = '';

        if (isset($_SESSION['title'])) {
            $articleTitle = $_SESSION['title'];
            unset($_SESSION['title']);
        }

        if (isset($_SESSION['content'])) {
            $articleContent = $_SESSION['content'];
            unset($_SESSION['content']);
        }

        $isArticleFeatured = false;
        if (isset($_SESSION['featured'])) {
            if ($_SESSION['featured']) {
                $isArticleFeatured = true;
            }
            unset($_SESSION['featured']);
        }

        $pictureId = "without-picture";
        if (isset($_SESSION['picture-id'])) {
            $pictureId = $_SESSION['picture-id'];
            unset($_SESSION['picture-id']);
        }

        if (isset($_SESSION['status'])) {
            $articleStatus = $_SESSION['status'];
            unset($_SESSION['status']);
        }

        ?>
        <h2 class="no-bcg t-center">Dodaj artykuł</h2>
        <form class="edit-article no-bcg t-center" method="post" action="<?= _RHOME ?>edit-article/" enctype="multipart/form-data">
            <div>
                <label for="title">Tytuł</label><br>
                <input type="text" id="title" name="title" placeholder="Wpisz tytuł" autofocus="true" value="<?= $articleTitle ?>">
            </div>
            <div class="error">
                <?php
                if (key_exists('title', $errors)) {
                    echo $errors['title'];
                }
                ?>
            </div>
            <div id="content-wyswig">
                <label for="content">Treść</label><br>
                <p>textarea<p>
                        <textarea id="content" class="wyswig" name="content" placeholder="Wpisz treść" rows=30><?= $articleContent ?></textarea>
                        <p>contentTiny<p>
                                <textarea id="contentTiny" class="wyswig" name="content" placeholder="Wpisz treść" rows=30><?= $articleContent ?></textarea>
                                <p>contentNice<p>
                                        <textarea id="contentNice" class="wyswig" name="content" placeholder="Wpisz treść" rows=30><?= $articleContent ?></textarea>
            </div>
            <div>
                <input type="checkbox" name="featured" id="featured" <?php if ($isArticleFeatured) echo "checked"; ?>>
                <label for="featured">Polecany</label>
            </div>
            <div id="add-picture-from-file">
                <?php showFileInput($errors); ?>
            </div>
            <?php
            showGalleryInput($pictureId);
            $publishButtonText = "Publikuj";
            if (isset($_GET['edit-article']) && $articleStatus != null && $articleStatus == 'published') $publishButtonText = "Przestań publikować, oznacz jako wersja robocza";
            ?>
            <script>
                if ("<?= $pictureId ?>" != "picture-from-file") {
                    document.getElementById('add-picture-from-file').style.display = "none";
                }
            </script>
            <a class="button button-red" href="<?= _RHOME ?>admin-panel/">Anuluj</a>
            <input type="submit" name="save-button" value=<?= isset($_GET['edit-article']) ? "Zaktualizuj" : "Zapisz" ?> class="button" onclick="formSubmit()">
            <input type="submit" name="publish-button" value="<?= $publishButtonText ?>" class="button" onclick="formSubmit()">

            <input type="hidden" name="edit-article" value="<?php if (isset($_GET['edit-article'])) echo $_GET['edit-article']; ?>">
        </form>
    </main>

    <!--WYSWIG START-->
    <!--local: <script src="<?php echo _RESOURCES_PATH . DIRECTORY_SEPARATOR . 'wyswig' . DIRECTORY_SEPARATOR . 'nicEdit.js'; ?>" type="text/javascript"></script>-->

    <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script type="text/javascript">
        bkLib.onDomLoaded(function() {
            new nicEditor().panelInstance('contentNice');
        });
    </script>

    <script src="https://cdn.tiny.cloud/1/<?php echo $tinyId; ?>/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#contentTiny',
            plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
            toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
            toolbar_mode: 'floating',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
        });
    </script>
    <!--WYSWIG END-->
    <?php
    showHtmlFooter();
    ?>
</body>

</html>