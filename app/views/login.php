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
			<!-- Wypisanie błędów z talbicy errors -->
			<?php if (array_key_exists('all', $errors)) : ?>
				<div><?php echo $errors['all'] ?></div><?php endif; ?>

			<!-- Okno z możliwością wpisania nazwy użytkownika -->
			<div><label for="username">Nazwa użytkownika</label></div>
			<div><input type="text" name="username" value="" /></div>

			<!-- Wypisanie błędów z talbicy errors -->
			<?php if (array_key_exists('username', $errors)) : ?>
				<div><?php echo $errors['username'] ?></div><?php endif; ?>

			<!-- Okno z możliwością wpisania hasła użytkownika -->
			<div><label for="password">Hasło</label></div>
			<div><input type="password" name="password" value="" /></div>

			<!-- Wypisanie błędów z talbicy errors -->
			<?php if (array_key_exists('password', $errors)) : ?>
				<div><?php echo $errors['password'] ?></div><?php endif; ?>

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