<?php
class Article
{
    private $id;
    private $user_id;
    private $photo_id;
    private $is_featured;
    private $status;
    private $title;
    private $published_timestamp;
    private $content;


public function __construct($title="Lorem ipsum", $photo_id=null)
{
    $this->title = $title;
    $this->photo_id = $photo_id;

}
/**
 * Zwraca tytuł artykułu
 */ 
public function getTitle()
{
return $this->title;
}

/**
 * Zwraca ścieżkę zdjęcia wyróżniającego artykułu lub null, jeśli brak
 */ 
public function getPhotoPath()
{
//

return null;
}


}