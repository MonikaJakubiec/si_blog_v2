<!DOCTYPE html>
<html lang="pl">
<?php
require_once(_VIEWS_PATH . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'head.php');
require_once(_VIEWS_PATH . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'header.php');
require_once(_VIEWS_PATH . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'footer.php');

showHtmlHead();
?>

<body>
    <?php
    showHtmlHeader();
    ?>
    <main id="content">
        <div class="no-bcg t-center">
            <p>404 PAGE NOT FOUND</p>
            <p>Przepraszamy podana strona nie istnieje :(</p>
        </div>
    </main>
    <?php
    showHtmlFooter();
    ?>
</body>

</html>