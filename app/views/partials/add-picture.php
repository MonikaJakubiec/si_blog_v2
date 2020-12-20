<?php
function showFileInput($errors)
{
?>
    <!-- Wypisanie błędów z talbicy errors -->
    <?php if (array_key_exists('all', $errors)) : ?>
        <div class="error"><?php echo $errors['all'] ?></div><?php endif; ?>

    <!-- Okno z możliwością wpisania tytułu książki -->
    <div><label for="alt">Opis</label></div>
    <div><input type="text" name="alt" value="" /></div>

    <!-- Wypisanie błędów z talbicy errors -->
    <?php if (array_key_exists('alt', $errors)) : ?>
        <div class="error"><?php echo $errors['alt'] ?></div><?php endif; ?>

    <!-- Okno z możliwością wybrania pliku (okładki książki) -->
    <div><label for="file">Plik</label></div>
    <div><input type="file" name="file" accept="image/jpeg,image/png,image/jpg" /></div>
    <!-- Wypisanie błędów z talbicy errors -->
    <?php if (array_key_exists('file', $errors)) : ?>
        <div class="error"><?php echo $errors['file'] ?></div><?php endif; ?>
<?php
}

// TODO generacja divów lub tabeli na podstawie zdjec z bazy
function showGalleryInput()
{
    $photoRepo = new PhotoRepository();
    $allPhotos = $photoRepo->getAllPhotos();
?>
    <table style="color: black; overflow: auto; height: 200px; display: block;">
        <tr>
            <td>
                <input type="radio" name="picture-id" onclick="showHideAddingPicture()" checked>
            </td>
            <td>Artykuł bez zdjęcia</td>
            <td></td>
        </tr>
        <tr>
            <td>
                <input type="radio" id="picture-from-file" name="picture-id" onclick="showHideAddingPicture()">
            </td>
            <td>Wgranie zdjęcia na serwer</td>
            <td></td>
        </tr>
        <?php
        foreach ($allPhotos as $photo) {
        ?>
            <tr>
                <td>
                    <input type="radio" name="picture-id" onclick="showHideAddingPicture()" value="<?= $photo->getId() ?>">
                </td>
                <?php
                if (file_exists($photo->getPath())) { ?>
                    <td><img src="<?= $photo->getPath() ?>" height="200" width="350"></td>
                <?php
                } ?>
                <td><?= $photo->getAlt() ?></td>
            </tr>
        <?php } ?>
    </table>
<?php
}
?>