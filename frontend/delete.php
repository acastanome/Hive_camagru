<?php
require_once "head.php";
require_once "../backend/db_gallery.php";

if (isset($_SESSION['logged_user'])) {
    if (isset($_POST['delete_image'])){
        $imgId = $_POST['delete_image_id'];
    	if (userOwnsImage($_SESSION['logged_id'], $imgId)) {
            deletePost($imgId);
        }
    }
    header("Location: add.php");
} else {
    header("Location: login.php");
}
