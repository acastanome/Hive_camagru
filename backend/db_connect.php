<?php //check with backend

function connectPDODB(){
    try {
        $conn = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "123456");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    return $conn;
}

    // $DB_NAME = "db_camagru";
    // $DB_DSN = "mysql:host=localhost";
    // $DB_USER = "root";//"username";
    // $DB_PASSWORD = "123456";//"password";
    // try {
    //     $conn = new PDO("$DB_DSN;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
    //     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // } catch(PDOException $e) {
    //     echo "Connection failed: " . $e->getMessage();
    // }
?>