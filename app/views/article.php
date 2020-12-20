<!DOCTYPE html>
<html lang="pl">
<?php showHtmlHead("Tytuł artykułu", "Zobacz najnowszy artykuł", "JohnMuller"); ?>

<body>
    <?php showHtmlHeader(); ?>
    <main id="content">
        <div id="main-article">
            <div class="main-article-info">
                <h1><?php echo $articleData->getTitle(); ?></h1>
                <?php if ($articleData->getPhotoId()) : ?>
                    <img src="<?php $articleData->getPhotoId(); ?>" alt="">
                    <?php endif; ?>
                    <!--todo: delete-->
                        <img class="featured" src="https://via.placeholder.com/<?php echo rand(1500,1600);?>x<?php echo rand(400,600);?>" alt="">
                    <!--end todo: delete-->
            </div>
            <article class="main-article-content"><?php echo $articleData->getContent(); ?></article>
            <aside class="see-also">
                <p>Zobacz najnowsze wpisy:</p>
                <?php
                if (count($allArticles) > 0) {
                ?>
                    <ul class="newest">
                        <?php
                        foreach ($allArticles as $article) {
                        ?>
                            <li>
                                <a href="<?php echo _RHOME . 'article/' . $article->getId(); ?>">
                                    <?php echo $article->getTitle(); ?>
                                </a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                <?php
                }

                ?>


            </aside>
        </div>
    </main>

    <?php showHtmlFooter(); ?>
</body>

</html>