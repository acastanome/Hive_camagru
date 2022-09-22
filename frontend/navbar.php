<nav>
      <div class="dropdown" id="out">
        <button class="dropbtn">
          <a href="home.php">Home</a>
        </button>
      </div>

      <?php
      if (!isset($_SESSION['logged_user']))
      {
      ?>
      <!-- <h3>Not logged in. <br>Display navbar (Home, log in) and all photos(cant comment or like)</h3> -->
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
      <!-- <h3>Display navbar (Home, camera, profile, log out) and all photos(can comment or like)</h3> -->
      <div class="dropdown" id="out">
        <button class="dropbtn">
        <a href="camera.php">Camera</a>
        </button>
      </div>
      <div class="dropdown" id="out">
        <button class="dropbtn">
          <a href="profile.php">My profile</a>
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