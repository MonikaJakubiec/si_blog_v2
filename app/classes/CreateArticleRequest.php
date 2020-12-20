<?php
final class CreateArticleRequest {

	private $title;
	private $content;
	private $publishedTimestamp;
	private $status;
	private $featured;
	private $userId;
	private $photoId;

	private function __construct($title, $content, $publishedTimestamp, $status, $featured, $userId, $photoId) {
		$this->title = $title;
		$this->content = $content;
		$this->publishedTimestamp = $publishedTimestamp;
		$this->status = $status;
		$this->featured = $featured;
		$this->userId = $userId;
		$this->photoId = $photoId;   
	}

	public static function createWithPhoto($title, $content, $publishedTimestamp, $status, $featured, $userId, $photoId) {
		return new CreateArticleRequest($title, $content, $publishedTimestamp, $status, $featured, $userId, $photoId);
	}

	public static function createWithoutPhoto($title, $content, $publishedTimestamp, $status, $featured, $userId) {
		return new CreateArticleRequest($title, $content, $publishedTimestamp, $status, $featured, $userId, null);
	}
	
	public function getTitle() {
		return $this->title;
	}

	public function setTitle($title) {
		$this->title = $title;
	}

	public function getContent() {
		return $this->content;
	}

	public function setContent($content) {
		$this->content = $content;
	}

	public function getPublishedTimestamp() {
		return $this->publishedTimestamp;
	}

	public function setPublishedTimestamp($publishedTimestamp) {
		$this->publishedTimestamp = $publishedTimestamp;
	}

	public function getStatus() {
		return $this->status;
	}

	public function setStatus($status) {
		$this->status = $status;
	}

	public function isFeatured() {
		return $this->featured;
	}
 
	public function setFeatured($featuredStatus) {
		$this->featured = $featuredStatus;
	}

	public function getUserId() {
		return $this->userId;
	}

	public function setUserId($userId) {
		$this->userId = $userId;
	}

	public function getPhotoId() {
		return $this->photoId;
	}

	public function setPhotoId($photoId) {
		$this->photoId = $photoId;
	}
}
?>