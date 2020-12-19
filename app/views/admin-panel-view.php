<!DOCTYPE html>
<html lang="pl">
<?php
if (isset($_GET['added-article'])) {
    if ($_GET['added-article'] == 'true') {
?>
        <script>
            var message = "Pomyślnie dodano artykuł";
        </script>
    <?php
    } else {
    ?>
        <script>
            var message = "Nie udało się dodać artykułu z powodu istniejącego takiego samego tytułu na blogu";
        </script>
<?php
    }
}

require_once(_VIEWS_PATH . 'partials' . DIRECTORY_SEPARATOR . 'admin-menu.php');
showHtmlHead("Panel administratora", null, null, true,);
?>

<body class="admin" onload="if(typeof message !== 'undefined') alert(message);">
    <?php
    showHtmlHeader();
    ?>
    <script src="<?= _RESOURCES_PATH . 'js' . DIRECTORY_SEPARATOR . 'manage-article.js' ?>"></script>

    <main id="content">
        <?php showHtmlAdminMenu(); ?>
        <table id="articles">
            <thead>
                <tr>
                    <th>Tytuł</th>
                    <th>Autor</th>
                    <th>Data publikacji</th>
                    <th class="actions">Akcje</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $lorem = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores ducimus ab, voluptates provident porro aspernatur quod excepturi voluptas, facilis inventore dicta eaque ratione iure neque laudantium quis distinctio voluptatem animi';
                $tempRand = rand(0, 100);


                for ($i = 0; $i < 10; $i++) { ?>
                    <tr>
                        <td><?php $start = rand(0, 50);
                            echo substr($lorem, $start, rand(1, 50)); ?></td>
                        <td><?php $start = rand(0, 50);
                            echo substr($lorem, $start, rand(8, 20)); ?></td>
                        <td><?php $start = rand(0, 0);
                            echo substr($lorem, $start, rand(8, 8)); ?></td>
                        <td class="actions">
                            <a class="button" href="<?= _RHOME ?>preview-article/">Zobacz artykuł</a>
                            <a class="button" href="<?= _RHOME ?>edit-article/">Edytuj artykuł</a>
                            <a class="button button-red" href="#" onClick="confirmArticleDelete('<?= _RHOME ?>');">Usuń artykuł</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
    <?php
    showHtmlFooter();
    ?>
</body>
</html>