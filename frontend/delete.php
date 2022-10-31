<?php
require_once "head.php";
require_once "../backend/db_gallery.php";

?><script>console.log("out");</script><?php
if (isset($_POST['like'])){
	$img_id = $_POST['image_id'];
    ?><script>console.log("in");</script><?php
// }

// if (isset($_POST['delete'])){
// 	$imgId = $_POST['image_id'];
// 	if (userOwnsImage($_SESSION['logged_id'], $imgId)) {
//         deletePost($imgId);
// 	} else { ?>
//         <!-- <script>alert("Not your image, you trickster!");</script> -->
//         <?php
//     }
} else {
    ?><script>console.log("else");</script><?php
}
?>