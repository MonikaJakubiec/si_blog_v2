<?php
class User {
	private $id;
	private $username;
	private $password;
	private $role;

	public function __construct($id, $username, $password, $role) {
		$this->id = $id;
		$this->username = $username;
		$this->password = $password;
		$this->role = $role;
	}

	public function getId() {
		return $this->id;
	}

	public function getUsername() {
		return $this->username;
	}

	public function setUsername($newUsername) {
		$this->username = $newUsername;
	}

	public function getPassword() {
		return $this->password;
	}

	public function setPassword($newPassword) {
		$this->password = $newPassword;
	}

	public function getRole() {
		return $this->role;
	}

	public function setRole($newRole) {
		$this->role = $newRole;
	}
}
?>