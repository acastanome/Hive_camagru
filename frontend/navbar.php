<nav>
  <div class="dropdown" onclick="window.location='home.php';">
    Home
  </div>

  <?php
  if (isset($_SESSION['logged_user']))
  {
  ?>
  <div class="dropdown" onclick="window.location='add.php';">
    Camera
  </div>

  <button class="dropdown dropbtn" style="float: right;" onclick="window.location='logout.php';">
    Log out
  </button>
  
  <div class="dropdown" style="float: right;" onclick="window.location='profile.php';"><?php echo(htmlspecialchars($_SESSION['logged_user'])); ?></div>

  <?php
  }
  else
  {
  ?>
  <div class="dropdown" style="float: right;" onclick="window.location='login.php';">
    Log in
  </div>
  <div class="dropdown" style="float: right;" onclick="window.location='create_account.php';">
    Sign up
  </div>
  <?php
  }
  ?>

</nav>