<?php
function createTableUsers($conn) {
    $sql = $conn->prepare("CREATE TABLE IF NOT EXISTS Users (
        userId INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        userName VARCHAR(30) NOT NULL,
        email VARCHAR(50) NOT NULL,
        confirmedAccount BOOLEAN DEFAULT false,
        psswd VARCHAR(128) NOT NULL,
        notifications BOOLEAN DEFAULT true)");
    $sql->execute();
}

function createTableImages($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS Images (
        imageId INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        userId INT UNSIGNED NOT NULL,
        name VARCHAR(30) NOT NULL,
        path VARCHAR(250) NOT NULL DEFAULT '',
        creationTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        likes INT UNSIGNED NOT NULL,
        comments INT UNSIGNED NOT NULL)";
    $conn->exec($sql);
}

function createTableStickers($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS Stickers (
        stickerId INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        selected BOOLEAN DEFAULT false,
        name VARCHAR(30) NOT NULL,
        path VARCHAR(250) NOT NULL DEFAULT '')";
    $conn->exec($sql);
}

function addUserToTable($conn, $username, $email, $psswd) {
    $sql = "";
    try {
        $sql = "INSERT INTO Users (userName, email, psswd)
        VALUES ('$username', '$email', '$psswd')";
        $conn->exec($sql);
//        echo "User added to Users successfully";
      } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
      }
}

//TODO delete that users photos (comments&likes), then the user
function deleteUserFromTable($conn, $username) {
    $sql = "";
    try {
        $sql = "DELETE FROM Users
        WHERE userId";
        $conn->exec($sql);
        echo "User deleted from Users successfully";
      } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
      }
}
?>