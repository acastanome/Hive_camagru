<?php
require_once 'database.php';
require_once 'create_tables.php';

function createDB($conn, $DB_NAME){
    try {
        $conn->exec("CREATE DATABASE IF NOT EXISTS $DB_NAME");
    } catch(PDOException $e) {
        echo "Creating database " . $DB_NAME ." failed: " . $e->getMessage();
    }
}

date_default_timezone_set('Europe/Helsinki');

//Connect to server and create database if necessary
try {
    $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
createDB($conn, $DB_NAME);
$conn = null;

//Connect to database and create tables if necessary
try {
    $conn = new PDO("$DB_DSN;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
createTables($conn);

$conn = null;

?>
