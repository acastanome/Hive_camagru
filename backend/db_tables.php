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
        return $result;//[0] would return userid but creates a warning with apache
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

//TODO check is photo in DB already. save photo to folder let path . name;
function addImgToTable($conn, $userid, $imgname) {
    try {
        $sql = $conn->prepare("INSERT INTO Images (userId, imgName)
        VALUES ('$userid', '$imgname')");
        $sql->execute();
        echo "Image added to table successfully";
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
}

//delete all images from a user. NO CHECKS, just looks for that users images and deletes them
function deleteUserImagesFromTable($conn, $username) {
    try {
        $sql = $conn->prepare("DELETE Images FROM (Images INNER JOIN Users ON Images.userId=Users.userId)
        WHERE userName='$username'");
        $sql->execute();
        echo "If there was any, user's images deleted from tables successfully";
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    return 1;
}

//looks for the passed in usernames photos, deletes them, and then deletes the user
//TODO delete that users comments&likes
function deleteUserFromTable($conn, $username) {
    $checkUserName = selectOneQualifier($conn, 'Users', 'userName', $username);
    if (!$checkUserName)
    {
        echo "That username doesn't exist";
        return 0;
    }
    echo "let's try to delete, since user exists";
    deleteUserImagesFromTable($conn, $username);
    try {
        $sql = $conn->prepare("DELETE Users FROM Users
        WHERE userName='$username'");
        $sql->execute();
        echo "User deleted from table successfully";
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    // try {
    //     $sql = $conn->prepare("DELETE Users, Images FROM (Images RIGHT JOIN Users ON Images.userId=Users.userId)
    //     WHERE userName='$username'");
    //     $sql->execute();
    //     echo "User user's images deleted from tables successfully";
    // } catch(PDOException $e) {
    //     echo $sql . "<br>" . $e->getMessage();
    // }
    return 1;
}
?>