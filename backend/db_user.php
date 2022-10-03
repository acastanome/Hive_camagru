<?php //check with backend

require_once 'db_connect.php';

function isValidUser($username, $psswd) {
    // $DB_NAME = "db_camagru";
    // $DB_DSN = "mysql:host=localhost";
    // $DB_USER = "root";//"username";
    // $DB_PASSWORD = "123456";//"password";
    // // $conn = connectPDODB();
    // try {
    //     $conn = new PDO("$DB_DSN;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
    //     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // } catch(PDOException $e) {
    //     echo "Connection failed: " . $e->getMessage();
    // }
    $conn = connectPDODB();
        try {
        $sql = $conn->prepare("SELECT * FROM Users WHERE (`user_name` = ? AND `psswd` = ?)");
        $sql->execute([$username, $psswd]);
        $result = $sql->fetch();
        $conn = null;
        if ($result)
        return $result[0];
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
    }
}

function isUserOrEmailTaken($username, $email) {
    // $DB_NAME = "db_camagru";
    // $DB_DSN = "mysql:host=localhost";
    // $DB_USER = "root";//"username";
    // $DB_PASSWORD = "123456";//"password";
    // // $conn = connectPDODB();
    // try {
    //     $conn = new PDO("$DB_DSN;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
    //     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // } catch(PDOException $e) {
    //     echo "Connection failed: " . $e->getMessage();
    // }
    $conn = connectPDODB();
    try {
        $sql = $conn->prepare("SELECT * FROM Users WHERE (`user_name` = ?)");
        $sql->execute([$username]);
        $result = $sql->fetch();
        //$conn = null;
        if ($result) {
            echo "That username is already in table";
            return $result[0];
        }
        $sql = $conn->prepare("SELECT * FROM Users WHERE (`email` = ?)");
        $sql->execute([$email]);
        $result = $sql->fetch();
        $conn = null;
        if ($result) {
            echo "That email is already in table";
            return $result[0];
        }
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
    }
}

//adds whatever info is passed, NO CHECKS here
function addUserToTable($username, $email, $psswd) {
    $conn = connectPDODB();
    $code = $email.time();
    $activationCode = hash('whirlpool', $code);
    try {
        $sql = $conn->prepare("INSERT INTO Users (`user_name`, `email`, psswd, activation_code)
        VALUES (?, ?, ?, ?)");
        $sql->execute([$username, $email, $psswd, $activationCode]);
        $conn = null;
        echo "User added to Users successfully";
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
    }
}
?>