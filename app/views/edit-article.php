<!DOCTYPE html>
<html lang="pl">
<?php require_once(_PRIVATE_PATH . DIRECTORY_SEPARATOR . 'keys.php'); ?>
<?php
// require_once(_VIEWS_PATH . 'partials' . DIRECTORY_SEPARATOR . 'admin-menu.php');
require_once(_VIEWS_PATH . 'partials' . DIRECTORY_SEPARATOR . 'add-picture.php');
showHtmlHead("Dodawanie artykułu", null, null, true);
?>

<body class="admin">
    <script src="<?= _RESOURCES_PATH . 'js' . DIRECTORY_SEPARATOR . 'manage-articles-users.js' ?>"></script>


    <?php
    if($articleToEdit)
    renderHtmlHeader(array("page"=>"edit-article","articleId"=>$articleToEdit->getId()));
    else
    renderHtmlHeader(array());
    ?>
    <main id="content-box">
        <!--changed from content- duplicated id-->
        <h2 class="no-bcg t-center">Dodaj artykuł</h2>
        <form class="edit-article no-bcg t-center" method="post" action="<?= _RHOME ?>edit-article/" enctype="multipart/form-data">
            <div>
                <label for="title">Tytuł</label><br>
                <input type="text" id="title" name="title" placeholder="Wpisz tytuł"  spellcheck="false "autofocus="true" value="<?= $articleToView->getTitle() ?>">
            </div>
            <div class="error">
                <?php
                if (key_exists('title', $errors)) {
                    echo $errors['title'];
                }
                ?>
            </div>

            <label for="content">Treść</label><br>
            <div class="wyswig-parent">
                <div class="loader"></div>
                <textarea id="content" class="wyswig" name="content" placeholder="Wpisz treść" rows=30><?= $articleToView->getContent() ?></textarea>
            </div>
            <div class="error">
                <?php
                if (key_exists('content', $errors)) {
                    echo $errors['content'];
                }
                ?>
            </div>
            <div>
                <input type="checkbox" name="featured" id="featured" <?php if ($articleToView->isFeatured()) echo "checked"; ?>>
                <label for="featured">Polecany</label>
            </div>
            <div id="add-picture-from-file">
                <?php showFileInput($errors); ?>
            </div>
            <?php
            showGalleryInput($articleToView);
            ?>
            <script>
                if ("<?= $articleToView->getPhotoId() ?>" != "picture-from-file") {
                    document.getElementById('add-picture-from-file').style.display = "none";
                }
            </script>
            <a class="button button-red" href="<?= _RHOME ?>admin-panel/">Anuluj</a>
            <input type="hidden" name="edit-article" value="<?= $articleToView->getId() ?>">
            <input type="submit" name="save-button" value=<?= $saveButtonTextToDisplay ?> class="button" onclick="formSubmit()">
            <input type="submit" name="publish-button" value="<?= $publishButtonTextToDisplay ?>" class="button" onclick="formSubmit()">
        </form>
    </main>
                <script>
                    preventExit();
                    </script>
    <!--WYSWIG START-->
    <script src="https://cdn.tiny.cloud/1/<?php echo $tinyId; ?>/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '.wyswig',
            plugins: [
                'advlist autolink lists link image charmap preview anchor',
                'visualblocks code codesample fullscreen',
                'insertdatetime media table paste imagetools wordcount'
            ],
            toolbar: 'styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | subscript superscript | undo redo |',
        });
    </script>
    <!--WYSWIG END-->
    <?php
    showHtmlFooter();
    ?>
</body>
</html>