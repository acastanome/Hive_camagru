<?php
if (!isset($_SESSION)) {
  session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css" />
    <title>Camagru</title>
</head>
<body>
    <h1>CAMAGRU</h1>
    <nav>
      <div class="dropdown" id="out">
        <button class="dropbtn">
          <a href="index.php">Home</a>
        </button>
      </div>

      <?php
      if (!$_SESSION['logged_user'] || $_SESSION['logged_user'] === "")
      {
      ?>
      <div class="dropdown" id="out" style="float: right;">
        <button class="dropbtn">
          <a href="login.php">Log in</a>
        </button>
      </div>
      <?php
      }
      else
      {
      ?>
      <div class="dropdown" id="out">
        <button class="dropbtn">
        <a>Camera</a>
        </button>
      </div>
      <div class="dropdown" id="out">
        <button class="dropbtn">
          <a href="product_page.php">For me</a>
        </button>
        <div class="dropdown-content" id="out1">
          <a>My photos</a>
          <a>Settings</a>
        </div>
      </div>
      <div class="dropdown" id="out" style="float: right;">
        <button class="dropbtn">
          <a href="logout.php">Log out</a>
        </button>
      </div>
      <?php
      }
      ?>

    </nav>
<h3>Welcome head</h3>
<!-- </body> -->