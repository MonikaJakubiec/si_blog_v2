<?php
function renderHtmlHeader($pageInfo = array())
{
?><header>
        <?php renderLoggedInMenu($pageInfo);
        ?>

        <div class="boxed">
            <h1><a href="<?= _RHOME ?>"><?= _SITE_NAME ?></a></h1>
        </div>
    </header>

    <?php
    renderAlerts();
}

function renderLoggedInMenu($pageInfo)
{
    if (isset($_SESSION['login'])) {

    ?>
        <div id="admin-header-menu">
            <div class="links">
            <a href="<?= _RHOME ?>admin-panel/">Panel administracyjny</a>
            <a href="<?= _RHOME ?>edit-article/">Dodaj artykuł</a>
                <?php

                if (array_key_exists("page", $pageInfo)) {
                    $page = $pageInfo["page"];

                    if ($page == "article") { ?>
                        <a href="<?php echo getEditUrlById($pageInfo["articleId"]) ?>">Edytuj ten artykuł</a>
                <?php
                    }
                }
                ?>
                <a href="<?= _RHOME ?>logout/">Wyloguj</a>
            </div>
        </div>
    <?php


    }
}


