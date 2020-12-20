<?php
require_once(_CLASSES_PATH  . 'Article.php');
require_once(_VIEWS_PATH .'partials'.DIRECTORY_SEPARATOR.'article-grid-item.php')
?>
<!DOCTYPE html>
<html lang="pl">
<?php showHtmlHead(_SITE_NAME."— Strona główna", "Zobacz najnowsze artykuły", null); ?>

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
    <?php showHtmlFooter(); ?>
</body>

</html>