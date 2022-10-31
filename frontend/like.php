<?php
require_once "head.php";
require_once "../backend/db_likes.php";

if (isset($_POST['like'])){
	$img_id = $_POST['image_heart'];
    $heart = $_POST['heart_status'];
	if ($heart == 'like' && checkUserLikedImg($_SESSION['logged_id'], $img_id)==0){
    likeImg($_SESSION['logged_id'], $img_id);
    $userliked = 1;
	} 
    else if ($heart == 'dislike' && checkUserLikedImg($_SESSION['logged_id'], $img_id)!=0){
    unlikeImg($_SESSION['logged_id'], $img_id);
    $userliked = 0;
	}
}
?>