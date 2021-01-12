<!DOCTYPE html>
<html lang="pl">
<?php
showHtmlHead("Nie znaleziono");
?>

<body>
    <?php
    renderHtmlHeader($userRole,array("page"=>"page-not-found"));
    ?>
    <main id="content-box">
        <div class="no-bcg t-center">
            <p>404 PAGE NOT FOUND</p>
            <p>Przepraszamy podana strona nie istnieje :(</p>
            <a href="<?php echo _RHOME;?>">Przejdź do strony głównej</a>
        </div>
    </main>
    <?php
    showHtmlFooter();
    ?>
</body>

</html>