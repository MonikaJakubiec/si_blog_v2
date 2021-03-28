<?php
function renderHtmlHeader($userRole, $pageInfo = array())
{

?><header id="header">
        <?php renderLoggedInMenu($pageInfo, $userRole);
        ?>

        <div class="boxed">
            <h1><a href="<?= _RHOME ?>"><?= _SITE_NAME ?></a></h1>
            <?php if(!isset($_SESSION['login'])):?>
            <a class="login-button button" href="<?= _RHOME ?>admin-panel/">Zaloguj się</a>
            <?php endif;?>
        </div>
    </header>


    <?php
    renderAlerts();
}

function renderLoggedInMenu($pageInfo, $userRole)
{
    if (isset($_SESSION['login'])) {
        if (array_key_exists("page", $pageInfo))
            $page = $pageInfo["page"];
        else
            $page = null;
    ?>
        <div id="admin-header-menu">
            <div class="links">
                <a href="<?= _RHOME ?>admin-panel/" <?php if ($page == "admin-panel") echo "class=\"current\""; ?>>Panel administracyjny</a>
                <a href="<?= _RHOME ?>articles-list/" <?php if ($page == "articles-list") echo "class=\"current\""; ?>>Lista artykułów</a>
                <a href="<?= _RHOME ?>add-article/" <?php if ($page == ">add-article") echo "class=\"current\""; ?>>Dodaj artykuł</a>
                <?php if ($userRole == 'administrator') : ?><a href="<?= _RHOME ?>users-list/" <?php if ($page == "users-list") echo "class=\"current\""; ?>>Lista użytkowników</a><?php endif; ?>
                <?php if ($userRole == 'administrator') : ?><a href="<?= _RHOME ?>register/" <?php if ($page == "register") echo "class=\"current\""; ?>>Dodaj użytkownika</a><?php endif; ?>
                <?php
                $articleId = null;
                if (isset($pageInfo["articleId"]))
                    $articleId = $pageInfo["articleId"];

                $articleCreatorId = null;
                if (isset($pageInfo["creatorId"]))
                    $articleCreatorId = $pageInfo["creatorId"];

                if ($page == "article" && $articleId != null)
                    if ($userRole == 'administrator' || $articleCreatorId == $_SESSION['login']) {
                ?>
                    <a href="<?php echo getEditUrlById($pageInfo["articleId"]) ?>">Edytuj ten artykuł</a>
                <?php
                    }
                ?>
                <a href="<?= _RHOME ?>logout/">Wyloguj</a>
            </div>
        </div>
<?php

    }
}
