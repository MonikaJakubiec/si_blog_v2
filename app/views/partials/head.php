<?php 
/**
 * Wyświetla element head HTML
 * @param string $title tytuł strony
 * @param string $desription opis strony
 * @param string $author autor artykułu
 */
function showHtmlHead($title=_SITE_NAME,$description=null,$author=null)
{?><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title;?></title>
    <link rel="stylesheet" href="app/resources/css/style.css"><?php /* TODO: change path*/?>
    <?php if($description):?>
        <meta name="description" content="<?php echo $description;?>">
    <?php endif;?>
    <?php if($author):?>
        <meta name="author" content="<?php echo $author;?>">
    <?php endif;?>
</head><?php }?>
