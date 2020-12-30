<!DOCTYPE html>
<html lang="pl">
<?php showHtmlHead($articleData["article"]->getTitle(), "Zobacz najnowszy artykuł", "JohnMuller"); ?>

<body class="article">
    <?php showHtmlHeader(); ?>
    <main id="content">
        <div id="main-article">
            <div class="main-article-info">
                <h1><?php echo $articleData["article"]->getTitle(); ?></h1>
                <?php echo $articleData["user"]->getName();?>
                <time datetime="<?= strftime("%F",$articleData["article"]->getPublishedTimestamp()) ?>"><?= strftime("%A, %e %B %Y %H:%M",$articleData["article"]->getPublishedTimestamp()) ?></time>
                <?php /* if ($articleData['photo']->getPath()) :?>
                    <img src="<?php echo $articleData['photo']->getPath(); ?>" alt="">
                    <?php endif; */?>
                    <!--todo: delete--><?php $randomWidth=rand(100,2000); $randomHeight=rand(100,800);$seed=$articleData['article']->getId();?>
                        <img class="featured" src="https://picsum.photos/seed/<?=$seed?>/<?= $randomWidth ?>/<?=$randomHeight?>.webp?" alt="placeholder" title="random image">

                    <!--end todo: delete-->
            </div>
            <article class="main-article-content"><?= html_entity_decode ($articleData['article']->getContent()); ?></article>
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
                                <a href="<?= _RHOME . 'article/' . $article['article']->getId() ?>">
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


            </aside>
        </div>
    </main>

    <?php showHtmlFooter(); ?>
</body>

</html>