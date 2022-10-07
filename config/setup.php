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
$psswd = "testpass2!";

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

function isUserOrEmailTaken($conn, $username, $email) {
    // $conn = connectPDODB();
    try {
        $sql = $conn->prepare("SELECT * FROM Users WHERE (`user_name` = ?)");
        $sql->execute([$username]);
        $result = $sql->fetch();
        if ($result) {
            return $result[0];
        }
        $sql = $conn->prepare("SELECT * FROM Users WHERE (`email` = ?)");
        $sql->execute([$email]);
        $result = $sql->fetch();
        $conn = null;
        if ($result) {
            return $result[0];
        }
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
    }
}

//adds whatever info is passed, NO CHECKS here
function addUserToTable($conn, $username, $email, $psswd) {
    // $conn = connectPDODB();
    $psswd = password_hash($psswd, PASSWORD_BCRYPT);
    $code = $email.time();
    $activationCode = password_hash($code, PASSWORD_BCRYPT);
    try {
        $sql = $conn->prepare("INSERT INTO Users (`user_name`, `email`, psswd, activation_code)
        VALUES (?, ?, ?, ?)");
        $sql->execute([$username, $email, $psswd, $activationCode]);
        $conn = null;
        // echo "User added to Users successfully";
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
    }
}

if (isUserOrEmailTaken($conn, $username, $email) == 0){
    addUserToTable($conn, $username, $email, $psswd);
}
//TO HERE

$conn = null;

?>
