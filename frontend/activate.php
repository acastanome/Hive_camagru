<?php require_once 'head.php'; ?>

<body>
<?php
   require_once 'navbar.php';

   if(!empty($_GET["activation_code"])) {
      require_once '../backend/db_user.php';
      $code = htmlspecialchars($_GET["activation_code"]);
      $conn = connectPDODB();
      try {
         $sql = $conn->prepare("UPDATE `Users` SET `active_account` = true WHERE (`activation_code` = ?)");
         $sql->execute([$code]);
         $result = $sql->rowCount();
         if(!empty($result)) {
            echo "Your account has been activated!";
         } else {
            echo "Problem in account activation.";
         }
      } catch(PDOException $e) {
         echo "<br>" . $e->getMessage();
     }
   }
   else {
      echo "Oh no, there is no activation code. You trickster!";
   }
 ?>

<?php require_once 'footer.php';?>
</body>
</html>