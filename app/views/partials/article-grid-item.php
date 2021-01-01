<?php function renderArticleElement($articleData)
{
?>
    <article class="grid-element">
        <?php $randomWidth = rand(100, 1600);
        $randomHeight = rand(100, 1600);
        $seed = $articleData['article']->getId(); ?>
        <!-- <img class="featured" src="https://picsum.photos/seed/<?= $seed ?>/<?= $randomWidth ?>/<?= $randomHeight ?>.webp?" alt="placeholder" title="random image"> -->
        <div class="image-place">
        <?php
        if ($articleData['article']->getPhotoId() != NULL) {
            echo '<img src="' . $articleData['photo']->getFrontendPath() . '" class="featured" alt="' . $articleData['photo']->getAlt() . '">';
        }
        ?>
        </div>
        <h2><?php echo $articleData['article']->getTitle(); ?></h2>
        <p class="post-excerpt"><?php echo substr(Strip_tags(html_entity_decode($articleData['article']->getContent())), 0, 200); ?>...</p>
        <a href="<?php echo $articleData['article']->getUrl(); ?>" class="button read-more m-auto">Czytaj dalej!</a>
    </article>
<?php
} ?>