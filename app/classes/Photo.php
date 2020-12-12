<?php
class Photo {
	private $id;
	private $path;
	private $alt;

	function __construct($id, $path, $alt) {
		$this->id = $id;
		$this->path = $path;
		$this->alt = $alt;
	}

	public function getId() {
		return $this->id;
	}
	
	public function getPath() {
		return $this->path;
	}

	public function setPath($newPath) {
		$this->path = $newPath;
	}

	public function getAlt() {
		return $this->alt;
	}
	
	public function setAlt($newAlt) {
		$this->alt = $newAlt;
	}
}
?>