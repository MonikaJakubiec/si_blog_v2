<?php
require_once _CLASSES_PATH . DIRECTORY_SEPARATOR . 'AddPhotoRequest.php';
require_once _REPOSITORIES_PATH . DIRECTORY_SEPARATOR . 'PhotoRepository.php';

    function validatePicture() {
        $pictureIdAndErrors = [];
        $fields['alt'] = array_key_exists('alt', $_POST) ? $_POST['alt'] : ''; //ustawienie zmiennej title w tablicy fields
        
        $errors = array(); //niepotrzebne raczej TODO usun
        
        //sprawdzanie, czy tablica metody POST jest większa od 0
        if(count($_POST) > 0)
        {
            //sprawdzanie, czy zmienna title w tablicy fields jest pusta
            if(strlen($fields['alt']) == 0)
            {
                //wpisanie do zmiennej title w tablicy errors komunikatu
                $errors['alt'] = 'Pole jest wymagane.';
            }
            
            //sprawdzanie, czy został wysłany plik
            if(is_uploaded_file($_FILES['file']['tmp_name']))
            {
                $today = date("Y-m-d");
                
                $tempName = $_FILES['file']['tmp_name']; //zmienna do przechowywania tymczasowej nazwy
                $fileName = $_FILES['file']['name']; //zmienna przechowywująca nazwę pliku
                $dirForCurrentFileUpload = _UPLOADS_PATH. DIRECTORY_SEPARATOR .$today;
                $fileRoot = $dirForCurrentFileUpload. DIRECTORY_SEPARATOR .$fileName; //ścieżka dostępu do pliku
                if(!file_exists($dirForCurrentFileUpload))
                {
                    mkdir($dirForCurrentFileUpload,0777,true);

                }

                move_uploaded_file($tempName, $fileRoot); //przesunięcie pliku do folderu images
                $photoRequest = new AddPhotoRequest($fileRoot, $fields['alt']);
                $photoRepo= new PhotoRepository();

                $returnId = $photoRepo-> savePhotoFromRequest($photoRequest);
                
                array_push($pictureIdAndErrors, $returnId);
            }
            else
            {
                //wypisanie błędu przy braku wybrania pliku
                $errors['file'] = 'Plik jest wymagany.';
            }
            //sprawdzanie, czy tablica errors jest równa 0
            if(count($errors) == 0)
            {
                //przekierowani na stronę główną
                header("Location: "._RHOME);
            }   
        }
        array_push($pictureIdAndErrors,$errors);
        return $pictureIdAndErrors;
    }
?>