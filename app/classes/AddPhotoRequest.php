<?php
final class AddPhotoRequest {
	private $path;
	private $alt;

	public function __construct($path, $alt) {
		$this->path = $path;
		$this->alt = $alt;
	}

	public function getPath() {
		return $this->path;
	}

	public function getAlt() {
		return $this->alt;
	}
}
?>