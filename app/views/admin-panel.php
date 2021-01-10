<!DOCTYPE html>
<html lang="pl">
<?php
showHtmlHead("Panel administracyjny", null, null, true);
?>

<body class="admin">
    <?php
    renderHtmlHeader(array("page" => "admin-panel"));
    ?>
    <!-- TODO -->
    <div style="display: flex; flex-wrap: wrap; justify-content: center;">
        <div style="margin: 30px; width: 400px; height: 400px; text-align: center; background-color: darkgreen;">
            <a style="font-size: 30px; text-align: center; text-decoration: none; color: white; display: block; padding: 179px 0px;" href="<?= _RHOME ?>articles-list/">Lista artykułów</a>
        </div>
        <div style="margin: 30px; width: 400px; height: 400px; text-align: center; background-color: darkgreen;">
            <a style="font-size: 30px; text-align: center; text-decoration: none; color: white; display: block; padding: 179px 0px;" href="<?= _RHOME ?>users-list">Lista użytkowników</a>
        </div>
    </div>

    <?php
    showHtmlFooter();
    ?>

</body>

</html>