<?php
session_start();
// Connection à la base de donnée
   try {
    $bdd = new PDO('mysql:host=mysql;dbname=bcbb;charset=utf8', 'root', 'root');
} catch (Exception $e) {
    die('Error : ' . $e->getMessage());
}

// Ajout User




$new_user = $bdd->prepare('INSERT INTO users (nickname, email, password) VALUES (:nickname, :email, :password)');
if(isset($_POST['submit_sign_up'])){ // Si il y a envoie du formulaire valide, execute l'ajout des champs dans la BDD
    $new_user->execute(array(
        'nickname' => htmlspecialchars($_POST['nickname']),
        'email' => htmlspecialchars($_POST['email']),
        'password' => htmlspecialchars(password_hash($_POST['password'], PASSWORD_DEFAULT))
       ));
    //    echo 'Welcome, new user';
    //header("Location: index.php");
}

// if($new_user->errorCode() == '00000')
//         {
//         $id = $bdd->lastInsertId();
//         $_SESSION['id']=$id;
//         // Redirection du visiteur vers la page suivante
//         header("location:index.php");
//         }
//     else
//         {
//            // header("location:index.php");
//             echo '<div class="mx-auto">Cet email est deja inscrit !</div>';
//         }





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