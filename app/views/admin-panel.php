<!DOCTYPE html>
<html lang="pl">
<?php
showHtmlHead("Panel administracyjny",null,null,true,false);
?>

<body class="admin">
    <?php
    renderHtmlHeader($userRole,array("page" => "admin-panel"));
    ?>
    <div class="tiles boxed">
        <div class="tile">
            <a href="<?= _RHOME ?>articles-list/">Lista artykułów</a>
        </div>
        <?php if ($userRole == 'administrator') : ?>
            <div class="tile">
                <a href="<?= _RHOME ?>users-list/">Lista użytkowników</a>
            </div>
        <?php endif; ?>
        <div class="tile">
            <a href="<?= _RHOME ?>add-article/">Dodaj artykuł</a>
        </div>
        <?php if ($userRole == 'administrator') : ?>
            <div class="tile">
                <a href="<?= _RHOME ?>register/">Dodaj użytkownika</a>
            </div>
        <?php endif; ?>
    </div>

    <?php
    showHtmlFooter();
    ?>

</body>

</html>