<?php
function showFileInput($errors)
{
?>
    <div><label for="fi leAlt">Opis</label></div>
    <div><input type="text" name="alt" value="" id="fileAlt" /></div>

    <!-- Wypisanie błędów z talblicy errors -->
    <?php if (array_key_exists('alt', $errors)) : ?>
        <div class="error"><?php echo $errors['alt'] ?></div><?php endif; ?>

    <div><label for="file">Plik</label></div>
    <div><input type="file" name="file" id="file" accept="image/jpeg, image/png" /></div>
    
    <!-- Wypisanie błędów z talbicy errors -->
    <?php if (array_key_exists('file', $errors)) : ?>
        <div class="error"><?php echo $errors['file'] ?></div><?php endif; ?>
<?php
}

function showGalleryInput($articleToView, $allPhotos)
{
?>
    <div id="photo-selection">
        <div class="photo-selection-option">
            <input type="radio" name="picture-id" id="without-photo" onclick="showHideAddingPicture()" value="without-picture" <?php if ($articleToView->getPhotoId() == null) echo "checked" ?>>
            <label for="without-photo">Artykuł bez zdjęcia</label>
        </div>
        <div class="photo-selection-option">
            <input type="radio" name="picture-id" id="picture-from-file" onclick="showHideAddingPicture()" value="picture-from-file" <?php if ($articleToView->getPhotoId() == "picture-from-file") echo "checked" ?>>
            <label for="picture-from-file">Zdjęcie z pliku</label>
        </div>
        <?php if (count($allPhotos) > 0) {
        ?>
            <p>Lub wybierz z poniższych</p>
            <div class="photo-from-file">

                <?php
                foreach ($allPhotos as $photo) {
                    if (file_exists($photo->getPath())) {
                ?>
                        <div class="photo-selection-option">
                            <input type="radio" name="picture-id" id="<?= $photo->getId(); ?>" onclick="showHideAddingPicture()" value="<?= $photo->getId() ?>" <?php if ($articleToView->getPhotoId() == $photo->getId()) echo "checked" ?>>

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
    </div>
<?php
}
?>