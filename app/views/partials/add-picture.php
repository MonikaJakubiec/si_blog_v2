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
    <div><input type="file" name="file" accept="image/jpeg,image/gif" /></div>
    <!-- Wypisanie błędów z talbicy errors -->
    <?php if (array_key_exists('file', $errors)) : ?>
        <div class="error"><?php echo $errors['file'] ?></div><?php endif; ?>
<?php
}

// TODO generacja divów lub tabeli na podstawie zdjec z bazy
function showGalleryInput()
{
?>
    <table style="color: black;">
        <tr>
            <td>
                <input type="radio" id="none-picture" name="picture-id" onclick="showHideAddingPicture()" checked>
            </td>
            <td>nie wyberam zdjecia</td>
            <td></td>
        </tr>
        <tr>
            <td>
                <input type="radio" id="picture-from-file" name="picture-id" onclick="showHideAddingPicture()">
            </td>
            <td>zdjecie z pliku</td>
            <td></td>
        </tr>
        <tr>
            <td>
                <input type="radio" class="picture-from-gallery" name="picture-id" onclick="showHideAddingPicture()">
            </td>
            <td>photo</td>
            <td>description</td>
        </tr>
        <tr>
            <td>
                <input type="radio" class="picture-from-gallery" name="picture-id" onclick="showHideAddingPicture()">
            </td>
            <td>photo</td>
            <td>description</td>
        </tr>
        <tr>
            <td>
                <input type="radio" class="picture-from-gallery" name="picture-id" onclick="showHideAddingPicture()">
            </td>
            <td>photo</td>
            <td>description</td>
        </tr>
        <tr>
            <td>
                <input type="radio" class="picture-from-gallery" name="picture-id" onclick="showHideAddingPicture()">
            </td>
            <td>photo</td>
            <td>description</td>
        </tr>
        <tr>
            <td>
                <input type="radio" class="picture-from-gallery" name="picture-id" onclick="showHideAddingPicture()">
            </td>
            <td>photo</td>
            <td>description</td>
        </tr>
        <tr>
            <td>
                <input type="radio" class="picture-from-gallery" name="picture-id" onclick="showHideAddingPicture()">
            </td>
            <td>photo</td>
            <td>description</td>
        </tr>
        <tr>
            <td>
                <input type="radio" class="picture-from-gallery" name="picture-id" onclick="showHideAddingPicture()">
            </td>
            <td>photo</td>
            <td>description</td>
        </tr>
        <tr>
            <td>
                <input type="radio" class="picture-from-gallery" name="picture-id" onclick="showHideAddingPicture()">
            </td>
            <td>photo</td>
            <td>description</td>
        </tr>
    </table>
<?php
}
?>