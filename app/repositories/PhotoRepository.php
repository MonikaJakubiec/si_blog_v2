<?php
require_once 'app' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Photo.php';
require_once 'app' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'AddPhotoRequest.php';

final class PhotoRepository {
	
	public function getPhotoById($photoId) {
		require 'app' . DIRECTORY_SEPARATOR . 'pdo'. DIRECTORY_SEPARATOR . 'PDO.php';
		$stmt = $db->prepare('SELECT * FROM Photo WHERE id = :photoId');
		$stmt->bindValue(':photoId', $photoId, PDO::PARAM_INT);
		$stmt->execute();
		$photoInfo = $stmt->fetch();
		$photo = new Photo($photoInfo['id'], $photoInfo['path'], $photoInfo['alt']);
		$stmt->closeCursor();
		$db = null;
		
		return $photo;
	}

	public function getAllPhotos() {
		require 'app' . DIRECTORY_SEPARATOR . 'pdo'. DIRECTORY_SEPARATOR . 'PDO.php';
		$photos = [];
		$stmt = $db->query('SELECT * FROM Photo ORDER BY id');
		while ($userInfo = $stmt->fetch()) {
			$photo = new Photo($photoInfo['id'], $photoInfo['path'], $photoInfo['alt']);
			array_push($photos, $photo);
		}
		$stmt->closeCursor();
		$db = null;

		return $photos;
	}

	public function savePhotoFromRequest($addPhotoRequest) {
		require 'app' . DIRECTORY_SEPARATOR . 'pdo'. DIRECTORY_SEPARATOR . 'PDO.php';
		$stmt = $db->prepare('INSERT INTO Photo (path, alt) VALUES (:path, :alt)');
		$stmt->bindValue(':path', $addPhotoRequest->getPath(), PDO::PARAM_STR);
		$stmt->bindValue(':alt', $addPhotoRequest->getAlt(), PDO::PARAM_STR);
		$stmt->execute();
		$stmt->closeCursor();
		$lastInsertId = $db->lastInsertId();
		$db = null;

		return $lastInsertId;
	}

	public function updatePhoto($photo) {
		require 'app' . DIRECTORY_SEPARATOR . 'pdo'. DIRECTORY_SEPARATOR . 'PDO.php';
		$stmt = $db->prepare('UPDATE Photo SET path = :path, alt = :alt WHERE id = :photoId');
		$stmt->bindValue(':path', $photo->getPath(), PDO::PARAM_STR);
		$stmt->bindValue(':alt', $photo->getAlt(), PDO::PARAM_STR);
		$stmt->bindValue(':photoId', $photo->getId(), PDO::PARAM_INT);
		$stmt->execute();
		$stmt->closeCursor();
		$db = null;
	}
}
?>