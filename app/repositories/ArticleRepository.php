<?php
require_once _CLASSES_PATH . DIRECTORY_SEPARATOR . 'Article.php';
require_once _CLASSES_PATH . DIRECTORY_SEPARATOR . 'Photo.php';
require_once _CLASSES_PATH . DIRECTORY_SEPARATOR . 'User.php';
require_once _CLASSES_PATH . DIRECTORY_SEPARATOR . 'CreateArticleRequest.php';

final class ArticleRepository
{

	public function getArticleById($articleId, $onlyPublished = false)
	{
		require _PDO_FILE;
		if ($onlyPublished)
			$filterByStatus = 'Article.status = "published"';
		else
			$filterByStatus = 'Article.status != "archived"';
		$stmt = $db->prepare('SELECT Article.id as article_id, Article.user_id, Article.photo_id, Article.is_featured, Article.status, Article.title, Article.published_timestamp, Article.content, Photo.path as photo_path, Photo.alt as photo_alt, User.name as user_name, User.role as user_role FROM Article LEFT JOIN Photo ON Article.photo_id = Photo.id LEFT JOIN User ON Article.user_id = User.id WHERE Article.id = :articleId AND ' . $filterByStatus);
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

	/**
	 * Zwraca artyku??y
	 *
	 * 
	 * @param boolean $onlyPublished tylko opublikowane artyku??y
	 * @param boolean $onlyFeatured tylko polecane artyku??y
	 * @param null|integer $limit maksymalna liczba artykulow do zwrocenia
	 * @param integer $offset ile pierwszych artykulow pominac
	 * @param integer $userId id u??ytkownika, kt??rego posty zwr??ci??
	 * @param array $sortBy tablica tablic z kolejnoscia sortowania [kolumna, kierunek]. Dost??pne kolumny: id, title, status, author, publishedTime, random, dost??pne kierunki ASC, DESC
	 * @param array $excludePost tablica id post??w, kt??ra maj?? bby?? wykluczone ze zwr??conej warto??ci
	 * @return array tablica skladajaca si?? z Article, opcjonalnie Photo, User
	 */
	public function getArticles($onlyPublished = false, $onlyFeatured = false, $limit = null, $offset = 0, $userId = null, $sortBy = array(["id", "DESC"]), $excludePost = null)
	{
		require _PDO_FILE;
		$articlesWithPhotoAndUserInfo = [];
		if ($onlyPublished)
			$filterByStatus = 'Article.status = "published"';
		else
			$filterByStatus = 'Article.status != "archived"';
		if ($onlyFeatured)
			$filterByFeatured = " AND is_featured = 1 ";
		else
			$filterByFeatured = "";

		//dodanie limitu
		$limitQueryPart = '';
		if ($limit > 0)
			$limitQueryPart = "LIMIT :limit ";

		//dodanie filtrowania artykulow wg uzytkownika
		$filterByUserQueryPart = '';
		if ($userId)
			$filterByUserQueryPart = " AND User.id=:userId ";

		//dodanie offsetu
		$offsetQueryPart = '';
		if ($offset > 0)
			$offsetQueryPart = "OFFSET :offset ";
		//dodanie sortowania
		$availableSortColumns = array(
			"id" => "Article.id",
			"title" => "Article.title",
			"status" => "Article.status",
			"author" => "User.name",
			"publishedTime" => "Article.published_timestamp",
			"random" => "RAND()"
		);
		$OrderByQueryPart = '';
		foreach ($sortBy as &$sortOption) {
			if (array_key_exists($sortOption[0], $availableSortColumns)) {
				$OrderByQueryPart .= $availableSortColumns[$sortOption[0]] . " ";
				if ($sortOption[1] == "DESC") //zabezpieczenie na wypadek wpisania innej opcji
					$OrderByQueryPart .= "DESC,";
				else
					$OrderByQueryPart .= "ASC,";
			}
		}

		$OrderByQueryPart = trim($OrderByQueryPart, ','); //usuniecie ewentualnego przecinka na koncu
		if (strlen($OrderByQueryPart) > 1) //je??li zosta??y dodane sortowania
			$OrderByQueryPart = "ORDER BY " . $OrderByQueryPart;
		$OrderByQueryPart .= ' ';

		$filterByNotInPostIds = "";
		if ($excludePost && count($excludePost) > 0) {
			$filterByNotInPostIds = " AND Article.id NOT IN (";
			foreach ($excludePost as &$exludePostId) {
				$filterByNotInPostIds .= $exludePostId . ",";
			}
			$filterByNotInPostIds = trim($filterByNotInPostIds, ','); //usuniecie przecinka na koncu
			$filterByNotInPostIds .= ") ";
		}


		$stmt = $db->prepare('SELECT Article.id as article_id, Article.user_id, Article.photo_id, Article.is_featured, Article.status, Article.title, Article.published_timestamp, Article.content, Photo.path as photo_path, Photo.alt as photo_alt, User.name as user_name, User.role as user_role FROM Article LEFT JOIN Photo ON Article.photo_id = Photo.id LEFT JOIN User ON Article.user_id = User.id WHERE ' . $filterByStatus . $filterByFeatured . $filterByUserQueryPart . $filterByNotInPostIds . $OrderByQueryPart . $limitQueryPart . $offsetQueryPart);

		if ($limit > 0)
			$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
		if ($offset > 0)
			$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
		if ($userId)
			$stmt->bindValue(':userId', $userId, PDO::PARAM_INT);

		$success = $stmt->execute();

		if (!$success) {
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

	public function getArticlesCreatedByUser($userId, $sortBy)
	{
		return $this->getArticles(false, false, null, 0, $userId, $sortBy);
	}

	public function getArticlesCount($onlyPublished = false, $onlyFeatured = false)
	{
		require _PDO_FILE;
		if ($onlyPublished)
			$filterByStatus = 'Article.status = "published"';
		else
			$filterByStatus = 'Article.status != "archived"';
		$filterByFeatured = "";
		if ($onlyFeatured) {
			$filterByFeatured = " AND is_featured = 1 ";
		}
		$stmt = $db->query('SELECT COUNT(*) FROM Article WHERE ' . $filterByStatus . $filterByFeatured);
		if (!$stmt) {
			$db = null;
			return null;
		}
		$count = $stmt->fetchColumn();
		$db = null;

		return $count;
	}

	public function saveArticleFromRequest($createArticleRequest)
	{
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

	public function updateArticle($article)
	{
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

	public function deleteArticle($articleId)
	{
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
