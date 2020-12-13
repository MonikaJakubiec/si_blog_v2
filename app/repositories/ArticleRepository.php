<?php
spl_autoload_register(function ($class_name) {
    include '..' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . $class_name . '.php';
});

final class ArticleRepository {
	
	public function getArticleById($articleId) {
		require '..' . DIRECTORY_SEPARATOR . 'pdo'. DIRECTORY_SEPARATOR . 'PDO.php';
		$stmt = $db->prepare('SELECT * FROM Article WHERE id = :articleId');
		$stmt->bindValue(':articleId', $articleId, PDO::PARAM_INT);
		$stmt->execute();
		$articleInfo = $stmt->fetch();
		$article = new Article($articleInfo['id'], $articleInfo['title'], $articleInfo['content'], $articleInfo['published_timestamp'], $articleInfo['status'], $articleInfo['is_featured'], $articleInfo['user_id'], $articleInfo['photo_id']);
		$stmt->closeCursor();
		$db = null;
		
		return $article;
	}

	public function getAllUsers() {
		require '..' . DIRECTORY_SEPARATOR . 'pdo'. DIRECTORY_SEPARATOR . 'PDO.php';
		$articles = [];
		$stmt = $db->query('SELECT * FROM Article ORDER BY id');
		while ($articleInfo = $stmt->fetch()) {
			$article = new Article($articleInfo['id'], $articleInfo['title'], $articleInfo['content'], $articleInfo['published_timestamp'], $articleInfo['status'], $articleInfo['is_featured'], $articleInfo['user_id'], $articleInfo['photo_id']);
			array_push($articles, $article);
		}
		$stmt->closeCursor();
		$db = null;

		return $articles;
	}

	public function saveArticleFromRequest($createArticleRequest) {
		require '..' . DIRECTORY_SEPARATOR . 'pdo'. DIRECTORY_SEPARATOR . 'PDO.php';
		$stmt = $db->prepare('INSERT INTO Article (title, content, published_timestamp, status, is_featured, user_id, photo_id) VALUES (:title, :content, :published_timestamp, :status, :is_featured, :user_id, :photo_id)');
		$stmt->bindValue(':title', $createArticleRequest->getTitle(), PDO::PARAM_STR);
		$stmt->bindValue(':content', $createArticleRequest->getContent(), PDO::PARAM_STR);
		$stmt->bindValue(':published_timestamp', $createUserRequest->getPublishedTimestamp(), PDO::PARAM_INT);
		$stmt->bindValue(':status', $createArticleRequest->getStatus(), PDO::PARAM_STR);
		$stmt->bindValue(':is_featured', $createArticleRequest->isFeatured(), PDO::PARAM_BOOL);
		$stmt->bindValue(':user_id', $createUserRequest->getUserId(), PDO::PARAM_INT);
		$stmt->bindValue(':photo_id', $createUserRequest->getPhotoId(), PDO::PARAM_INT);
		$stmt->execute();
		$stmt->closeCursor();
		$db = null;
	}

	public function updateArticle($article) {
		require '..' . DIRECTORY_SEPARATOR . 'pdo'. DIRECTORY_SEPARATOR . 'PDO.php';
		$stmt = $db->prepare('UPDATE Article SET title = :title, content = :content, published_timestamp = :published_timestamp, status = :status, is_featured = :is_featured, user_id = :user_id, photo_id = :photo_id WHERE id = :articleId');
		$stmt->bindValue(':title', $article->getTitle(), PDO::PARAM_STR);
		$stmt->bindValue(':content', $article->getContent(), PDO::PARAM_STR);
		$stmt->bindValue(':published_timestamp', $article->getPublishedTimestamp(), PDO::PARAM_INT);
		$stmt->bindValue(':status', $article->getStatus(), PDO::PARAM_STR);
		$stmt->bindValue(':is_featured', $article->isFeatured(), PDO::PARAM_BOOL);
		$stmt->bindValue(':user_id', $article->getUserId(), PDO::PARAM_INT);
		$stmt->bindValue(':photo_id', $article->getPhotoId(), PDO::PARAM_INT);
		$stmt->bindValue(':articleId', $article->getId(), PDO::PARAM_INT);
		$stmt->execute();
		$stmt->closeCursor();
		$db = null;
	}
}
?>