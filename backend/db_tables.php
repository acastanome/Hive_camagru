<?php
function createTableUser($conn) {
    $sql = "CREATE TABLE 'Users' (
        'userId' INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        'userName' VARCHAR(30) NOT NULL,
        'email' VARCHAR(50) NOT NULL,
        'confirmedAccount' BOOLEAN DEFAULT 'false',
        'psswd' VARCHAR(128) NOT NULL
        'notifications' BOOLEAN DEFAULT 'true',
        )";
    $conn->exec($sql);
}

function createTableImages($conn) {
    $sql = "CREATE TABLE 'Images' (
        'imageId' INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        'userId' INT UNSIGNED NOT NULL,
        'name' VARCHAR(30) NOT NULL,
        'path' VARCHAR(250) NOT NULL DEFAULT '',
        'creationTime' TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        'likes' INT UNSIGNED NOT NULL;
        'comments' INT UNSIGNED NOT NULL;
        )";
    $conn->exec($sql);
}

function createTableStickers($conn) {
    $sql = "CREATE TABLE Stickers (
        stickerId INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        selected BOOLEAN DEFAULT 'false',
        )";
    $conn->exec($sql);
}

function addUserToTable() {
//    $sql = "";
}

function deleteUserFromTable() {
}
?>