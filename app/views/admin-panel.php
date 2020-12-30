<!DOCTYPE html>
<html lang="pl">
<?php
require_once(_VIEWS_PATH . 'partials' . DIRECTORY_SEPARATOR . 'admin-menu.php');
showHtmlHead("Panel administratora", null, null, true);
?>

<body class="admin">
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
                foreach ($allArticles as $articleData) {
                ?>
                    <tr class="article <?php if (!$articleData['article']->isPublished()) {
                                            echo " not-published";
                                        } ?>">>
                        <td class="title"><?php echo $articleData['article']->getTitle(); ?></td>
                        <td><?php echo $articleData['user']->getName(); ?></td>
                        <td><?php if ($articleData['article']->isPublished()) {
                                echo strftime("%c", $articleData['article']->getPublishedTimestamp());
                            } else {
                                echo "nie opublikowano";
                            } ?></td>
                        <td class="actions">
                        <?php if ($articleData['article']->isPublished()):?><a class="button" href="<?= _RHOME ?>article/<?= $articleData['article']->getId() ?>">Zobacz</a><?php endif;?>
                            <a class="button" href="<?= _RHOME ?>edit-article/?edit-article=<?= $articleData['article']->getId() ?>">Edytuj</a>
                            <a class="button button-red" href="#" onClick="confirmArticleDelete('<?= _RHOME ?>', <?= $articleData['article']->getId() ?>);">Usuń</a></td>
                    </tr>
                <?php
                } ?>

            </tbody>
        </table>
    </main>
    <?php
    showHtmlFooter();
    ?>
</body>

</html>
<script>
    window.onload = addArtStatusAlert;
</script>