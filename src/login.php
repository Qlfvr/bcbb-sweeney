<?php
session_start();

// // Connection à la base de donnée
   try {
    $bdd = new PDO('mysql:host=mysql;dbname=bcbb;charset=utf8', 'root', 'root');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Error : ' . $e->getMessage());
}

// // Ajout User


$reqmail = $bdd->prepare('SELECT id FROM users WHERE email=?');
if(isset($_POST['submit_sign_up'])){
$reqmail->execute(array($_POST['email']));
$donnees = $reqmail->fetch();
if ($donnees['id'] == 0){

    $new_user = $bdd->prepare('INSERT INTO users (nickname, email, password) VALUES (:nickname, :email, :password)');
    if(isset($_POST['submit_sign_up'])){ // Si il y a envoie du formulaire valide, execute l'ajout des champs dans la BDD
        $new_user->execute(array(
            'nickname' => htmlspecialchars($_POST['nickname']),
            'email' => htmlspecialchars($_POST['email']),
            'password' => htmlspecialchars(password_hash($_POST['password'], PASSWORD_DEFAULT))
           ));
    
    }

    
} else {
    echo 'mail not valid, change email !';
    echo '</br>';
    echo '<a href="index.php">retour a home</a>';
}

}
//--------------------------------------------------------------------------------------------------------------------
// $new_user = $bdd->prepare('INSERT INTO users (nickname, email, password) VALUES (:nickname, :email, :password)');
// if(isset($_POST['submit_sign_up'])){ // Si il y a envoie du formulaire valide, execute l'ajout des champs dans la BDD
//     $new_user->execute(array(
//         'nickname' => htmlspecialchars($_POST['nickname']),
//         'email' => htmlspecialchars($_POST['email']),
//         'password' => htmlspecialchars(password_hash($_POST['password'], PASSWORD_DEFAULT))
//        ));

// }

// $req = $bdd->prepare('SELECT id FROM membres WHERE pseudo=?');
// $req->execute(array($_POST['pseudo']));
// $donnees = $req->fetch();
 
// if ($donnees['id'] == 0)
// {
//   //On enregistre le pseudo car il n'existe pas
// }
// elseif ($donnees['id'] != 0)
// {
//   //Le pseudo existe déjà
// }


// Récup du user et de son password pour Sign in
$nickname = htmlspecialchars($_POST['nickname']);
$password = htmlspecialchars($_POST['password']);

$request_user_and_password = $bdd->prepare('SELECT id, password FROM users WHERE nickname = :nickname');
if(isset($_POST['submit_sign_in'])){
    $request_user_and_password->execute(array(
        'nickname' => $nickname));
    $resultat = $request_user_and_password->fetch();
    
    if(!$resultat) {
        // echo 'Wrong nickname ! :(';
        header("Location: index.php");
    } else {
        //Comparaison password du form avec password du bdd
        $password_correct = password_verify($password, $resultat['password']);
        if($password_correct){
            $_SESSION['id'] = $resultat['id'];
            $_SESSION['nickname'] = $nickname;
            header("Location: index.php"); // Une fois tout ok, redirige vers index.php
            die(); //stop
        } else {
            // echo 'Wrong password ! :(';
            header("Location: index.php");
        }
    }

}



?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/a990d1fe00.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="/css/style.css" />
  <title>Sign in or sign up</title>
</head>

<body>

</body>

</html>