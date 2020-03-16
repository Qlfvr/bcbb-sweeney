<?php session_start(); ?>
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

$request = $bdd->prepare('SELECT * FROM boards ORDER BY id ASC');
$request->execute(array());
$lasttopicquery = $bdd->prepare('SELECT * FROM topics WHERE boards_id= ? ORDER BY id DESC LIMIT 1');
$last3messagesquery = $bdd->prepare('SELECT * FROM messages WHERE topics_id= ? ORDER BY id DESC LIMIT 3');
?>

<?php include "includes/functions.php";?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/a990d1fe00.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="/css/style.css" />
  <title>Sweeney</title>
</head>

<body>

  <?php include "includes/topmenu.php";?>
  <div class="wrapper">
    <?php include "includes/sidebar.php";?>
    <div class="content">

      <?php if (empty($_GET)) : ?>
      <div class="container-fluid">
        <div class="row">
          <?php while ($boards = $request->fetch()) : ?>
          <div class="col-md-6 col-xl-3">
            <div class="card">

              <div class="card-header">
                <a href="?board_id=<?php echo$boards['id']; ?>" class="stretched-link text-decoration-none">

                  <h2><?php echo $boards["name"] ?></h2>
                </a>
              </div>

              <div class="card-body">

                <?php $lasttopicquery->execute(array($boards["id"])); 
                while ($lasttopic = $lasttopicquery->fetch()) :
                  echo "Last topic : <br>";
                echo("<b>".$lasttopic["title"]."</b>");
                echo"<hr>";
                  $last3messagesquery->execute(array($lasttopic["id"]));
                  while ($last3messages = $last3messagesquery->fetch()) :
                  echo ("<p>".$last3messages["content"]."</p>");
                  endwhile;
                endwhile;
                ?>
              </div>
            </div>
          </div>
          <?php endwhile?>
        </div>
      </div>
      <?php endif ?>

      <?php include "includes/topics.php";?>

    </div>
  </div>
  <script src="/js/jquery.min.js"></script>
  <script src="/js/bootstrap.min.js"></script>
</body>

</html>