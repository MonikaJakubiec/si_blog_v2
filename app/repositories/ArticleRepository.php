<?php
require_once _CLASSES_PATH . DIRECTORY_SEPARATOR . 'Article.php';
require_once _CLASSES_PATH . DIRECTORY_SEPARATOR . 'Photo.php';
require_once _CLASSES_PATH . DIRECTORY_SEPARATOR . 'User.php';
require_once _CLASSES_PATH . DIRECTORY_SEPARATOR . 'CreateArticleRequest.php';

final class ArticleRepository {
	
	public function getArticleById($articleId,$onlyPublished=false) {
		require _PDO_FILE;
		if($onlyPublished)
			$filterByStatus='Article.status = "published"';
		else
			$filterByStatus='Article.status != "archived"';
		$stmt = $db->prepare('SELECT Article.id as article_id, Article.user_id, Article.photo_id, Article.is_featured, Article.status, Article.title, Article.published_timestamp, Article.content, Photo.path as photo_path, Photo.alt as photo_alt, User.name as user_name, User.role as user_role FROM Article LEFT JOIN Photo ON Article.photo_id = Photo.id LEFT JOIN User ON Article.user_id = User.id WHERE Article.id = :articleId AND '.$filterByStatus);
		$stmt->bindValue(':articleId', $articleId, PDO::PARAM_INT);
		$success = $stmt->execute();

		if (!$success) {
			$stmt->closeCursor();
			$db = null;
			return null;
		}
		$articleInfo = $stmt->fetch();
		if (!$articleInfo) {
			$stmt->closeCursor();
			$db = null;
			return null;
		}
		$article = new Article($articleInfo['article_id'], $articleInfo['title'], $articleInfo['content'], $articleInfo['published_timestamp'], $articleInfo['status'], $articleInfo['is_featured'], $articleInfo['user_id'], $articleInfo['photo_id']);
		$user = new User($articleInfo['user_id'], $articleInfo['user_name'], "", $articleInfo['user_role']);
		if ($articleInfo['photo_id'] != NULL) {
			$photo = new Photo($articleInfo['photo_id'], $articleInfo['photo_path'], $articleInfo['photo_alt']);
			$articlePhotoUser = array(
				"article" => $article,
				"photo" => $photo,
				"user" => $user,
			);
		} else {
			$articlePhotoUser = array(
				"article" => $article,
				"user" => $user,
			);
		}
		$stmt->closeCursor();
		$db = null;
		
		return $articlePhotoUser;
	}

	public function getAllArticles($onlyPublished=false) {
		require _PDO_FILE;
		$articlesWithPhotoAndUserInfo = [];
		if($onlyPublished)
			$filterByStatus='Article.status = "published"';
		else
			$filterByStatus='Article.status != "archived"';
		$stmt = $db->query('SELECT Article.id as article_id, Article.user_id, Article.photo_id, Article.is_featured, Article.status, Article.title, Article.published_timestamp, Article.content, Photo.path as photo_path, Photo.alt as photo_alt, User.name as user_name, User.role as user_role FROM Article LEFT JOIN Photo ON Article.photo_id = Photo.id LEFT JOIN User ON Article.user_id = User.id WHERE '.$filterByStatus.' ORDER BY Article.id DESC');
		if (!$stmt) {
			echo "error";
			$db = null;
			return null;
		}
		while ($articleInfo = $stmt->fetch()) {
			$article = new Article($articleInfo['article_id'], $articleInfo['title'], $articleInfo['content'], $articleInfo['published_timestamp'], $articleInfo['status'], $articleInfo['is_featured'], $articleInfo['user_id'], $articleInfo['photo_id']);
			$user = new User($articleInfo['user_id'], $articleInfo['user_name'], "", $articleInfo['user_role']);
			if ($articleInfo['photo_id'] != NULL) {
				$photo = new Photo($articleInfo['photo_id'], $articleInfo['photo_path'], $articleInfo['photo_alt']);
				$articlePhotoUser = array(
					"article" => $article,
					"photo" => $photo,
					"user" => $user,
				);
			} else {
				$articlePhotoUser = array(
					"article" => $article,
					"user" => $user,
				);
			}
			array_push($articlesWithPhotoAndUserInfo, $articlePhotoUser);
		}
		$stmt->closeCursor();
		$db = null;

		return $articlesWithPhotoAndUserInfo;
	}

