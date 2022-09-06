<?php
function createTableUser($conn) {
    $sql = "CREATE TABLE Users (
        userId INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        userName VARCHAR(30) NOT NULL,
        email VARCHAR(50) NOT NULL,
        confirmedAccount BOOLEAN DEFAULT 'false',
        psswd VARCHAR(128) NOT NULL
        notifications BOOLEAN DEFAULT 'true',
        )";
    $conn->exec($sql);
}

function createTableImages($conn) {
    $sql = "CREATE TABLE Images (
        imageId INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        userId INT(6) UNSIGNED NOT NULL,
        creationTime
        likes
        comments
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
}
function deleteUserFromTable() {
}
?>