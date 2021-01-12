<!DOCTYPE html>
<html lang="pl">
<?php
showHtmlHead("Zaloguj", null, null, false);
?>

<body class="login">
	<?php
	renderHtmlHeader($userRole,array("page"=>"login"));
	?>
	<div id="login-box">
		<h2>Zaloguj się</h2>
		<form method="post" action="<?= _RHOME; ?>login/" class="login-form">
			<!-- Okno z możliwością wpisania nazwy użytkownika -->
			<div class="login-part">
				<label for="username">Nazwa użytkownika</label>
				<input type="text" name="username" id="username" value="" />
			</div>

			<!-- Okno z możliwością wpisania hasła użytkownika -->
			<div class="login-part">
				<label for="password">Hasło</label>
				<input type="password" name="password" id="password" value=""/>
			</div>

			<!-- Wypisanie błędów z talbicy errors -->
			<?php if (array_key_exists('login-validation', $errors)) : ?>
				<div class="error"><?= $errors['login-validation'] ?></div><?php endif; ?>

			<!-- Przycisk potwierdzający wysłanie danych -->
			<div class="login-part">
				<input class="button login" type="submit" value="Zaloguj" />
			</div>
		</form>
	</div>
	<a class="return" href="<?= _RHOME ?>"><< Wróć na stronę główną</a>

</body>

</html>