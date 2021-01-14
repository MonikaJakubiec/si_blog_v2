<?php
require_once _CLASSES_PATH . DIRECTORY_SEPARATOR . 'Photo.php';
require_once _CLASSES_PATH . DIRECTORY_SEPARATOR . 'AddPhotoRequest.php';

final class PhotoRepository {
	
	public function getPhotoById($photoId) {
		require _PDO_FILE;
		$stmt = $db->prepare('SELECT * FROM Photo WHERE id = :photoId');
		$stmt->bindValue(':photoId', $photoId, PDO::PARAM_INT);
		$success = $stmt->execute();
		if (!$success) {
			$stmt->closeCursor();
			$db = null;
			return null;
		}
		$photoInfo = $stmt->fetch();
		if (!$photoInfo) {
			$stmt->closeCursor();
			$db = null;
			return null;
		}
		$photo = new Photo($photoInfo['id'], $photoInfo['path'], $photoInfo['alt']);
		$stmt->closeCursor();
		$db = null;
		
		return $photo;
	}

	public function getAllPhotos() {
		require _PDO_FILE;
		$photos = [];
		$stmt = $db->query('SELECT * FROM Photo ORDER BY id DESC');
		if (!$stmt) {
			$db = null;
			return null;
		}
		while ($photoInfo = $stmt->fetch()) {
			$photo = new Photo($photoInfo['id'], $photoInfo['path'], $photoInfo['alt']);
			array_push($photos, $photo);
		}
		$stmt->closeCursor();
		$db = null;

		return $photos;
	}

	public function savePhotoFromRequest($addPhotoRequest) {
		require _PDO_FILE;
		$stmt = $db->prepare('INSERT INTO Photo (path, alt) VALUES (:path, :alt)');
		$stmt->bindValue(':path', $addPhotoRequest->getPath(), PDO::PARAM_STR);
		$stmt->bindValue(':alt', $addPhotoRequest->getAlt(), PDO::PARAM_STR);
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

	public function updatePhoto($photo) {
		require _PDO_FILE;
		$stmt = $db->prepare('UPDATE Photo SET path = :path, alt = :alt WHERE id = :photoId');
		$stmt->bindValue(':path', $photo->getPath(), PDO::PARAM_STR);
		$stmt->bindValue(':alt', $photo->getAlt(), PDO::PARAM_STR);
		$stmt->bindValue(':photoId', $photo->getId(), PDO::PARAM_INT);
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
