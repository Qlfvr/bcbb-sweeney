<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in or sign up</title>
</head>
<body>
    <form action="post" action="">
        <p>Create an account :</p>
       <!-- <input type="text" name="firstname" id="firstname" placeholder="Firstname" required autofocus/><br/> -->
       <!-- <input type="text" name="lastname" id="lastname" placeholder="Lastname" required/><br/> -->
       <!-- <input type="date" name="birthday" id="birthday" placeholder="birthday" required/><br/> -->
       <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" required/><br/>
        <input type="email" name="email" id="email" placeholder="e-mail" required/><br/>
        <input type="password" name="password" id="password" placeholder="Password" required/><br/>
        <input type="submit" name="submit" id="submit" value="Sign up"/>
    </form>
    <form action="post" action="">
        <p>Connextion :</p>
        <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" required/><br/>
        <input type="password" name="password" id="password" placeholder="Password" required/><br/>
        <input type="submit" name="submit" id="submit" value="Sign in"/>
    </form>

</body>
</html>