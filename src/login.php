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
if(isset($_POST['submit_sign_in'])){ // Si il y a envoie du formulaire valide, execute l'ajout des champs dans la BDD
    $new_user->execute(array(
        'nickname' => $_POST['nickname'],
        'email' => $_POST['email'],
        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
       ));
       echo 'Welcome, new user';
   }

// Récup du user et de son password pour Sign up
$nickname = $_POST['nickname'];
$password = $_POST['password'];

$request_user_and_password = $bdd->prepare('SELECT id, password FROM users WHERE nickname = :nickname');
if(isset($_POST['submit_sign_up'])){
    $request_user_and_password->execute(array(
        'nickname' => $nickname));
    $resultat = $request_user_and_password->fetch();
    
    if(!$resultat) {
        echo 'Wrong nickname ! :(';
    } else {
        //Comparaison password du form avec password du bdd
        $password_correct = password_verify($password, $resultat['password']);
        if($password_correct){
            $_SESSION['id'] = $resultat['id'];
            $_SESSION['nickname'] = $nickname;
            header("Location: index.php"); // Une fois tout ok, redirige vers index.php
            die(); //stop
        } else {
            echo 'Wrong password ! :(';
        }
    }

}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in or sign up</title>
</head>

<body>

    <!-- Sign In -->

    <form method="post" action="login.php">
        <p>Create an account :</p>
        <input type="text" name="nickname" id="nickname" placeholder="Nickname" required /><br />
        <input type="email" name="email" id="email" placeholder="E-mail" required /><br />
        <input type="password" name="password" id="password" placeholder="Password" required /><br />
        <!-- <input type="password" name="password_confirm" id="password_confirm" placeholder="Confirmation" required/></br> -->
        <input type="submit" name="submit_sign_in" id="submit_sign_in" value="Sign in" />
    </form>

    <!-- Sign Up -->

    <form method="post" action="login.php">
        <p>Connection :</p>
        <input type="text" name="nickname" id="nickname" placeholder="Nickname" required /><br />
        <input type="password" name="password" id="password" placeholder="Password" required /><br />
        <input type="submit" name="submit_sign_up" id="submit_sign_up" value="Sign up" />
    </form>

</body>

</html>