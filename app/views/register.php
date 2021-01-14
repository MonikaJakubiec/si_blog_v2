<!DOCTYPE html>
<html lang="pl">
<?php
showHtmlHead("Rejestracja", null, null,true,false);
?>

<body class="login">
	

	<?php
	renderHtmlHeader($userRole,array("page" => "register"));
	?>
	<div id="login-box">
		<h2><?= $isEditForm ? 'Edycja' : 'Rejestracja' ?> użytkownika</h2>
		<form method="post" action="<?= _RHOME; ?>register/" class="login-form">
			<!-- Okno z możliwością wpisania nazwy użytkownika -->
			<div class="login-part">
				<label for="username">Nazwa użytkownika</label>
				<input type="text" name="username" id="username" value="<?= $username ?>" required />
			</div>
			<!-- Wypisanie błędów z talbicy errors -->
			<?php if (array_key_exists('register-username', $errors)) : ?>
				<div class="error"><?= $errors['register-username'] ?></div><?php endif; ?>

			<!-- Okno z możliwością wpisania hasła użytkownika -->
			<div class="login-part">
				<label for="first_password">Hasło</label>
				<input type="password" name="first_password" id="first_password" <?= $isEditForm ? '' : 'required' ?> autocomplete="new-password" value="" placeholder="<?= $isEditForm ? 'Wypełnij, jeśli chcesz zmienić' : '' ?>"/>
			</div>

			<!-- Okno z możliwością wpisania hasła użytkownika -->
			<div class="login-part">
				<label for="second_password">Powtórz hasło</label>
				<input type="password" name="second_password" id="second_password" <?= $isEditForm ? '' : 'required' ?> autocomplete="new-password" value="" placeholder="<?= $isEditForm ? 'Wypełnij, jeśli chcesz zmienić' : '' ?>"/>
			</div>

			<!-- Wypisanie błędów z talbicy errors -->
			<?php if (array_key_exists('register-password', $errors)) : ?>
				<div class="error"><?= $errors['register-password'] ?></div><?php endif;?>

			<div class="login-part">
				<input type="radio" name="role" id="user" value="user" <?php if(!isset($role) || $role == 'user') echo 'checked'; ?>>
				<label for="user">Redaktor</label>
				<input type="radio" name="role" id="administrator" value="administrator" <?php if($role == 'administrator') echo 'checked'; ?>>
				<label for="administrator">Administrator</label>
			</div>
			<!-- Wypisanie błędów z talbicy errors -->
			<?php if (array_key_exists('register-role', $errors)) : ?>
				<div class="error"><?= $errors['register-role'] ?></div><?php endif; ?>

			<input type="hidden" name="edit-user" value="<?= $id ?>">
			<div class="login-part">
			<!-- TODO -->
				<input class="button" type="submit" value="<?= $isEditForm ? 'Zaktualizuj' : 'Zarejestruj' ?>" onclick="formSubmit()"/>
			</div>

			<div class="login-part">
				<a class="button button-red" href="<?= _RHOME ?>users-list/">Anuluj</a>
			</div>
		</form>
	</div>

	<script>
		preventExit();
	</script>
</body>

</html>