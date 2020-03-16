<?php 

function connectToBdd(){


    
};



// Si on clique sur  galerie
if ($table == 'galerie'){
    $action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING);
// Insérer une image
    echo '<div class="last"><a class="border navbar-brand4 "  href="?table=galerie&action=insert">Insérer une image</a></div> <br>';
    if($action == "insert"){
       
                $fileSizeEnMega = 2;
                $maxFileSize = $fileSizeEnMega * 1000000;
                $allowedExtensions = ['jpg' => "image/jpeg", 'jpeg' => "image/jpeg", 'png' => "image/png", 'gif' => "image/gif"];
                var_dump($_FILES);
                if(isset($_FILES['img']) && $_FILES['img']['error'] == 0){

                    if($_FILES['img']['size'] <= $maxFileSize){
                        $pathInfo = pathinfo($_FILES['img']['name']);

                        $extension = $pathInfo['extension'];
                        if(array_key_exists($extension,$allowedExtensions) && mime_content_type($_FILES['img']['tmp_name']) == $allowedExtensions[$extension]){

                            $uploadedFilePath = 'image/' . $_FILES['img']['name'];

                            move_uploaded_file($_FILES['img']['tmp_name'], __DIR__.'/../'.$uploadedFilePath);
                            $pdo = connectToDb();
                            $request = "INSERT INTO `users`(`img`) VALUES (:img)";
                            $insert = $pdo->prepare($request);

                            try{
                                $insert->execute(['img' => $uploadedFilePath]);

                            }catch(PDOException $e){
                                die($e->getMessage());
                            }

                            header('Location: admin.php?table=galerie');
                        }else{
                            echo 'Extension différente';
                        }

                    }else{
                        echo '<div class="codepass1">fichier trop gros</div>';
                    }

                    //header('Location: admin.php?table=galerie');


            }else{
                echo '<div class="codepass1">Insérer une valeur à chaque champ</div>';
            }
        }

        $pdo = connectToDb();
        $requestSelect = $pdo->query('SELECT * FROM `users`');
        $reponse = $requestSelect;
        $lines = $reponse->fetchAll();

        // formTableGaleriePort($lines);


// Update une image
        // if($action == "update"){

        //     formGaleriePort();
        //     $img = filter_input(INPUT_POST, "img", FILTER_SANITIZE_STRING);
        //     if(!empty($img)){
        //         $pdo = connectToDb();
        //         $request = "UPDATE `users` SET  `img` = :img WHERE `id` = :id";
        //         $insert = $pdo->prepare($request);
        //         $insert->execute(['img' => $_POST['img'], 'id' => $_GET['id']]);

        //         header('Location: admin.php?table=galerie');
        //     }else{
        //         echo '<div class="codepass1">Insérer une valeur à chaque champ</div>';
        //     }
        // }


    }







    


?>