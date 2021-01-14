<?php
class User
{
	private $id;
	private $name;
	private $password;
	private $role;

	public function __construct($id, $name, $password, $role)
	{
		$this->id = $id;
		$this->name = $name;
		$this->password = $password;
		$this->role = $role;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setName($newName)
	{
		$this->name = $newName;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function setPassword($newPassword)
	{
		$this->password = $newPassword;
	}

	public function getRole()
	{
		return $this->role;
	}

	public function getFrontendRole()
	{
		if ($this->role == "administrator")
			return "Administrator";
		else
			if ($this->role == "user")
			return "Redaktor";
		else
			return "";
	}

	public function setRole($newRole)
	{
		$this->role = $newRole;
	}

	public function getUserEditUrl()
	{
		return  getUserEditUrlById($this->getId());
	}
}

function getUserEditUrlById($id)
{
	return _RHOME . 'register/?edit-user=' . $id;
}
