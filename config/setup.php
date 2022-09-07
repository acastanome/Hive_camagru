<?php
require_once 'database.php';
require_once 'backend/db_tables.php';
//setup.php     create/ recreate db schema using info from config/database.php

function connectPDO($DB_DSN, $DB_USER, $DB_PASSWORD){
    try {
        //if I want to create the db already in connection
        $conn = new PDO("mysql:host=$DB_DSN", $DB_USER, $DB_PASSWORD);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully<br>";
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    return $conn;
}
function connectPDODB($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_NAME){
    try {
        //if I want to create the db already in connection
        $conn = new PDO("mysql:host=$DB_DSN;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully<br>";
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    return $conn;
}
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

$conn = connectPDO($DB_DSN, $DB_USER, $DB_PASSWORD);
createDB($conn, $DB_NAME);
$conn = null;
$conn = connectPDODB($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_NAME);
createTableUsers($conn);
createTableImages($conn);
createTableStickers($conn);
addUserToTable($conn, 'testuser3', 'testemail3@gmail.com', 'testpass3');
?>
