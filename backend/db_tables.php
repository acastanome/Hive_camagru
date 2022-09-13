<?php
function createTableUsers($conn) {
    $sql = $conn->prepare("CREATE TABLE IF NOT EXISTS Users (
        userId INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        userName VARCHAR(30) NOT NULL,
        email VARCHAR(50) NOT NULL,
        confirmedAccount BOOLEAN DEFAULT false,
        psswd VARCHAR(128) NOT NULL,
        notifications BOOLEAN DEFAULT true)");
    $sql->execute();
}

function createTableImages($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS Images (
        imgId INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        userId INT UNSIGNED NOT NULL,
        imgName VARCHAR(30) NOT NULL,
        creationTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        likes INT UNSIGNED DEFAULT '0',
        comments INT UNSIGNED DEFAULT '0')";
    $conn->exec($sql);
}

function createTableStickers($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS Stickers (
        stickerId INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        selected BOOLEAN DEFAULT false,
        name VARCHAR(30) NOT NULL,
        path VARCHAR(250) NOT NULL DEFAULT '')";
    $conn->exec($sql);
}

//returns value (ex. in users table $result[0] is userid)if it finds the qualifier, nothing otherwise
function selectOneQualifier($conn, $table, $col, $qualifier) {
    try {
        $sql = $conn->prepare("SELECT * FROM `$table` WHERE $col = '$qualifier'");
        $sql->execute();
        $result = $sql->fetch();
        return $result[0];
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
        return false;
    }
}

//checks if the username or email are already in use
//returns 0 if not in use, 1 if username in use, 2 if email in use
//helpful for debugging: echo $checkUserName;
function isUserInTable($conn, $username, $email) {
    $checkUserName = selectOneQualifier($conn, 'Users', 'userName', $username);
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

//adds whatever info is passed, no checks here
function addUserToTable($conn, $username, $email, $psswd) {
    try {
        $sql = $conn->prepare("INSERT INTO Users (userName, email, psswd)
        VALUES ('$username', '$email', '$psswd')");
        $sql->execute();
        echo "User added to Users successfully";
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
}

//TODO check is photo in DB already
function addImgToTable($conn, $userid, $imgname) {
    $sql = "";
    try {
        $sql = "INSERT INTO Images (userId, imgName)
        VALUES ('$userid', '$imgname')";
        $conn->exec($sql);
        //        echo "Image added to Users successfully";
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
}

//TODO delete that users photos (comments&likes), then the user
// function deleteUserFromTable($conn, $username) {
    //     $sql = "";
    //     try {
        //         $sql = "SELECT * FROM (Images INNER JOIN Users ON Images.userId=Users.userId)
        //         WHERE userName='$username'";
        //         $conn->exec($sql);
        //         echo "User deleted from Users successfully";
        //       } catch(PDOException $e) {
            //         echo $sql . "<br>" . $e->getMessage();
            //       }
            // }
?>