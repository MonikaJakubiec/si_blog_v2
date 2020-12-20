<?php
class User {
	private $id;
	private $name;
	private $password;
	private $role;

	public function __construct($id, $name, $password, $role) {
		$this->id = $id;
		$this->name = $name;
		$this->password = $password;
		$this->role = $role;
	}

	public function getId() {
		return $this->id;
	}

	public function getName() {
		return $this->name;
	}

	public function setName($newName) {
		$this->name = $newName;
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