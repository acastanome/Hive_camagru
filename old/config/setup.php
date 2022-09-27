<?php
require_once 'database.php';
require_once 'backend/connect_PDO.php';
require_once 'backend/db_users.php';
require_once 'backend/db_images.php';
//setup.php     create/ recreate db schema using info from config/database.php

function createDB($conn, $DB_NAME){
    try {
        $conn->exec("CREATE DATABASE IF NOT EXISTS $DB_NAME");
        //echo "Database existed or it was created successfully<br>";
    } catch(PDOException $e) {
        echo "Creating database " . $DB_NAME ." failed: " . $e->getMessage();
    }
}
//close connection to database with
// function closePDO($conn){
//     $conn = null;
// }

date_default_timezone_set('Europe/Helsinki');
$conn = connectPDO($DB_DSN, $DB_USER, $DB_PASSWORD);
createDB($conn, $DB_NAME);
$conn = null;
$conn = connectPDODB($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_NAME);
createTableUsers($conn);
createTableImages($conn);
createTableStickers($conn);
$conn = null;

//$userid = 19;
$username = "testuser3";
// $email = "testemail3@gmail.com";
$psswd = "testpass2";
// if (isUserOrEmailInTable($conn, $username, $email) == 0){
//     addUserToTable($conn, $username, $email, 'testpass2');
// }
//  $imgname = "testimage3";
//  $userid = 1;
//  addImgToTable($conn, $userid, $imgname);
// deleteUserImagesFromTable($conn, $username);
// deleteUserFromTable($conn, $username);
// $newpss = "testuser444";
// $newUsername = "testuser8";
// $newemail = "testuser444@gmail.com";
// changePasswd($conn, $username, $newpss);
//changeEmail($conn, $username, $newemail);
// changeUsername($conn, $username, $newUsername);
// echo isValidUser($conn, $username, $psswd);
?>
