<?php

//Data base connexion with PDO
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
?>

<?php

    $test=$_GET["topic_id"];
    $req_messages = $bdd->prepare('SELECT * FROM messages WHERE topics_id =? ORDER BY creation_date ASC');
    $req_messages->execute(array($_GET["topic_id"]));
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a990d1fe00.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/style.css" />
    <title>Document</title>
</head>

<body>

    <?php include "includes/topmenu.php";?>
    <div class="wrapper">

        <?php include "includes/sidebar.php";?>

        <div class="content">


            <div class="card mb-2 mt-2">
                <div class="card-header">
                    <h2> <?php echo $_GET["topic_title"] ?></h2>
                </div>
                <div class="card-body">

                    <?php while ($messages = $req_messages->fetch()) : ?>

                    <div class="card m-3">

                        <div class="card-body bg-light-gray">

                            <?php echo$messages["content"]."<br>"; ?>

                        </div>
                    </div>

                    <?php endwhile ?>







                </div>

            </div>






        </div>

    </div>

    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
</body>

</html>