	public function getNumberOfArticlesStartingFromOffset($number, $offset, $onlyPublished=false) {
		require _PDO_FILE;
		$articlesWithPhotoAndUserInfo = [];
		if($onlyPublished)
			$filterByStatus='Article.status = "published"';
		else
			$filterByStatus='Article.status != "archived"';

		$stmt = $db->prepare('SELECT Article.id as article_id, Article.user_id, Article.photo_id, Article.is_featured, Article.status, Article.title, Article.published_timestamp, Article.content, Photo.path as photo_path, Photo.alt as photo_alt, User.name as user_name, User.role as user_role FROM Article LEFT JOIN Photo ON Article.photo_id = Photo.id LEFT JOIN User ON Article.user_id = User.id WHERE '.$filterByStatus.' ORDER BY published_timestamp DESC LIMIT :number OFFSET :offset');
		$stmt->bindValue(':number', $number, PDO::PARAM_INT);
		$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
		$success = $stmt->execute();
		if (!$success) {
			$stmt->closeCursor();
			$db = null;
			return null;
		}
		while ($articleInfo = $stmt->fetch()) {
			$article = new Article($articleInfo['article_id'], $articleInfo['title'], $articleInfo['content'], $articleInfo['published_timestamp'], $articleInfo['status'], $articleInfo['is_featured'], $articleInfo['user_id'], $articleInfo['photo_id']);
			$user = new User($articleInfo['user_id'], $articleInfo['user_name'], "", $articleInfo['user_role']);
			if ($articleInfo['photo_id'] != NULL) {
				$photo = new Photo($articleInfo['photo_id'], $articleInfo['photo_path'], $articleInfo['photo_alt']);
				$articlePhotoUser = array(
					"article" => $article,
					"photo" => $photo,
					"user" => $user,
				);
			} else {
				$articlePhotoUser = array(
					"article" => $article,
					"user" => $user,
				);
			}
			array_push($articlesWithPhotoAndUserInfo, $articlePhotoUser);
		}
		$stmt->closeCursor();
		$db = null;

		return $articlesWithPhotoAndUserInfo;
	}

	public function getFeaturedArticles($onlyPublished=false) {
		require _PDO_FILE;
		$articlesWithPhotoAndUserInfo = [];
		if($onlyPublished)
			$filterByStatus='Article.status = "published"';
		else
			$filterByStatus='Article.status != "archived"';
			
		$stmt = $db->query('SELECT Article.id as article_id, Article.user_id, Article.photo_id, Article.is_featured, Article.status, Article.title, Article.published_timestamp, Article.content, Photo.path as photo_path, Photo.alt as photo_alt, User.name as user_name, User.role as user_role FROM Article LEFT JOIN Photo ON Article.photo_id = Photo.id LEFT JOIN User ON Article.user_id = User.id WHERE is_featured = 1 AND '.$filterByStatus.' ORDER BY published_timestamp DESC');
		if (!$stmt) {
			$db = null;
			return null;
		}
		while ($articleInfo = $stmt->fetch()) {
			$article = new Article($articleInfo['article_id'], $articleInfo['title'], $articleInfo['content'], $articleInfo['published_timestamp'], $articleInfo['status'], $articleInfo['is_featured'], $articleInfo['user_id'], $articleInfo['photo_id']);
			$user = new User($articleInfo['user_id'], $articleInfo['user_name'], "", $articleInfo['user_role']);
			if ($articleInfo['photo_id'] != NULL) {
				$photo = new Photo($articleInfo['photo_id'], $articleInfo['photo_path'], $articleInfo['photo_alt']);
				$articlePhotoUser = array(
					"article" => $article,
					"photo" => $photo,
					"user" => $user,
				);
			} else {
				$articlePhotoUser = array(
					"article" => $article,
					"user" => $user,
				);
			}
			array_push($articlesWithPhotoAndUserInfo, $articlePhotoUser);
		}
		$stmt->closeCursor();
		$db = null;

		return $articlesWithPhotoAndUserInfo;
	}

