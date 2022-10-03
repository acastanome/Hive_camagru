
<div>
      <?php
      if (!isset($_SESSION['logged_user']))
      { ?>
      <h3>Not logged in. <br>Display navbar (Home, log in) and all photos(cant comment or like)</h3>
      <?php
      }
      else
      { ?>
      <h3>Display navbar (Home, camera, profile, log out) and all photos(can comment or like)</h3>
      <?php
      }
      require_once '../backend/db_gallery.php';
      $gallery = getAllImages();
      if ($gallery) {
            echo $gallery;
      }
      else {
            echo "no images in gallery";
      }
      ?>
</div>