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
        imgId INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        userId INT UNSIGNED NOT NULL,
        imgName VARCHAR(30) NOT NULL,
        creationTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        likes INT UNSIGNED DEFAULT '0',
        comments INT UNSIGNED DEFAULT '0')";
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

//returns value (ex. in users table $result[0] is userid)if it finds the qualifier, nothing otherwise
function selectOneQualifier($conn, $table, $col, $qualifier) {
    try {
        $sql = $conn->prepare("SELECT * FROM `$table` WHERE $col = '$qualifier'");
        $sql->execute();
        $result = $sql->fetch();
        return $result;//[0] would return userid but creates a warning with apache
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
        return false;
    }
}

?>