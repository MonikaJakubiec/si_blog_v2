<!DOCTYPE html>
<html lang="pl">
<?php
showHtmlHead("Nie znaleziono", null, null, true, false);
?>

<body>
    <?php
    renderHtmlHeader($userRole, array("page" => "page-not-found"));
    ?>
    <main id="content-box">
        <div class="no-bcg t-center">
            <p>Nie znaleziono</p>
            <p>Przepraszamy podana strona nie istnieje :(</p>
            <a href="<?php echo _RHOME; ?>">Przejdź do strony głównej</a>
        </div>
    </main>
    <?php
    showHtmlFooter();
    ?>
</body>

</html>