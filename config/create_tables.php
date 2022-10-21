<?php

function createTableUsers($conn) {
    $sql = $conn->prepare("CREATE TABLE IF NOT EXISTS Users (
        `user_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
        `user_name` VARCHAR(30) NOT NULL,
        email VARCHAR(50) NOT NULL,
        active_account BOOLEAN DEFAULT false,
        activation_code VARCHAR(255) NOT NULL,
        psswd VARCHAR(128) NOT NULL,
        notifications BOOLEAN DEFAULT true,
        `posts` INT UNSIGNED DEFAULT '0')");
        // profile_img_id INT UNSIGNED DEFAULT '0')");
    $sql->execute();
}

function createTableImages($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS Images (
        `img_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
        `user_id` INT UNSIGNED NOT NULL,
        `img_name` VARCHAR(30) NOT NULL,
        img_path VARCHAR(250) NOT NULL,
        creation_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        likes INT UNSIGNED DEFAULT '0',
        comments INT UNSIGNED DEFAULT '0')";
    $conn->exec($sql);
}

function createTableLikes($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS Likes (
        `like_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `user_id` INT UNSIGNED NOT NULL,
        `img_id` INT UNSIGNED NOT NULL,
        creation_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";
    $conn->exec($sql);
}

function createTableComments($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS Comments (
        `comment_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `user_id` INT UNSIGNED NOT NULL,
        `img_id` INT UNSIGNED NOT NULL,
        `comment_text` TEXT NOT NULL,
        creation_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";
    $conn->exec($sql);
}

function createTableStickers($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS Stickers (
        sticker_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        selected BOOLEAN DEFAULT false,
        sticker_name VARCHAR(30) NOT NULL,
        sticker_path VARCHAR(250) NOT NULL DEFAULT '')";
    $conn->exec($sql);
}

function createTables($conn) {
    createTableUsers($conn);
    createTableImages($conn);
    createTableLikes($conn);
    createTableComments($conn);
    createTableStickers($conn);
}
?>