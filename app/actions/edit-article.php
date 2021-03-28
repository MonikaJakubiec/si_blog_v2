<?php
redirectIfNotLoggedIn();

$errors = [];

require_once(_ACTIONS_PATH . 'add-picture.php');
require_once(_CLASSES_PATH . 'CreateArticleRequest.php');
require_once(_REPOSITORIES_PATH . 'ArticleRepository.php');

$publishButtonText = "Publikuj";
$unpublishButtonText = "Cofnij publikację";
$updateButtonText = "Zaktualizuj";
$saveButtonText = "Zapisz";

$publishButtonTextToDisplay = $publishButtonText;
$saveButtonTextToDisplay = $saveButtonText;

$isArticlePublished = false;
$articleToView = $articleToEdit = null;

//artykul przeslany postem z formularza przy kliknieciu zapisz/zaktualizuj lub publikuj/cofnij_publikacje
if (isset($_POST['title'])) {
    //przesylanie formularza przy edycji
    if (isset($_POST['edit-article']) && $_POST['edit-article'] != '') {
        $articleToEdit = (new ArticleRepository)->getArticleById($_POST['edit-article'])['article'];
        $isArticlePublished = $articleToEdit->getStatus() == 'published';
        $publishButtonTextToDisplay = $isArticlePublished ? $unpublishButtonText : $publishButtonText;
        $saveButtonTextToDisplay = $updateButtonText;
    }
    switch ($_POST['picture-id']) {
        case 'picture-from-file':
            $pictureId = validatePicture($errors);
            break;

        case 'without-picture':
            $pictureId = null;
            break;

        default:
            $pictureId = $_POST['picture-id'];
            break;
    }
    

    $title = secureInputText($_POST['title']);
    $content = secureInputText($_POST['content']);
    $featured = isset($_POST['featured']);
    $id = isset($articleToEdit) ? $articleToEdit->getId() : null;

    $articleToView = new Article($id, $title, $content, null, null, $featured, null, $pictureId);

    $publishTime = time();
    $status = 'draft';

    $publishButtonClicked = isset($_POST['publish-button']);
    $saveButtonClicked = isset($_POST['save-button']);

    if ($publishButtonClicked) {
        $status = $isArticlePublished ? 'draft' : 'published';
    }

    if ($saveButtonClicked) {
        $status = $isArticlePublished ? 'published' : 'draft';
    }

    if ($saveButtonClicked || $isArticlePublished) {
        $publishTime = null;
    }

    if (strlen($title) < 1 || strlen($title) >200) {
        $errors['title'] = "Tytuł nie może być pusty i nie może przekraczać 200 znaków";
    }

    if (strlen($content) > 65530) {
        $errors['content'] = "Przekroczono limit znaków w zawartości artykułu, liczba znaków nie może przekraczać 65530";
    }

    $userId = null;
    if (isset($_SESSION['login'])) {
        $userId = $_SESSION['login'];
    }

    if (count($errors) == 0) {
        //dodawanie nowego artykulu
        if ($articleToEdit == null) {
            if ($pictureId != null) {
                $createArticleRequest = CreateArticleRequest::createWithPhoto($title, $content, $publishTime, $status, $featured, $userId, $pictureId);
                (new ArticleRepository)->saveArticleFromRequest($createArticleRequest);
            } else {
                $createArticleRequest = CreateArticleRequest::createWithoutPhoto($title, $content, $publishTime, $status, $featured, $userId);
                (new ArticleRepository)->saveArticleFromRequest($createArticleRequest);
            }
        } else {
            //aktualizacja artykulu
            $articleToEdit->setTitle($title);
            $articleToEdit->setContent($content);
            $articleToEdit->setFeatured($featured);
            $articleToEdit->setPhotoId($pictureId);

            if ($publishButtonClicked) {
                $articleToEdit->setPublishedTimestamp($publishTime);
            }

            if ($articleToEdit == null || !$saveButtonClicked)
                $articleToEdit->setStatus($status);

            (new ArticleRepository)->updateArticle($articleToEdit);
        }
        switch ($status) {
            case 'draft':
                addAlert("Artykuł został zapisany jako wersja robocza.", "success");
                break;
            case 'published':
                addAlert('Artykuł został opublikowany na blogu.', "success");
                break;
        }
        header("Location: " . _RHOME . "articles-list/");
        exit();
    }
} else {
    //edycja artykulu po kliknieciu w przycisk edytuj artyklul
    if (isset($_GET['edit-article'])) {
        $articleToEdit = (new ArticleRepository)->getArticleById($_GET['edit-article'])['article'];
        $articleToView = $articleToEdit;
        $isArticlePublished = $articleToEdit->getStatus() == 'published';
        $publishButtonTextToDisplay = $isArticlePublished ? $unpublishButtonText : $publishButtonText;
        $saveButtonTextToDisplay = $updateButtonText;

        //przekieruj jesli user probuje edytowac nie swoj artykul
        if ($articleToEdit->getUserId() != $_SESSION['login']) {
            redirectIfNotAdmin($userRole);
        }
    } else {
        //dodanie nowego artykulu
        $articleToView = new Article(null, null, null, null, null, null, null, null);
    }
}
$photoRepo = new PhotoRepository();
$allPhotos = $photoRepo->getAllPhotos(); //pobranie zdjec z bazy danych do wyświetlenia pod artykułem