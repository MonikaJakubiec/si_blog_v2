<?php
require_once _CLASSES_PATH . DIRECTORY_SEPARATOR . 'AddPhotoRequest.php';
require_once _REPOSITORIES_PATH . DIRECTORY_SEPARATOR . 'PhotoRepository.php';
    $photoRepo = new PhotoRepository();
    $allPhotos = $photoRepo->getAllPhotos();    
    function getFileExtension($filename)
    {
        $fileNameArray = (explode('.', $filename));
        $extension = end($fileNameArray);
        return $extension;
    }
    function validatePicture(&$errors, $allowedExtensions = array('jpg', 'jpeg', 'png')) {
        $fields['alt'] = array_key_exists('alt', $_POST) ? $_POST['alt'] : ''; //ustawienie zmiennej title w tablicy fields
        $returnId = "picture-from-file";


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
                $actualName = pathinfo($fileName,PATHINFO_FILENAME);
                $originalName= $actualName;
                $extension = getFileExtension($fileName);
                $dirForCurrentFileUpload = _UPLOADS_PATH. DIRECTORY_SEPARATOR .$today;
                $fileRoot = $dirForCurrentFileUpload. DIRECTORY_SEPARATOR .$fileName; //ścieżka dostępu do pliku
                $i = 1;
                while(file_exists($fileRoot))
                {           
                    $actualName = (string)$originalName."(".$i.")";
                    $fileName = $actualName.".".$extension;
                    $i++;
                }
                if(in_array($extension, $allowedExtensions))
                {
                    if(!file_exists($dirForCurrentFileUpload))
                    {
                        mkdir($dirForCurrentFileUpload,0777,true);

                    }
                    
                    move_uploaded_file($tempName, $fileRoot); //przesunięcie pliku do folderu images
                    $photoRequest = new AddPhotoRequest($fileRoot, $fields['alt']);
                    $photoRepo= new PhotoRepository();

                    $returnId = $photoRepo-> savePhotoFromRequest($photoRequest);
                }
                else
                {
                    $errors['file'] = 'Dozwolone tylko pliki z rozszerzeniem: ' . implode(', ', $allowedExtensions);
                }
            }
            else
            {
                //wypisanie błędu przy braku wybrania pliku
                $errors['file'] = 'Plik jest wymagany.';
            }  
        }
        return $returnId;
    }
?>