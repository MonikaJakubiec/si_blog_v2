<?php if ($articleData != null) :
?>
    <!DOCTYPE html>
    <html lang="pl">
    <?php showHtmlHead($articleData["article"]->getTitle(), $articleMetaDescription, $articleData["user"]->getName()); ?>

    <body class="article">
        <?php renderHtmlHeader($userRole, array("page" => "article", "articleId" => $articleId, "creatorId" => $articleData["user"]->getId())); ?>
        <main id="content-box">
            <div id="main-article">
                <div class="main-article-info">
                    <h1><?php echo $articleData["article"]->getTitle(); ?></h1>
                    <p class="author"><?php echo $articleData["user"]->getName(); ?></p>
                    <time datetime="<?= strftime("%F", $articleData["article"]->getPublishedTimestamp()) ?>"><?= strftime("%A, %e %B %Y %H:%M", $articleData["article"]->getPublishedTimestamp()) ?></time>
                    <?php if ($articleData['article']->getPhotoId() != NULL && $articleData['photo']->getPath()) : ?>
                        <img src="<?php echo $articleData['photo']->getFrontendPath(); ?>" class="featured" alt="<?php echo $articleData['photo']->getAlt(); ?>"><?php endif;
                                                                                                                                                                    ?>
                </div>
                <article class="main-article-content"><?= html_entity_decode($articleData['article']->getContent()); ?></article>
                <aside class="see-also">
                    <div class="sticky">
                        <?php
                        $featuredHeading = "";
                        renderFeaturedSlider($featuredForSliderAside, $featuredHeading);
                        ?>
                        <p class="list-header">Najnowsze wpisy:</p>
                        <?php
                        if (count($newestArticles) > 0) {
                        ?>
                            <ul class="newest">
                                <?php
                                foreach ($newestArticles as $article) {
                                ?>
                                    <li>
                                        <a href="<?= $article['article']->getUrl() ?>">
                                            <?= $article['article']->getTitle() ?>
                                        </a>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        <?php
                        }
                        ?>

                        <?php
                        if (count($userArticles) > 0) {
                        ?>
                            <p class="list-header">Inne wpisy autora <?php echo  $article['user']->getName(); ?>:</p>
                            <ul class="newest author">
                                <?php
                                foreach ($userArticles as $article) {
                                ?>
                                    <li>
                                        <a href="<?= $article['article']->getUrl() ?>">
                                            <?= $article['article']->getTitle() ?>
                                        </a>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        <?php
                        }
                        ?>
                    </div>
                </aside>
            </div>
        </main>

        <?php showHtmlFooter(); ?>
    </body>

    </html>
<?php endif; ?>