<?php
require_once _CLASSES_PATH . DIRECTORY_SEPARATOR . 'AddPhotoRequest.php';
require_once _REPOSITORIES_PATH . DIRECTORY_SEPARATOR . 'PhotoRepository.php';
    $photoRepo = new PhotoRepository();
    
    
    /**
     * pobranie rozszerzenia pliku z nazwy (bez kropki)
     * @param string $filename nazwa pliku z rozszerzeniem
     * @return string rozszerzenie pliku
     */
    function getFileExtension($filename)
    {
        $fileNameArray = (explode('.', $filename));
        $extension = end($fileNameArray);
        return $extension;
    }

    /**
     * sprawdzenie poprawnosci pliku i wyslanie pliku na serwer jezeli plik jest poprawny
     * @param array &$errors tablica do przechowywania bledow
     * @param array $allowedExtensions tablica z dozwolonymi rozszerzeniami
     * @return int|string|null ostatnie id zdjecia dodanego do bazy lub null gdzy blad zapytania sql lub "picture-from-file" jezeli blad przeslania zdjecia z opisem aby wyswietlic bledy w widoku
     */
    function validatePicture(&$errors, $allowedExtensions = array('jpg', 'jpeg', 'png')) {
        $alt = array_key_exists('alt', $_POST) ? $_POST['alt'] : ''; //pobranie z POST opisu zdjecia lub pusty string jezeli brak opisu
        $returnId = "picture-from-file"; //napis wymagany do pokazania formularza przesylania zdjecia z ewentualnymi bledami

        //czy formularz przesylania zdjecia zostal wypelniony
        if(count($_POST) > 0)
        {
            //komunikat bledu przy pustym opisie zdjecia
            if(strlen($alt) == 0)
            {
                $errors['alt'] = 'Pole jest wymagane.';
            } else {            
                //sprawdzanie, czy został wysłany plik
                if(is_uploaded_file($_FILES['file']['tmp_name']))
                {
                    $today = date("Y-m-d"); //pobranie aktualnej daty
                    $tempName = $_FILES['file']['tmp_name']; //tymczasowa nazwa
                    $fileName = $_FILES['file']['name']; //faktyczna nazwa pliku z rozszerzeniem
                    $actualName = pathinfo($fileName, PATHINFO_FILENAME); //faktyczna nazwwa pliku bez rozszerzenia
                    $originalName = $actualName;
                    $extension = getFileExtension($fileName);
                    $dirForCurrentFileUpload = _UPLOADS_PATH. DIRECTORY_SEPARATOR .$today; //docelowy katalog
                    $i = 1;
                    while(file_exists($dirForCurrentFileUpload. DIRECTORY_SEPARATOR .$actualName.".".$extension))
                    {         
                        $actualName = (string)$originalName."(".$i.")"; //numeracja pliku
                        $fileName = $actualName.".".$extension; //koncowa nazwa pliku
                        $i++;
                    }
                    $fileRoot = $dirForCurrentFileUpload. DIRECTORY_SEPARATOR .$fileName; //ścieżka dostępu do pliku
                                        
                    if(in_array($extension, $allowedExtensions))
                    {
                        //stworzenie katalogu jezeli nie istnieje
                        if(!file_exists($dirForCurrentFileUpload))
                        {
                            mkdir($dirForCurrentFileUpload,0777,true);
                        }
                        
                        move_uploaded_file($tempName, $fileRoot); //przeniesienie pliku do folderu uploads
                        $photoRequest = new AddPhotoRequest($fileRoot, $alt);
                        $photoRepo= new PhotoRepository();

                        $returnId = $photoRepo->savePhotoFromRequest($photoRequest);
                    }
                    else
                    {
                        //komunikat o dozwolonych typach plikow
                        $errors['file'] = 'Dozwolone tylko pliki z rozszerzeniem: ' . implode(', ', $allowedExtensions);
                    }
                }
                else
                {
                    //wypisanie błędu przy braku wybrania pliku
                    $errors['file'] = 'Plik jest wymagany.';
                } 
            }
        }
        return $returnId;
    }
