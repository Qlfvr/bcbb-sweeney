<?php session_start(); ?>
<?php include "includes/functions.php";?>
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
      <?php include "includes/topics.php";?>
    </div>
  </div>
  <script src="/js/jquery.min.js"></script>
  <script src="/js/bootstrap.min.js"></script>
</body>

</html>