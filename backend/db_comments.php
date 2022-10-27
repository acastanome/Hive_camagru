<?php
require_once 'db_connect.php';

//returns 1 or 0, depending if that user already commented that img or not
function checkUserCommentedImg($userId, $imgId) {
    $conn = connectPDODB();
    try {
        $sql = $conn->prepare("SELECT * FROM comments WHERE (`user_id` = ? AND `img_id` = ?)");
        $sql->execute([$userId, $imgId]);
        $result = $sql->fetch();
        if ($result) {
            return $result[0];
        } else return "0";
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
    }
}

function commentImg($userId, $imgId, $commentText) {
    $conn = connectPDODB();
    try {
        $sql = $conn->prepare("UPDATE `Images` SET `comments` =`comments`+1 WHERE (`img_id`=?)");
        $sql->execute([$imgId]);
        $sql = $conn->prepare("INSERT INTO `comments`(`user_id`, `img_id`, `comment_text`)
        VALUES (?, ?, ?)");
        $result = $sql->execute([$userId, $imgId, $commentText]);
        return $result;
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
    }
}

function fetch_comments($imgId) {
    $conn = connectPDODB();
    try {
      $sql = $conn->prepare("SELECT * FROM `Comments` WHERE (`img_id` = ?)");
      $sql->execute([$imgId]);
      $result = $sql->fetchAll();
      if ($result) {
        return $result;
      } else {return "0";}
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
}

function getUserIdFromImageId($imgId) {
    $conn = connectPDODB();
    try {
        $sql = $conn->prepare("SELECT `user_id` FROM Images WHERE (`img_id` = ?)");
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

function getNotifications($id) {
    $conn = connectPDODB();
    try {
        $sql = $conn->prepare("SELECT `notifications` FROM Users WHERE (`user_id` = ?)");
        $sql->execute([$id]);
        $result = $sql->fetch();
        $conn = null;
        if ($result) {
            return $result[0];
        }
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
    }
}
?>