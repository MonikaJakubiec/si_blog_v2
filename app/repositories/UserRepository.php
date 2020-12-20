<?php
require_once 'app' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'User.php';
require_once 'app' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'CreateUserRequest.php';

final class UserRepository {
	
	public function getUserById($userId) {
		require 'app' . DIRECTORY_SEPARATOR . 'pdo'. DIRECTORY_SEPARATOR . 'PDO.php';
		$stmt = $db->prepare('SELECT * FROM User WHERE id = :userId');
		$stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
		$success = $stmt->execute();
		if (!$success) {
			$stmt->closeCursor();
			$db = null;
			return null;
		}
		$userInfo = $stmt->fetch();
		$user = new User($userInfo['id'], $userInfo['name'], $userInfo['password'], $userInfo['role']);
		$stmt->closeCursor();
		$db = null;
		
		return $user;
	}

	public function getUserByName($userName) {
		require 'app' . DIRECTORY_SEPARATOR . 'pdo'. DIRECTORY_SEPARATOR . 'PDO.php';
		$stmt = $db->prepare('SELECT * FROM User WHERE name = :userName');
		$stmt->bindValue(':userName', $userName, PDO::PARAM_STR);
		$success = $stmt->execute();
		if (!$success) {
			$stmt->closeCursor();
			$db = null;
			return null;
		}
		$userInfo = $stmt->fetch();
		$user = new User($userInfo['id'], $userInfo['name'], $userInfo['password'], $userInfo['role']);
		$stmt->closeCursor();
		$db = null;
		
		return $user;
	}

	public function getAllUsers() {
		require 'app' . DIRECTORY_SEPARATOR . 'pdo'. DIRECTORY_SEPARATOR . 'PDO.php';
		$users = [];
		$stmt = $db->query('SELECT * FROM User ORDER BY id');
		if (!$stmt) {
			$db = null;
			return null;
		}
		while ($userInfo = $stmt->fetch()) {
			$user = new User($userInfo['id'], $userInfo['name'], $userInfo['password'], $userInfo['role']);
			array_push($users, $user);
		}
		$stmt->closeCursor();
		$db = null;

		return $users;
	}

	public function saveUserFromRequest($createUserRequest) {
		require 'app' . DIRECTORY_SEPARATOR . 'pdo'. DIRECTORY_SEPARATOR . 'PDO.php';
		$stmt = $db->prepare('INSERT INTO User (name, password, role) VALUES (:name, :password, :role)');
		$stmt->bindValue(':name', $createUserRequest->getName(), PDO::PARAM_STR);
		$stmt->bindValue(':password', $createUserRequest->getPassword(), PDO::PARAM_STR);
		$stmt->bindValue(':role', $createUserRequest->getRole(), PDO::PARAM_STR);
		$success = $stmt->execute();
		if (!$success) {
			$stmt->closeCursor();
			$db = null;
			return null;
		}
		$stmt->closeCursor();
		$lastInsertId = $db->lastInsertId();
		$db = null;

		return $lastInsertId;
	}

	public function updateUser($user) {
		require 'app' . DIRECTORY_SEPARATOR . 'pdo'. DIRECTORY_SEPARATOR . 'PDO.php';
		$stmt = $db->prepare('UPDATE User SET name = :name, password = :password, role = :role WHERE id = :userId');
		$stmt->bindValue(':name', $user->getName(), PDO::PARAM_STR);
		$stmt->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
		$stmt->bindValue(':role', $user->getRole(), PDO::PARAM_STR);
		$stmt->bindValue(':userId', $user->getId(), PDO::PARAM_INT);
		$success = $stmt->execute();
		if (!$success) {
			$stmt->closeCursor();
			$db = null;
			return null;
		}
		$stmt->closeCursor();
		$db = null;
	}
}
?>