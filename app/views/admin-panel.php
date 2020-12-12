<!DOCTYPE html>
<html lang="pl">
<?php
//require_once(_VIEWS_PATH . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'head.php');
//showHtmlHead("Panel administratora");
include _VIEWS_PATH . DIRECTORY_SEPARATOR . 'admin-menu.php';
?>

<body>
    <table>
        <thead>
            <tr>
                <th>Tytuł</th>
                <th>Autor</th>
                <th>Data publikacji</th>
                <th colspan="3">Akcje</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><a href="index.php?page=preview-article">Zobacz artykuły</a></td>
                <td><a href="index.php?page=edit-article">Edytuj artykuł</a></td>
                <td><a href="index.php?page=delete-article">Usuń artykuły</a></td>
            </tr>
        </tbody>
    </table>
</body>

</html>