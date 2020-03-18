<?php 
session_start();

//     try{
//     // On se connecte à MySQL
//     $bdd = new PDO('mysql:host=mysql;dbname=bcbb;charset=utf8', 'root', 'root');
//     $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     }catch(Exception $e){
//         die('Error : ' . $e->getMessage());
//     }

// // };
// $action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING);
// // Insérer une image
//         // echo '<div class="last"><a class="border navbar-brand4 "  href="?table=galerie&action=insert">Insérer une image</a></div> <br>';
//         if ($action == "insert") {
            
//                     function formGaleriePort(){
//                         echo '<form class="codepass1"  method="post" action="" enctype="multipart/form-data">';
//                         echo'<label for="img">mettre ton image</label>';
//                         echo '<input type="file" name="img" id="img" required>';
//                         echo '<button type="submit">Envoyer</button>';
//                         echo '</form>';

//                     }
//             formGaleriePort();

//                 $fileSizeEnMega = 2;
//                 $maxFileSize = $fileSizeEnMega * 1000000;
//                 $allowedExtensions = ['jpg' => "image/jpeg", 'jpeg' => "image/jpeg", 'png' => "image/png", 'gif' => "image/gif"];
//                 //var_dump($_FILES);
//                 if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {

//                     if ($_FILES['img']['size'] <= $maxFileSize) {
//                         $pathInfo = pathinfo($_FILES['img']['name']);

//                         $extension = $pathInfo['extension'];
//                         if (array_key_exists($extension,$allowedExtensions) && mime_content_type($_FILES['img']['tmp_name']) == $allowedExtensions[$extension]){

//                             $uploadedFilePath = 'assets/image/' . $_FILES['img']['name'];

//                             move_uploaded_file($_FILES['img']['tmp_name'], __DIR__.'/'.$uploadedFilePath);
                            
//                             $request = "INSERT INTO `image`(`img`) VALUES (:img)";
//                             $insert = $bdd->prepare($request);

//                             try {
//                                 $insert->execute(['img' => $uploadedFilePath]);

//                             }catch (PDOException $e){
//                                 die($e->getMessage());
//                             }

//                             //header('Location: profil.php');
//                         } else {
//                             echo 'Extension différente';
//                         }

//                     } else {
//                         echo '<div class="codepass1">fichier trop gros</div>';
//                     }

//                     // header('Location: testimg.php');


//             } else {
//                 echo '<div class="codepass1">Insérer une valeur à chaque champ</div>';
//             }
//         }

// formTableGaleriePort($lines);

//----------------------------------------------------------------------------------------------------------
// Update une image
// if ($action == "update") {
//     function formGaleriePort(){
//         echo '<form class="codepass1"  method="post" action="" enctype="multipart/form-data">';
//         echo'<label for="img">mettre ton image</label>';
//         echo '<input type="file" name="img" id="img" required>';
//         echo '<button type="submit">Envoyer</button>';
//         echo '</form>';

//     }

//     formGaleriePort();
    
//     // $img = filter_input(INPUT_POST, "img", FILTER_SANITIZE_STRING);
//     if(!empty($img)){
      
//         $request = "UPDATE `image` SET `img` = :img WHERE `id_img` = :id_img";
//         $insert = $bdd->prepare($request);
//         $insert->execute(['img' => $_POST['img'], 'id_img' => $_GET['id_img']]);

//         header('Location: testimg.php');
//     }else{
//         echo '<div class="codepass1">Insérer une valeur à chaque champ</div>';
//     }
// }
// // Delete une image
// if($action == "delete"){

    
//     $request = 'DELETE FROM `image` WHERE `id_img` = :id_img';
//     $delete = $bdd->prepare($request);
//     $delete->execute(['id_img' => $_GET['id_img']]);
//     header('Location:testimg.php');
//     }
//------------------------------------------------------------------------------------//

    //    $requestSelect = $bdd->query('SELECT * FROM `image`');
    //     $reponse = $requestSelect;
    //     $lines = $reponse->fetchAll();

    //         echo '<table>';
    //         echo '<thead>';
    //         echo '<td>id</td>';
    //         echo '<td>image</td>';
    //         echo '</thead>';
    //         echo '<tbody>';
    //         foreach ($lines as $line){

    //             echo '<tr>';
    //             echo '<td>'.$line['id_img'].'</td>';
    //             echo '<td>'.$line['img'].'</td>';
    //             echo '<td><a href="?table=image&action=update&id='.$line['id_img'].'">Update</a></td>';
    //             echo '<td><a href="?table=image&action=delete&id='.$line['id_img'].'">Delete</a></td>';
    //             echo '</tr>';
    //         }
    //         echo '<tbody>';
    //         echo '</table>';

//----------------------------------------------------------------------------------------------------------------------------
//affichage de l'image en image 
$host = 'mysql';
$user ='root';
$password = 'root';
$mybase ='bcbb';

$conn = mysqli_connect($host, $user, $password, 'bcbb');

    // $req = "SELECT * FROM image";
    // $res = $conn->query($req);
    // echo "<table>";
    // while($data = mysqli_fetch_array($res)) {
    //     // on affiche les résultats
    //     echo "<tr><td>".$data['id_img']."</td><td><img".$data['img']."></td></tr>";
    // }
    // echo "</table>";
    function transfert(){
        $ret        = false;
        $img_blob   = '';
        $img_taille = 0;
        $img_type   = '';
        $img_nom    = '';
        $taille_max = 250000;
        $ret        = is_uploaded_file($_FILES['fic']['tmp_name']);
        
        if(!$ret){
            echo "Problème de transfert";
            return false;
        }else{
            // Le fichier a bien été reçu
            $img_taille = $_FILES['fic']['size'];
            
            if ($img_taille > $taille_max) {
                echo "Trop gros !";
                return false;
            }

            $img_type = $_FILES['fic']['type'];
            $img_nom  = $_FILES['fic']['name'];

            $img_blob = file_get_contents($_FILES['fic']['tmp_name']);
            $req = "INSERT INTO image (" . 
                    "img_nom, img_taille, img_type, img_blob " .
                    ") VALUES (" .
                    "'" . $img_nom . "', " .
                    "'" . $img_taille . "', " .
                    "'" . $img_type . "', " .
                    "'" . $img_blob . "') ";
            $ret = mysqli_query($conn,$req) or die(mysqli_error($conn));
            return true;
        }
    }


    $req = "SELECT img_nom, img_id " .
           "FROM images ORDER BY img_nom";
    $ret = mysqli_query($conn,$req) or die(mysql_error ($conn));
        while($col = mysql_fetch_row($conn)){
            echo "<a href=\"apercu.php?id=" . $col[1] . "\">" . $col[0] . "</a><br />";
            }
 

    




?>



