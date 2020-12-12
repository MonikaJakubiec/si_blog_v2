<!DOCTYPE HTML>
<!-- Strona odpowiedzialna za pokazywanie menu -->
<html lang= "pl">
<head>
	<meta charset="utf-8">
	
</head>
<body>
    <div>
        <form method="post" action="index.php?page=add-picture" enctype="multipart/form-data">
        
            <!-- Wypisanie błędów z talbicy errors -->
		    <?php if(array_key_exists('all', $errors)): ?>
			<div><?php echo $errors['all'] ?><div><?php endif; ?>
			
		    <!-- Okno z możliwością wpisania tytułu książki -->
		    <div><label for = "alt">Opis</label></div>
		    <div><input type = "text" name="alt" value = "" /></div>
		
		    <!-- Wypisanie błędów z talbicy errors -->
		    <?php if(array_key_exists('alt', $errors)): ?>
			<div><?php echo $errors['alt'] ?></div><?php endif; ?>
                
            <!-- Okno z możliwością wybrania pliku (okładki książki) -->			
            <div><label for = "file">Plik</label></div>
            <div><input type = "file" name="file" accept="image/jpeg,image/gif" /></div>
            <!-- Wypisanie błędów z talbicy errors -->
            <?php if(array_key_exists('file', $errors)): ?>
                <div><?php echo $errors['file'] ?></div><?php endif; ?>	
                
            <!-- Przycisk potwierdzający wysłanie danych -->
            <div><input type="submit" value="Dodaj" /></div>
            
        </form>
    </div>

</body>
</html>