	public function getArticlesCreatedByUser($userId) {
		require _PDO_FILE;
		$articlesWithPhotoAndUserInfo = [];
		$stmt = $db->prepare('SELECT Article.id as article_id, Article.user_id, Article.photo_id, Article.is_featured, Article.status, Article.title, Article.published_timestamp, Article.content, Photo.path as photo_path, Photo.alt as photo_alt, User.name as user_name, User.role as user_role FROM Article LEFT JOIN Photo ON Article.photo_id = Photo.id LEFT JOIN User ON Article.user_id = User.id WHERE Article.user_id = :userId AND Article.status != "archived" ORDER BY published_timestamp DESC');
		$stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
		$success = $stmt->execute();
		if (!$success) {
			$stmt->closeCursor();
			$db = null;
			return null;
		}
		while ($articleInfo = $stmt->fetch()) {
			$article = new Article($articleInfo['article_id'], $articleInfo['title'], $articleInfo['content'], $articleInfo['published_timestamp'], $articleInfo['status'], $articleInfo['is_featured'], $articleInfo['user_id'], $articleInfo['photo_id']);
			$user = new User($articleInfo['user_id'], $articleInfo['user_name'], "", $articleInfo['user_role']);
			if ($articleInfo['photo_id'] != NULL) {
				$photo = new Photo($articleInfo['photo_id'], $articleInfo['photo_path'], $articleInfo['photo_alt']);
				$articlePhotoUser = array(
					"article" => $article,
					"photo" => $photo,
					"user" => $user,
				);
			} else {
				$articlePhotoUser = array(
					"article" => $article,
					"user" => $user,
				);
			}
			array_push($articlesWithPhotoAndUserInfo, $articlePhotoUser);
		}
		$stmt->closeCursor();
		$db = null;

		return $articlesWithPhotoAndUserInfo;
	}

	public function getFeaturedArticlesCount() {
		require _PDO_FILE;
		$stmt = $db->query('SELECT COUNT(*) FROM Article WHERE is_featured = 1 AND Article.status != "archived"');
		if (!$stmt) {
			$db = null;
			return null;
		}
		$count = $stmt->fetchColumn();
		$db = null;
		
		return $count;
	}

	public function getArticlesCount($onlyPublished=false) {
		require _PDO_FILE;
		if($onlyPublished)
			$filterByStatus='Article.status = "published"';
		else
			$filterByStatus='Article.status != "archived"';
		$stmt = $db->query('SELECT COUNT(*) FROM Article WHERE '.$filterByStatus);
		if (!$stmt) {
			$db = null;
			return null;
		}
		$count = $stmt->fetchColumn();
		$db = null;
		
		return $count;
	}

	public function saveArticleFromRequest($createArticleRequest) {
		require _PDO_FILE;
		$stmt = $db->prepare('INSERT INTO Article (user_id, photo_id, is_featured, status, title, published_timestamp, content) VALUES (:user_id, :photo_id, :is_featured, :status, :title, :published_timestamp, :content)');
		$stmt->bindValue(':title', $createArticleRequest->getTitle(), PDO::PARAM_STR);
		$stmt->bindValue(':content', $createArticleRequest->getContent(), PDO::PARAM_STR);
		$stmt->bindValue(':published_timestamp', $createArticleRequest->getPublishedTimestamp(), PDO::PARAM_INT);
		$stmt->bindValue(':status', $createArticleRequest->getStatus(), PDO::PARAM_STR);
		$stmt->bindValue(':is_featured', $createArticleRequest->isFeatured(), PDO::PARAM_BOOL);
		$stmt->bindValue(':user_id', $createArticleRequest->getUserId(), PDO::PARAM_INT);
		$stmt->bindValue(':photo_id', $createArticleRequest->getPhotoId(), PDO::PARAM_INT);
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

	public function updateArticle($article) {
		require _PDO_FILE;
		$stmt = $db->prepare('UPDATE Article SET title = :title, content = :content, published_timestamp = :published_timestamp, status = :status, is_featured = :is_featured, user_id = :user_id, photo_id = :photo_id WHERE id = :articleId');
		$stmt->bindValue(':title', $article->getTitle(), PDO::PARAM_STR);
		$stmt->bindValue(':content', $article->getContent(), PDO::PARAM_STR);
		$stmt->bindValue(':published_timestamp', $article->getPublishedTimestamp(), PDO::PARAM_INT);
		$stmt->bindValue(':status', $article->getStatus(), PDO::PARAM_STR);
		$stmt->bindValue(':is_featured', $article->isFeatured(), PDO::PARAM_BOOL);
		$stmt->bindValue(':user_id', $article->getUserId(), PDO::PARAM_INT);
		$stmt->bindValue(':photo_id', $article->getPhotoId(), PDO::PARAM_INT);
		$stmt->bindValue(':articleId', $article->getId(), PDO::PARAM_INT);
		$success = $stmt->execute();
		if (!$success) {
			$stmt->closeCursor();
			$db = null;
			return null;
		}
		$stmt->closeCursor();
		$db = null;
	}

	public function deleteArticle($articleId) {
		require _PDO_FILE;
		$stmt = $db->prepare('UPDATE Article SET status = :status WHERE id = :articleId');
		$stmt->bindValue(':status', "archived", PDO::PARAM_STR);
		$stmt->bindValue(':articleId', $articleId, PDO::PARAM_INT);
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