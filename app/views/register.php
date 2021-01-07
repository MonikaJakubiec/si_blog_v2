<!DOCTYPE html>
<html lang="pl">
<?php
showHtmlHead("Rejestracja", null, null, true);
?>

<body class="login">
	<script src="<?= _RESOURCES_PATH . 'js' . DIRECTORY_SEPARATOR . 'manage-articles-users.js' ?>"></script>

	<?php
	renderHtmlHeader(array("page" => "register"));
	?>
	<div id="login-box">
		<h2>Rejestracja użytkownika</h2>
		<form method="post" action="<?= _RHOME; ?>register/" class="login-form">
			<!-- Okno z możliwością wpisania nazwy użytkownika -->
			<div class="login-part">
				<label for="username">Nazwa użytkownika</label>
				<input type="text" name="username" id="username" value="<?= $username ?>" />
			</div>
			<?php if (array_key_exists('register-username', $errors)) : ?>
				<div class="error"><?= $errors['register-username'] ?></div><?php endif; ?>


			<!-- Okno z możliwością wpisania hasła użytkownika -->
			<div class="login-part">
				<label for="first_password">Hasło</label>
				<input type="password" name="first_password" id="first_password" value="" />
			</div>

			<!-- Okno z możliwością wpisania hasła użytkownika -->
			<div class="login-part">
				<label for="second_password">Powtórz hasło</label>
				<input type="password" name="second_password" id="second_password" value="" />
			</div>

			<!-- Wypisanie błędów z talbicy errors -->
			<?php if (array_key_exists('register-password', $errors)) : ?>
				<div class="error"><?= $errors['register-password'] ?></div><?php endif; ?>

			<div class="login-part">
				<input type="radio" name="role" id="user" value="user" <?php if(!isset($role) || $role == 'user') echo 'checked'; ?>>
				<label for="user">Redaktor</label>
				<input type="radio" name="role" id="admin" value="admin" <?php if($role == 'admin') echo 'checked'; ?>>
				<label for="admin">Administrator</label>
			</div>
			<?php if (array_key_exists('register-role', $errors)) : ?>
				<div class="error"><?= $errors['register-role'] ?></div><?php endif; ?>

			<!-- Przycisk potwierdzający wysłanie danych -->
			<div class="login-part">
				<input class="button" style="width: 0%; font-size: 14px;" type="submit" value="Zarejestruj" onclick="formSubmit()"/>
			</div>

			<div class="login-part">
				<a class="button button-red" href="<?= _RHOME ?>admin-panel/">Anuluj</a>
			</div>
		</form>
	</div>

	<script>preventExit();</script>
</body>

</html>