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

<?php
	// require_once("dbcontroller.php");
	// $db_handle = new DBController();
	// if(!empty($_GET["id"])) {
	// $query = "UPDATE registered_users set status = 'active' WHERE id='" . $_GET["id"]. "'";
	// $result = $db_handle->updateQuery($query);
	// 	if(!empty($result)) {
	// 		$message = "Your account is activated.";
	// 	} else {
	// 		$message = "Problem in account activation.";
	// 	}
	// }
?>
<?php require_once 'footer.php';?>