<?php

/**
 * Wyświetla slider polecanych artykułów
 *
 * @param array $featuredArticlesData informacje o slajderze (zwracane z funkcji prepareFeaturedForSLider)
 * @param string $heading nagównek nad slajderem
 * @return void
 */
function renderFeaturedSlider($featuredArticlesData, $heading = "")
{
    if (is_array($featuredArticlesData) && count($featuredArticlesData) > 0) {
        $featuredArticles = $featuredArticlesData[0];
        if ($featuredArticles == null)
            return false;
        $numOfSlides = count($featuredArticles);
        $sliderRandomId = $featuredArticlesData[1];
        $numOfSimultaneousSlides = $featuredArticlesData[2];
        if (count($featuredArticles) > 0) {
            $numOfSimultaneousSlides = min($numOfSimultaneousSlides, count($featuredArticles));
        }
?>
        <div id="featured-slider">
            <?php echo $heading; ?>
            <div class="slider" id="<?php echo $sliderRandomId; ?>" style="width:<?php echo number_format($numOfSlides * 100 / $numOfSimultaneousSlides, 2, '.', ''); ?>%">
                <?php
                foreach ($featuredArticles as $articleData) {
                ?>
                    <a href="<?php echo $articleData['article']->getUrl(); ?>">
                        <span class="slide" style="width:<?php echo number_format(100 / $numOfSlides, 2, '.', '') ?>%">
                            <?php
                            if ($articleData['article']->getPhotoId() != NULL) {
                                echo '<img src="' . $articleData['photo']->getFrontendPath() . '" alt="' . $articleData['photo']->getAlt() . '">';
                            }
                            ?>
                            <span class="title"><span class="text"><?php echo $articleData['article']->getTitle(); ?></span></span>
                        </span>
                    </a>
                <?php
                }
                ?>
            </div>
        </div>
<?php
    }
}
