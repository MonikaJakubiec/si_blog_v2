<?php
require_once(_VIEWS_PATH . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'head.php');
require_once(_VIEWS_PATH . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'header.php');
require_once(_VIEWS_PATH . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'footer.php');
require_once(_VIEWS_PATH . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'article-grid-item.php');
require_once(_CLASS_PATH . DIRECTORY_SEPARATOR . 'Article.php');
?>
<!DOCTYPE html>
<html lang="pl">
<?php showHtmlHead(_SITE_NAME."— Strona główna", "Zobacz najnowsze artykuły", null); ?>

<body>
    <?php showHtmlHeader(); ?>

    <section id="main">
        <div class="article-listing">
            <?php
            for ($counter = 0; $counter < 30; $counter++) {
                $article = new Article();
                renderArticleElement($article);
            }

            ?>
        </div>

    </section>
    <?php showHtmlFooter(); ?>
</body>

</html>