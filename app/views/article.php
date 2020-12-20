<!DOCTYPE html>
<html lang="pl">
<?php showHtmlHead($articleData["article"]->getTitle(), "Zobacz najnowszy artykuł", "JohnMuller"); ?>

<body>
    <?php showHtmlHeader(); ?>
    <main id="content">
        <div id="main-article">
            <div class="main-article-info">
                <h1><?php echo $articleData["article"]->getTitle(); ?></h1>
                <time datetime="<?php echo $articleData["article"]->getPublishedTimestamp();?>"><?php echo  date('d.m.Y',strtotime($articleData["article"]->getPublishedTimestamp())); ?></time>
                <?php /* if ($articleData['photo']->getPath()) :?>
                    <img src="<?php echo $articleData['photo']->getPath(); ?>" alt="">
                    <?php endif; */?>
                    <!--todo: delete-->
                        <img class="featured" src="https://via.placeholder.com/<?php echo rand(1500,1600);?>x<?php echo rand(400,600);?>" alt="">
                    <!--end todo: delete-->
            </div>
            <article class="main-article-content"><?php echo $articleData['article']->getContent(); ?></article>
            <aside class="see-also">
                <p class="list-header">Zobacz najnowsze wpisy:</p>
                <?php
                if (count($newestArticles) > 0) {
                ?>
                    <ul class="newest">
                        <?php
                        foreach ($newestArticles as $article) {
                        ?>
                            <li>
                                <a href="<?php echo _RHOME . 'article/' . $article['article']->getId(); ?>">
                                    <?php echo $article['article']->getTitle(); ?>
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