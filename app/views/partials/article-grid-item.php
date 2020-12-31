<?php function renderArticleElement($article){
?>
<article class="grid-element">
<?php $lorem='Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores ducimus ab, voluptates provident porro aspernatur quod excepturi voluptas, facilis inventore dicta eaque ratione iure neque laudantium quis distinctio voluptatem animi';
$tempRand=rand(0,100);
?>

<?php $randomWidth=rand(100,1600); $randomHeight=rand(100,1600);$seed=$article['article']->getId();?>
                        <img class="featured" src="https://picsum.photos/seed/<?=$seed?>/<?= $randomWidth ?>/<?=$randomHeight?>.webp?" alt="placeholder" title="random image">


<h2><?php echo $article['article']->getTitle();?></h2>
<p class="post-excerpt"><?php echo substr(Strip_tags(html_entity_decode($article['article']->getContent())), 0, 200);?>...</p>
<a href="<?php echo _RHOME . 'article/' . $article['article']->getId(); ?>/" class="button read-more m-auto">Czytaj dalej!</a>
</article>
<?php
}?>