<?php
try
{
// On se connecte à MySQL
$bdd = new PDO('mysql:host=mysql;dbname=bcbb;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
// En cas d'erreur, on affiche un message et on arrête tout
die('Erreur : '.$e->getMessage());
}


$topics = $bdd->prepare('INSERT INTO users(nickname, email, password, signature)
VALUES(:nickname, :email, :password, :signature)');
$req->execute(array(

'nickname' => $nickname,
'email' => $email,
'password' => $password,
'signature' => $signature
));




?>




<div class="card">


    <div class="card-body">

        <h2 class="card-title">
            Titre du topic
        </h2>

        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore iste soluta perferendis aspernatur totam
            cupiditate
            exercitationem sequi dolorum dolores officia, vel minus corrupti vero sed ipsum est autem ad eius.</p>

    </div>

    <div class="card-footer">test</div>
</div>