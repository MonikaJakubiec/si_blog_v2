<?php function renderArticleElement($articleData)
{
?>
    <article class="grid-element">
        <?php $randomWidth = rand(100, 1600);
        $randomHeight = rand(100, 1600);
        $seed = $articleData['article']->getId(); ?>
        <div class="image-place">
            <?php
            if ($articleData['article']->getPhotoId() != NULL) {
                echo '<img src="' . $articleData['photo']->getFrontendPath() . '" class="featured" alt="' . $articleData['photo']->getAlt() . '">';
            }
            ?>
        </div>
        <h2><?php echo $articleData['article']->getTitle(); ?></h2>
        <?php
        if ($articleData['article']->getPhotoId() != NULL) {
            $excerptLength = 200;
        } else {
            $excerptLength = 400;
        }
        ?>
        <p class="post-excerpt"><?php echo trim(substr(Strip_tags(html_entity_decode($articleData['article']->getContent())), 0, $excerptLength)); ?>...</p>
        <a href="<?php echo $articleData['article']->getUrl(); ?>" class="button read-more m-auto">Czytaj dalej!</a>
    </article>
<?php
} ?>