<?php
include"testimg.php";
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

if ( isset($_GET['id']) ){
    $id = intval ($_GET['id']);
    $rep = "SELECT img_id, img_type, img_blob " . 
           "FROM image WHERE img_id = " . $id;
    $bdd = mysql_query ($rep) or die (mysql_error ());
    $col = mysql_fetch_row ($bdd);
    
    if ( !$col[0] ){
        echo "Id d'image inconnu";
    } else {
        header ("Content-type: " . $col[1]);
        echo $col[2];
    }

} else {
    echo "Mauvais id d'image";
}

?>