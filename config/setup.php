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

//TEST PURPOSES ONLY FROM HERE
$username = "testuser2";
$email = "testemail2@gmail.com";
$psswd = "testpass2";

function selectOneQualifier($conn, $table, $col, $qualifier) {
    try {
        $sql = $conn->prepare("SELECT * FROM $table WHERE $col = ?");
        $sql->execute([$qualifier]);
        $result = $sql->fetch();
        return $result;//[0] would return userid but creates a warning with apache
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
        return false;
    }
}

function isUserOrEmailInTable($conn, $username, $email) {
    $checkUserName = selectOneQualifier($conn, 'Users', 'user_name', $username);
    if ($checkUserName > 0)
    {
        echo "That username is already in table";
        return 1;
    }
    $checkEmail = selectOneQualifier($conn, 'Users', 'email', $email);
    if ($checkEmail > 0)
    {
         echo "That email is already in table";
         return 2;
    }
    return 0;
}

function addUserToTable($conn, $username, $email, $psswd) {
    $code = $email.time();
    $activationCode = hash('whirlpool', $code);
    try {
        $sql = $conn->prepare("INSERT INTO Users (`user_name`, `email`, psswd, activation_code)
        VALUES (?, ?, ?, ?)");
        $sql->execute([$username, $email, $psswd, $activationCode]);
        echo "User added to Users successfully";
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
    }
}

if (isUserOrEmailInTable($conn, $username, $email) == 0){
    addUserToTable($conn, $username, $email, $psswd);
}
//TO HERE

$conn = null;

?>
