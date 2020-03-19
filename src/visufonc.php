<?php
if(isset($_FILES['avatar'])){ 
     $dossier = 'assets/imgtest/';
     $fichier = basename($_FILES['avatar']['name']);
     $taille_maxi = 100000;
     $taille = filesize($_FILES['avatar']['tmp_name']);
     $extensions = array('.png', '.gif', '.jpg', '.jpeg');
     $extension = strrchr($_FILES['avatar']['name'], '.'); 
     //Début des vérifications de sécurité...
     if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
     {
          $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
     }
     if($taille>$taille_maxi)
     {
          $erreur = 'Le fichier est trop gros...';
     }
     if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
     {
          //On formate le nom du fichier ici...
          $fichier = strtr($fichier, 
               'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
               'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
          $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
          if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
          {
               echo 'Upload effectué avec succès !';
          }
          else //Sinon (la fonction renvoie FALSE).
          {
               echo 'Echec de l\'upload !';
          }
     }
     else
     {
          echo $erreur;
     }
    }



    try{ // Connexion à la BDD
        $bdd=new PDO('mysql:host=mysql;dbname=bcbb', 'root','root');

        }

        catch(Exception $e){
        die ('Erreur:'.$e->getMessage());

        }



             // Insertion des données envoyées par l'internaute grâce à une requête préparée
            $stockage='assets/imgtest/'.$_FILES['avatar']['name'].'';
            $insertion=$bdd->prepare('INSERT INTO image(imagepath) VALUES (:imagepath)');       
            $insertion->execute(array('imagepath' => $stockage));                          
                if($insertion==true) {
                echo '<p> Les données ont bien été enregistrées</p>';
                }
                else {
                echo 'Erreur dans l\'enregistrement des données </p>';
                    } 
            // //recuperation
       
            //     $recup=$bdd->prepare('SELECT * FROM image WHERE id =?');
            //     $recup->execute(array('imagepath'=> $stockage));
            //     while($img = $recup->fetch()){
            //         $image=$img['imagepath'];
            //     }



        $insertion->closeCursor(); // déconnexion

        

?>