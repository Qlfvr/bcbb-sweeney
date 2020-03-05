<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in or sign up</title>
</head>
<body>

<!-- Sign In -->

    <form method="post" action="loggin.php">
        <p>Create an account :</p>
        <input type="text" name="nickname" id="nickname" placeholder="Nickname" required/><br/>
        <input type="email" name="email" id="email" placeholder="E-mail" required/><br/>
        <input type="password" name="password" id="password" placeholder="Password" required/><br/>
        <!-- <input type="password" name="password_confirm" id="password_confirm" placeholder="Confirmation" required/></br> -->
        <input type="submit" name="submit" id="submit" value="Sign up"/>
    </form>

   <?php
   // Connection à la base de donnée
   try {
       $bdd = new PDO('mysql:host=mysql;dbname=bcbb;charset=utf8', 'root', 'root');
   } catch (Exception $e) {
       die('Error : ' . $e->getMessage());
   }

    // Ajout User
  $new_user = $bdd->prepare('INSERT INTO users (nickname, email, password) VALUES (:nickname, :email, :password)');
   if(isset($_POST['submit'])){ // Si il y a envoie du formulaire, execute l'ajout des champs dans la BDD
       $new_user->execute(array(
           'nickname' => $_POST['nickname'],
           'email' => $_POST['email'],
           'password' => $_POST['password']
       ));
       echo 'Welcome, new user';

   }
   ?>

<!-- Sign Up -->

    <form method="post" action="index.html">
        <p>Connection :</p>
        <input type="text" name="nickname" id="nickname" placeholder="Nickname" required/><br/>
        <input type="password" name="password" id="password" placeholder="Password" required/><br/>
        <input type="submit" name="submit" id="submit" value="Sign in"/>
    </form>

    
</body>
</html>