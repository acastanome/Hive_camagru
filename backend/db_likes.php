<?php
require_once 'db_connect.php';

function getLikesFromImageId($imgId) {
    $conn = connectPDODB();
    try {
        $sql = $conn->prepare("SELECT `likes` FROM Images WHERE (`img_id` = ?)");
        $sql->execute([$imgId]);
        $result = $sql->fetch();
        $conn = null;
        if ($result) {
            return $result[0];
        }
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
    }
}

//returns 1 or 0, depending if that user already liked that img or not
function checkUserLikedImg($userId, $imgId) {
    $conn = connectPDODB();
    try {
        $sql = $conn->prepare("SELECT * FROM likes WHERE (`user_id` = ? AND `img_id` = ?)");
        $sql->execute([$userId, $imgId]);
        $result = $sql->fetch();
        if ($result) {
            return $result[0];
        } else return "0";
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
    }
}
function likeImg($userId, $imgId) {
    $conn = connectPDODB();
    try {
        $sql = $conn->prepare("UPDATE `Images` SET `likes` =`likes`+1 WHERE (`img_id`=?)");
        $sql->execute([$imgId]);
        $sql = $conn->prepare("INSERT INTO `likes`(`user_id`, `img_id`)
        VALUES (?, ?)");
        $result = $sql->execute([$userId, $imgId]);
        return $result;
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
    }
}
function unlikeImg($userId, $imgId) {
    $conn = connectPDODB();
    try {
        $sql = $conn->prepare("UPDATE `Images` SET `likes` =`likes`-1 WHERE (`img_id`=?)");
        $sql->execute([$imgId]);
        $sql->fetchAll();
        $sql = $conn->prepare("DELETE FROM `likes` WHERE (`user_id`=? AND `img_id`=?)");
        $result = $sql->execute([$userId, $imgId]);
        return $result;
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
    }
}

function updateLiked($img_id, $to) {
	if ($to = 'full' && checkUserLikedImg($_SESSION['logged_id'], $img_id)==0){
        likeImg($_SESSION['logged_id'], $img_id);
	} 
    if ($to = 'outline' && checkUserLikedImg($_SESSION['logged_id'], $img_id)==1){
        unlikeImg($_SESSION['logged_id'], $img_id);
	}
}
?>