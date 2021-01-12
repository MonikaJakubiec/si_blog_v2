<?php 
/**
 * Wyświetla element head HTML
 * @param string $title tytuł strony
 * @param string $desription opis strony
 * @param string $author autor artykułu
 */
function showHtmlHead($title="",$description=null,$author=null,$adminCss=null)
{

    ?><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title.' | '._SITE_NAME;?></title>
    <link rel="stylesheet" href="<?php echo getFrontendPath(_RESOURCES_PATH);?>css/style.css">
    <?php if(isset($_SESSION['login'])):?>
        <link rel="stylesheet" href="<?php echo getFrontendPath(_RESOURCES_PATH);?>css/style-admin.css">
    <?php endif;?>
    <link rel="stylesheet" type="text/css" href="<?php echo getFrontendPath(_RESOURCES_PATH);?>css/prism.css">
    <script src="<?= getFrontendPath(_RESOURCES_PATH) . 'js/prism.js' ?>"></script>
    <script src="<?= getFrontendPath(_RESOURCES_PATH) . 'js/js.js' ?>"></script>
    <?php if($description):?>
        <meta name="description" content="<?php echo $description;?>">
    <?php endif;?>
    <?php if($author):?>
        <meta name="author" content="<?php echo $author;?>">
    <?php endif;?>
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo getFrontendPath(_RESOURCES_PATH)."static/favicon.ico";?>">
    <?php echo "<!--custom style-->";renderHeadStyle();?>
</head><?php }?>
