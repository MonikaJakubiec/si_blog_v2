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

	public function getUrl() {
		$titleSlug=str_replace(array('ą', 'ć', 'ę', 'ł', 'ń', 'ó', 'ś', 'ź', 'ż'), array('a', 'c', 'e', 'l', 'n', 'o', 's', 'z', 'z'), $this->title);//zamiana polskich znakow
		$titleSlug=preg_replace('/[.,]/', '', $titleSlug);//usuniecie kropek i przecinkow
		$titleSlug=preg_replace('/[^A-Za-z0-9-]+/', '-',$titleSlug);//zamiana innych znakow na myslnik
		$titleSlug=strtolower($titleSlug);
		$titleSlug=trim($titleSlug);	
		
		return  _RHOME . 'article/' . $this->id.','.$titleSlug."/";
	}
	public function getEditUrl() {
		return  getEditUrlById($this->getId());
	}

}

function getEditUrlById($id){
	return _RHOME .'edit-article/?edit-article='.$id;
}
