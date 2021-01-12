<!DOCTYPE html>
<html lang="pl">
<?php

showHtmlHead("Lista użytkowników", null, null, true);
?>

<body class="admin">
    <?php
    renderHtmlHeader(array("page"=>"users-list"));
    ?>
    <script src="<?= _RESOURCES_PATH . 'js' . DIRECTORY_SEPARATOR . 'manage-articles-users.js' ?>"></script>

    <main id="content-box">
    <?php
                if($allUsers != null && count($allUsers)>0){
                    ?>
        <table id="users">
            <thead>
                <tr>
                    <th><a href="?sortBy=id&sortDir=<?=$newSortDirections['id']?>" class="sortable" title="Sortuj po id">ID</a></th>
                    <th class="username"><a href="?sortBy=username&sortDir=<?=$newSortDirections['username']?>" class="sortable" title="Sortuj po nazwie użytkownika">Nazwa użytkownika</a></th>
                    <th><a href="?sortBy=role&sortDir=<?=$newSortDirections['role']?>" class="sortable" title="Sortuj po roli">Rola</a></th>
                    <th class="actions">Akcje</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                foreach ($allUsers as $user) {
                ?>
                    <tr class="user <?php if ($user->getRole() == 'administrator') {
                                            echo "admin";
                                        } ?>">
                        <td><?php echo $user->getId(); ?></td>
                        <td class="username"><?php echo $user->getName(); ?></td>
                        <td><?php echo $user->getFrontendRole(); ?></td>
                        <td class="actions">
                            <a class="button" href="<?= $user->getUserEditUrl() ?>">Edytuj</a>
                            <a class="button button-red" href="#" onClick="confirmUserDelete('<?= _RHOME ?>', <?= $user->getId() ?>);">Usuń</a></td>
                    </tr>
                <?php
                }
            }
            else
                {
                    echo "<div class=\"t-center alert\"><h2>Brak użytkowników, skontaktuj się z administrtorem bazy danych</h2></div>";
                }
            ?>

            </tbody>
        </table>
    </main>
    <?php
    showHtmlFooter();
    ?>
</body>

</html>
