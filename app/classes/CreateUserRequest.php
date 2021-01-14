<?php
final class CreateUserRequest {
	private $name;
	private $password;
	private $role;

	private function __construct($name, $password, $role) {
		$this->name = $name;
		$this->password = $password;
		$this->role = $role;
	}

	public static function createUser($name, $passowrd) {
		return new CreateUserRequest($name, $passowrd, "user");
	}

	public static function createAdministrator($name, $passowrd) {
		return new CreateUserRequest($name, $passowrd, "administrator");
	} 

	public function getName() {
		return $this->name;
	}

	public function getPassword() {
		return $this->password;
	}

	public function getRole() {
		return $this->role;
	}
}
