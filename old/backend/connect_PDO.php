<?php
require_once '../config/database.php';

function connectPDO(){
    global $DB_DSN, $DB_USER, $DB_PASSWORD;
    try {
        $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    return $conn;
}

function connectPDODB(){
    global $DB_DSN, $DB_USER, $DB_PASSWORD, $DB_NAME;
    try {
        $conn = new PDO("$DB_DSN;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    return $conn;
}

//$conn = connectPDODB($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_NAME);
?>
