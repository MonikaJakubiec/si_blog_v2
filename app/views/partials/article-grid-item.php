<?php function renderArticleElement($article){
?>
<article class="grid-element">
<?php $lorem='Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores ducimus ab, voluptates provident porro aspernatur quod excepturi voluptas, facilis inventore dicta eaque ratione iure neque laudantium quis distinctio voluptatem animi';
$tempRand=rand(0,100);
?>


<img class="featured" src="https://via.placeholder.com/<?php echo rand(100,1600);?>x<?php echo rand(100,1600);?>" alt="">

<h2><?php echo $article['article']->getTitle();?></h2>
<p class="post-excerpt"><?php echo substr(Strip_tags($article['article']->getContent()), 0, 200);?>...</p>
<a href="<?php echo _RHOME . 'article/' . $article['article']->getId(); ?>/" class="button read-more m-auto">Czytaj dalej!</a>
</article>
<?php
}?>