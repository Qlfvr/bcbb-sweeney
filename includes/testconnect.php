<?php 

function ConnectBdd(){

    try{
    // On se connecte à MySQL
    $bdd = new PDO('mysql:host=g4yltwdo6z0izlm6.chr7pe7iynqr.eu-west-1.rds.amazonaws.com;dbname=qzd0dusw8ob73fdo;charset=utf8','hpya3i8f0c3nymfm','xvxw1nfar44r7iin');

    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(Exception $e){
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());
    }





};



?>