<?php

function connectPDODB(){
    try {
        $conn = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "123456");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    return $conn;
}

?>