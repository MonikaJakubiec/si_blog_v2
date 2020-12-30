<?php

class Article {
	private $id;
	private $title;
	private $content;
	private $publishedTimestamp;
	private $status;
	private $featured;
	private $userId;
	private $photoId;

	public function __construct($id, $title, $content, $publishedTimestamp, $status, $featured, $userId, $photoId) {
		$this->id = $id;
		$this->title = $title;
		$this->content = $content;
		$this->publishedTimestamp = $publishedTimestamp;
		$this->status = $status;
		$this->featured = $featured;
		$this->userId = $userId;
		$this->photoId = $photoId;   
	}

	public function getId() {
		return $this->id;
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

	public function isPublished() {
		if($this->status=="published")
			return true;
		else
			return false;
	}
}
?>