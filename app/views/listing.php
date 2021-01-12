<?php
require_once(_CLASSES_PATH  . 'Article.php');
require_once(_VIEWS_PATH . 'partials' . DIRECTORY_SEPARATOR . 'article-grid-item.php');
require_once(_ACTIONS_PATH  . 'functions.php');
?>
<!DOCTYPE html>
<html lang="pl">
<?php showHtmlHead("Strona główna", "Zobacz najnowsze artykuły", null); ?>

<body>
    <?php renderHtmlHeader($userRole,array("page"=>"listing")); ?>
    <section id="main">
   
        <?php
         renderFeaturedSlider($featuredForSlider,"");
        if (is_array($newestArticles)) {
            if (count($newestArticles) > 0) {
        ?>
                <div class="article-listing">
                    <?php
                    foreach ($newestArticles as $article) {
                        renderArticleElement($article);
                    }
                    ?>
                </div>
        <?php
            } else {
                echo '<p class="t-center">Wystąpił błąd - nie znaleziono artykułów.</p>';
            }
        } else {
            echo '<p class="t-center">Wystąpił błąd. Przepraszamy. Spróbuj ponownie później.</p>';
        }
        ?>
    </section>
    <nav class="pagination">
        <?php
        if ($page > 1) : ?>
            <a href="<?= _RHOME . '?page=' . (intval($page) - 1) ?>" class="button button-gray">Poprzednia strona</a>
        <?php endif;
        $nextPageNumber = (intval($page) + 1);
        if ($nextPageNumber <= $lastPageNumber) : ?>
            <a href="<?= _RHOME . '?page=' . (intval($page) + 1) ?>" class="button">Następna strona</a>
        <?php endif; ?>
    </nav>
    <?php showHtmlFooter(); ?>
</body>
</html>