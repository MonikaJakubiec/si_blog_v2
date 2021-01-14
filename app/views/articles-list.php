<!DOCTYPE html>
<html lang="pl">
<?php

showHtmlHead("Lista artykułów", null, null, true, false);
?>

<body class="admin">
    <?php
    renderHtmlHeader($userRole, array("page" => "articles-list"));
    ?>


    <main id="content-box">
        <?php
        if (count($allArticles) > 0) {
        ?>
            <table id="articles">
                <thead>
                    <tr>
                        <th><a href="?sortBy=id&sortDir=<?= $newSortDirections['id'] ?>" class="sortable" title="Sortuj po id">ID</a></th>
                        <th class="title"><a href="?sortBy=title&sortDir=<?= $newSortDirections['title'] ?>" class="sortable" title="Sortuj po tytule">Tytuł</a></th>
                        <th><a href="?sortBy=author&sortDir=<?= $newSortDirections['author'] ?>" class="sortable" title="Sortuj po autorze">Autor</a></th>
                        <th><a href="?sortBy=publishedTime&sortDir=<?= $newSortDirections['publishedTime'] ?>" class="sortable" title="Sortuj po dacie publikacji">Data publikacji</a></th>
                        <th class="actions">Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    foreach ($allArticles as $articleData) {
                    ?>
                        <tr class="article <?php if (!$articleData['article']->isPublished()) {
                                                echo "not-published";
                                            } ?>">
                            <td><?php echo $articleData['article']->getId(); ?></td>
                            <td class="title"><?php echo $articleData['article']->getTitle(); ?></td>
                            <td><?php echo $articleData['user']->getName(); ?></td>
                            <td><?php if ($articleData['article']->isPublished()) {
                                    echo strftime("%c", $articleData['article']->getPublishedTimestamp());
                                } else {
                                    echo "nie opublikowano";
                                } ?></td>
                            <td class="actions">
                                <?php if ($articleData['article']->isPublished()) : ?><a class="button" href="<?= $articleData['article']->getUrl() ?>">Zobacz</a><?php endif; ?>
                                <a class="button" href="<?= $articleData['article']->getEditUrl() ?>">Edytuj</a>
                                <a class="button button-red" href="#" onClick="confirmArticleDelete('<?= _RHOME ?>', <?= $articleData['article']->getId() ?>);">Usuń</a>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<div class=\"t-center alert\"><h2>Nie masz jeszcze artykułów</h2><a class=\"button \" href=\"" . _RHOME . "add-article/" . "\">Dodaj pierwszy!</a></div>";
                }
                ?>

                </tbody>
            </table>
    </main>
    <?php
    showHtmlFooter();
    ?>
</body>

</html>