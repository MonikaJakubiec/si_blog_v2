<?php
function showFileInput($errors)
{
?>
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
function showGalleryInput($pictureId)
{
    $photoRepo = new PhotoRepository();
    $allPhotos = $photoRepo->getAllPhotos();

?>

    <?php
    /*
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
                    <td><img src="<?= _RHOME . $photo->getPath() ?>" height="200" width="350"></td>
                <?php
                } ?>
                <td><?= $photo->getAlt() ?></td>
            </tr>
        <?php } ?>
    </table>

    <?php */ ?>

    <div id="photo-selection">
        <div class="photo-selection-option">
            <input type="radio" name="picture-id" id="without-photo" onclick="showHideAddingPicture()" value="without-picture" <?php if($pictureId == "without-picture") echo "checked" ?>>
            <label for="without-photo">Artykuł bez zdjęcia</label>
        </div>
        <div class="photo-selection-option">
            <input type="radio" name="picture-id" id="picture-from-file" onclick="showHideAddingPicture()" value="picture-from-file" <?php if($pictureId == "picture-from-file") echo "checked" ?>>
            <label for="picture-from-file">Zdjęcie z pliku</label>
        </div>
        <?php
        foreach ($allPhotos as $photo) {
            //todo: check file exist
            if (file_exists($photo->getPath())) {
        ?>
                <div class="photo-selection-option">
                    <input type="radio" name="picture-id" id="<?= $photo->getId(); ?>" onclick="showHideAddingPicture()" value="<?= $photo->getId() ?>" <?php if($pictureId == $photo->getId()) echo "checked" ?>>

                    <label for="<?php echo $photo->getId(); ?>">
                        <img src="<?= _RHOME . $photo->getPath() ?>" class="file-selection" alt="<?php echo $photo->getAlt(); ?>" title="<?php echo $photo->getAlt(); ?>">
                    </label>
                </div>
            <?php
            }
            ?>
        <?php } ?>
    </div>
<?php
}
?>