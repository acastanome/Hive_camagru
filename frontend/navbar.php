<nav>
      <div class="dropdown" onclick="window.location='home.php';">
        Home
      </div>

      <?php
      if (isset($_SESSION['logged_user']))
      {
      ?>
      <div class="dropdown" onclick="window.location='camera.php';">
        Camera
      </div>

      <div class="dropdown">
        My profile
        <div class="dropdown-content">
          <a href="myphotos.php">My photos</a>
          <a href="settings.php">Settings</a>
        </div>
      </div>

      <button class="dropdown dropbtn" style="float: right;" onclick="window.location='logout.php';">
        Log out
      </button>
      <?php
      }
      else
      {
      ?>
      <div class="dropdown" style="float: right;" onclick="window.location='login.php';">
        Log in
      </div>
      <?php
      }
      ?>

</nav>