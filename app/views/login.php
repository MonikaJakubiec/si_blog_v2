<!DOCTYPE html>
<html lang="pl">
<?php
showHtmlHead("Zaloguj", null, null, false);
?>

<body>
	<?php
	showHtmlHeader();
	?>
	<div style="padding-left: 350px;">
		<form method="post" action="<?php echo _RHOME; ?>login">
			<!-- Okno z możliwością wpisania nazwy użytkownika -->
			<div><label for="username">Nazwa użytkownika</label></div>
			<div><input type="text" name="username" value="" /></div>

			<!-- Okno z możliwością wpisania hasła użytkownika -->
			<div><label for="password">Hasło</label></div>
			<div><input type="password" name="password" value="" /></div>

			<!-- Wypisanie błędów z talbicy errors -->
			<?php if (array_key_exists('login-validation', $errors)) : ?>
				<div class="error"><?=$errors['login-validation']?></div><?php endif; ?>

			<!-- Przycisk potwierdzający wysłanie danych -->
			<div><input type="submit" value="Zaloguj" /></div>
		</form>
	</div>
	<div>
		<?php
		showHtmlFooter();
		?>
	</div>
</body>

</html>