<?php require_once 'head.php'; ?>

<body>
<?php
   require_once 'navbar.php';
    var_dump($_GET);
 if (isset($_GET)) {
    echo "here !";
 }

   // if(!empty($_GET["id"])) {
   //    require_once '../backend/db_user.php';
   //    $conn = connectPDODB();
   //    try {

   //    }
   //       $sql = $conn->prepare("UPDATE `confirmed_account` set status = '1' WHERE `user_id`='" . $_GET["user_id"]. "'");
   //       $result = $db_handle->updateQuery($query);
   //       if(!empty($result)) {
   //          $message = "Your account has been activated.";
   //       } else {
   //          $message = "Problem in account activation.";
   //    }
   // }
   // else {
   //    echo "oh no, \$_GET[\"id\"] is empty";
   // }
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