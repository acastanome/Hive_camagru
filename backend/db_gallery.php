<?php

require_once 'db_connect.php';

function addImgToTable($userId, $imgName, $imgPath) {
    $conn = connectPDODB();
    try {
        $sql = $conn->prepare("INSERT INTO Images (`user_id`, `img_name`, img_path)
        VALUES (?, ?, ?)");
        $result = $sql->execute([$userId, $imgName, $imgPath]);
        echo "Image added to table successfully";
        if ($result) {
            $sql = $conn->prepare("UPDATE `Users` SET `posts` = `posts`+1 WHERE (`user_id` = ?)");
            $sql->execute([$userId]);
            return $result;
        }
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
    }
}

function getNbPosts() {
    $conn = connectPDODB();
    try {
        $sql = $conn->prepare("SELECT COUNT(*) FROM `Images`");
        $sql->execute();
        $result = $sql->fetch();
        $conn = null;
        if ($result)
            return $result[0];
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
    }
}

function fetch_images(int $first, int $amount) {
    $conn = connectPDODB();
    try {
      $sql = $conn->prepare("SELECT * FROM `Images` ORDER BY `img_id` DESC LIMIT $first, $amount");
      $sql->execute();
      $result = $sql->fetchAll();
      return $result;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
}

function fetch_imagesByUserId($id) {
    $conn = connectPDODB();
    try {
      $sql = $conn->prepare("SELECT * FROM `Images` WHERE (`user_id` = ?)");
      $sql->execute([$id]);
      $result = $sql->fetchAll();
      return $result;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
}

function userOwnsImage($userId, $imgId) {
    $conn = connectPDODB();
    try {
        $sql = $conn->prepare("SELECT `img_id` FROM Images WHERE (`user_id` = ? AND `img_id` = ?)");
        $sql->execute([$userId, $imgId]);
        $result = $sql->fetch();
        $conn = null;
        if ($result) {
            return $result[0];
        }
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
    }
}

function deletePost($imgId) {
    $conn = connectPDODB();
    try {
        $sql = $conn->prepare("DELETE FROM Comments WHERE (`img_id` = ?)");
        $sql->execute([$imgId]);
        $sql = $conn->prepare("DELETE FROM Likes WHERE (`img_id` = ?)");
        $sql->execute([$imgId]);
        $sql = $conn->prepare("DELETE FROM `Images` WHERE (img_id = ?)");
        $sql->execute([$imgId]);
        $sql = $conn->prepare("UPDATE `Users` SET `posts` = (`posts`-1) WHERE `user_id` = ?");
        $sql->execute([$_SESSION['logged_id']]);
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
    }
}
?>