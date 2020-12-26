<?php
require_once(_CLASSES_PATH  . 'Article.php');
require_once(_VIEWS_PATH . 'partials' . DIRECTORY_SEPARATOR . 'article-grid-item.php')
?>
<!DOCTYPE html>
<html lang="pl">
<?php showHtmlHead(_SITE_NAME . "— Strona główna", "Zobacz najnowsze artykuły", null); ?>

<body>
    <?php showHtmlHeader(); ?>

    <section id="main">
        <div class="article-listing">
            <?php
            foreach ($newestArticles as $article) {
                renderArticleElement($article);
            }

            /*for ($counter = 0; $counter < 30; $counter++) {
                $article = NULL;
                renderArticleElement($article);
            }*/

            ?>
        </div>
    </section>
    <nav class="pagination">
        <?php 
        if ($page > 1) : ?>
            <a href="<?php echo _RHOME . '?page=' . (intval($page) - 1); ?>" class="button button-gray">Poprzednia strona</a>
        <?php endif;
        $nextPageNumber = (intval($page) + 1);
        if ($nextPageNumber <= $lastPageNumber) : ?>
            <a href="<?php echo _RHOME . '?page=' . (intval($page) + 1); ?>" class="button">Następna strona</a>
        <?php endif; ?>
    </nav>
    <?php showHtmlFooter(); ?>
</body>

</html>

<script>
    if((new URL(window.location.href)).searchParams.get("logout") != null) {
        alert("Pomyślnie wylogowano");
    }
</script>