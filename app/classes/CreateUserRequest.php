<?php
final class CreateUserRequest {
	private $username;
	private $password;
	private $role;

	private function __construct($username, $password, $role) {
		$this->username = $username;
		$this->password = $password;
		$this->role = $role;
	}

	public static function createUser($username, $passowrd) {
		return new CreateUserRequest($username, $passowrd, "user");
	}

	public static function createAdministrator($username, $passowrd) {
		return new CreateUserRequest($username, $passowrd, "administrator");
	} 

	public function getUsername() {
		return $this->username;
	}

	public function getPassword() {
		return $this->password;
	}

	public function getRole() {
		return $this->role;
	}
}
?>