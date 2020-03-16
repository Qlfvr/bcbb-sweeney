<?php 


try
{
// On se connecte à MySQL
$bdd = new PDO('mysql:host=mysql;dbname=bcbb;charset=utf8', 'root', 'root');

$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e)
{
// En cas d'erreur, on affiche un message et on arrête tout
die('Erreur : '.$e->getMessage());
}

function transfert(){
        $bdd        = false;
        $img_blob   = '';
        $img_taille = 0;
        $img_type   = '';
        $img_nom    = '';
        $taille_max = 250000;
        $bdd        = is_uploaded_file($_FILES['fic']['tmp_name']);
        
        if (!$bdd) {
            echo "Problème de transfert";
            return false;
        } else {
            // Le fichier a bien été reçu
            $img_taille = $_FILES['fic']['size'];
            
            if ($img_taille > $taille_max) {
                echo "Trop gros !";
                return false;
            }

            $img_type = $_FILES['fic']['type'];
            $img_nom  = $_FILES['fic']['name'];
        }
        $img_blob = file_get_contents ($_FILES['fic']['tmp_name']);
        $rep = "INSERT INTO image (" .
                            "img_nom, img_taille, img_type, img_blob " .
                            ") VALUES (" .
                            "'" . $img_nom . "', " .
                            "'" . $img_taille . "', " .
                            "'" . $img_type . "', " .
                            "'" . addslashes ($img_blob) . "') "; // N'oublions pas d'échapper le contenu binaire
        $bdd = mysql_query ($rep) or die (mysql_error ());
        return true;

    }





?>