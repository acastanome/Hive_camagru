<?php require_once 'head.php'; ?>

<body>
<?php
   require_once 'navbar.php';
//     var_dump($_GET);
//  if (isset($_GET)) {
//     echo "here !";
//  }

//check crash if code/var isnt in url
   if(!empty($_GET["activation_code"])) {
      require_once '../backend/db_user.php';
      $code = htmlspecialchars($_GET["activation_code"]);
      $conn = connectPDODB();
      try {
         $sql = $conn->prepare("UPDATE `Users` SET `active_account` = true WHERE (`activation_code`= ?)");
         $result = $sql->execute([$code]);
         if(!empty($result)) {
            //PROBLEM HERE: returns this message even if there is no account to be activated with that code. Otherwise works fine
            echo "Your account has been activated!";
         } else {
            echo "Problem in account activation.";
         }
      } catch(PDOException $e) {
         echo "<br>" . $e->getMessage();
     }
   }
   else {
      echo "oh no, \$_GET[\"activation_code\"] is empty. You trickster!";
   }
 ?>
</body>

<?php require_once 'footer.php';?>