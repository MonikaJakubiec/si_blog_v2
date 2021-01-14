<?php
require_once _CLASSES_PATH . DIRECTORY_SEPARATOR . 'User.php';
require_once _CLASSES_PATH . DIRECTORY_SEPARATOR . 'CreateUserRequest.php';

final class UserRepository {
	
	public function getUserById($userId) {
		require _PDO_FILE;
		$stmt = $db->prepare('SELECT * FROM User WHERE id = :userId AND is_removed = 0;');
		$stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
		$success = $stmt->execute();
		if (!$success) {
			$stmt->closeCursor();
			$db = null;
			return null;
		}
		$userInfo = $stmt->fetch();
		if (!$userInfo) {
			$stmt->closeCursor();
			$db = null;
			return null;
		}
		$user = new User($userInfo['id'], $userInfo['name'], $userInfo['password'], $userInfo['role']);
		$stmt->closeCursor();
		$db = null;
		
		return $user;
	}

	public function getUserByName($userName) {
		require _PDO_FILE;
		$stmt = $db->prepare('SELECT * FROM User WHERE name = :userName AND is_removed = 0;');
		$stmt->bindValue(':userName', $userName, PDO::PARAM_STR);
		$success = $stmt->execute();
		if (!$success) {
			$stmt->closeCursor();
			$db = null;
			return null;
		}
		$userInfo = $stmt->fetch();
		if (!$userInfo) {
			$stmt->closeCursor();
			$db = null;
			return null;
		}
		$user = new User($userInfo['id'], $userInfo['name'], $userInfo['password'], $userInfo['role']);
		$stmt->closeCursor();
		$db = null;
		
		return $user;
	}

	public function getAllUsers($sortBy = array(["id","DESC"])) {
		require _PDO_FILE;
		$users = [];

		$availableSortColumns = array(
			"id" => "User.id",
			"username" => "User.name",
			"role" => "User.role",
			"random" => "RAND()"
		);
		$OrderByQueryPart = '';
		foreach ($sortBy as $sortOption) {
			if(array_key_exists($sortOption[0],$availableSortColumns))
			{
				$OrderByQueryPart.=$availableSortColumns[$sortOption[0]]." ";
				if($sortOption[1]=="DESC")//zabezpieczenie na wypadek wpisania innej opcji
					$OrderByQueryPart.="DESC,";
				else
					$OrderByQueryPart.="ASC,";
			}
		}

		$OrderByQueryPart=trim($OrderByQueryPart, ',');//usuniecie ewentualnego przecinka na koncu
		if(strlen($OrderByQueryPart)>1)//jeżeli zostały dodane sortowania
		$OrderByQueryPart = "ORDER BY " . $OrderByQueryPart;

		$OrderByQueryPart .= ' ';

		$stmt = $db->query("SELECT * FROM User WHERE is_removed = 0 $OrderByQueryPart ;");

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
		require _PDO_FILE;
		$stmt = $db->prepare('INSERT INTO User (name, password, role, is_removed) VALUES (:name, :password, :role, 0)');
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
		require _PDO_FILE;
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

	public function deleteUser($userId)
	{
		require _PDO_FILE;
		$stmt = $db->prepare('UPDATE User SET is_removed = 1 WHERE id = :userId');
		$stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
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