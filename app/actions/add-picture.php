<?php
    function validatePicture($errors) {
        $fields['alt'] = array_key_exists('alt', $_POST) ? $_POST['alt'] : ''; //ustawienie zmiennej title w tablicy fields
        
        $errors = array();
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
                
                $temp_name = $_FILES['file']['tmp_name']; //zmienna do przechowywania tymczasowej nazwy
                $file_name = $_FILES['file']['name']; //zmienna przechowywująca nazwę pliku
                $file_create = _UPLOADS_PATH.'\\'.$today;
                $file_root = $file_create.'\\'.$file_name; //ścieżka dostępu do pliku
                if(!file_exists($file_create))
                {
                    mkdir($file_create,0777,true);
                    move_uploaded_file($temp_name, $file_root); //przesunięcie pliku do folderu images
                }
                else
                {
                    move_uploaded_file($temp_name, $file_root); //przesunięcie pliku do folderu images  
                }
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
    }
?>