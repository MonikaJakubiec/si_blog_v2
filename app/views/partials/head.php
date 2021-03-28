<?php

/**
 * Wyświetla element head HTML
 * @param string $title tytuł strony
 * @param string $desription opis strony
 * @param string $author autor artykułu
 * @param string $appendSiteNameToTitle doda nazwe blogu do tytulu 
 * @param string $allowIndex czy strona ma byc indeksowana przez roboty
 */
function showHtmlHead($title = "", $description = null, $author = null, $appendSiteNameToTitle = true, $allowIndex = true)
{

?>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title;
                if ($appendSiteNameToTitle) echo ' | ' . _SITE_NAME; ?></title>
        <link rel="stylesheet" href="<?php echo getFrontendPath(_RESOURCES_PATH); ?>css/style.css">
        <style>
            body, header {
                background-image: url("<?php echo getFrontendPath(_RESOURCES_PATH) . "static/rainbow.jpg"; ?>");

            }
        </style>
        <?php if (isset($_SESSION['login'])) : ?>
            <link rel="stylesheet" href="<?php echo getFrontendPath(_RESOURCES_PATH); ?>css/style-admin.css">
            <script src="<?= getFrontendPath(_RESOURCES_PATH . 'js/manage-articles-users.js') ?>"></script>
        <?php endif; ?>
        <link rel="stylesheet" type="text/css" href="<?php echo getFrontendPath(_RESOURCES_PATH); ?>css/prism.css">
        <script src="<?= getFrontendPath(_RESOURCES_PATH) . 'js/prism.js' ?>"></script>
        <script src="<?= getFrontendPath(_RESOURCES_PATH) . 'js/js.js' ?>"></script>
        <?php if ($description) : ?>
            <meta name="description" content="<?php echo $description; ?>">
        <?php endif; ?>
        <?php if ($author) : ?>
            <meta name="author" content="<?php echo $author; ?>">
        <?php endif; ?>
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo getFrontendPath(_RESOURCES_PATH) . "static/favicon.ico"; ?>">
        <meta name="robots" content="<?php
                                        if ($allowIndex) echo 'index';
                                        else echo 'noindex';
                                        ?>" />
        <?php renderHeadStyle(); ?>
    </head><?php } ?>