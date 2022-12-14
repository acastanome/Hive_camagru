<?php
require_once "head.php";
require_once "../backend/db_comments.php";
require_once "../backend/db_email.php";

if (isset($_POST['comment'])){
	$img_id = $_POST['image_comment'];
    $comment = $_POST['comment_status'];
    $commentText = $_POST['comment_text'];
	if ($comment == 'like' && (strlen($commentText) > 0) && (strlen($commentText) <= 2000)) {
        if (commentImg($_SESSION['logged_id'], $img_id, $commentText)) {
            $usercommented = 1;
            $userToNotify = getUserIdFromImageId($img_id);
            if (getNotifications($userToNotify) == 1) {
                sendNotificationEmail(getEmailFromId($userToNotify));
            }
        }
	}
}
?>