<?php function renderArticleElement($article){
?>
<article class="grid-element">
<?php $lorem='Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores ducimus ab, voluptates provident porro aspernatur quod excepturi voluptas, facilis inventore dicta eaque ratione iure neque laudantium quis distinctio voluptatem animi';
$tempRand=rand(0,100);
?>
<h2><?php echo substr($lorem,$tempRand, rand($tempRand+1,$tempRand+100));?></h2>
<img src="https://via.placeholder.com/160x90" alt="">
<p class="post-excerpt"><?php echo substr($lorem, rand(0,50), rand(0,strlen($lorem)-50));?></p>
<a href="#" class="button read-more m-auto">Czytaj dalej!</a>
</article>
<?php
}?>