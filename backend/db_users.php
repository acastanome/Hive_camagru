<?php

//checks if the username or email are already in use
//returns 0 if not in use, 1 if username in use, 2 if email in use
//helpful for debugging: echo $checkUserName;
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

//adds whatever info is passed, NO CHECKS here
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

//delete all images from a user. NO CHECKS, just looks for that users images and deletes them
function deleteUserImagesFromTable($conn, $username) {
    try {
        $sql = $conn->prepare("DELETE Images FROM (Images INNER JOIN Users ON Images.user_id=Users.user_id)
        WHERE `user_name`=?");
        $sql->execute([$username]);
        echo "If there was any, user's images deleted from tables successfully";
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
    }
    return 1;
}

//looks for the passed in usernames photos, deletes them, and then deletes the user
//TODO delete that users comments&likes
function deleteUserFromTable($conn, $username) {
    $checkUserName = selectOneQualifier($conn, 'Users', `user_name`, $username);
    if (!$checkUserName)
    {
        echo "That username doesn't exist";
        return 0;
    }
    echo "let's try to delete, since user exists";
    deleteUserImagesFromTable($conn, $username);
    try {
        $sql = $conn->prepare("DELETE Users FROM Users
        WHERE `user_name`=?");
        $sql->execute([$username]);
        echo "User deleted from table successfully";
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
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

//NO CHECKS updates passed in usernames password to the one provided
function changePasswd($conn, $username, $newPsswd) {
    try {
        $sql = $conn->prepare("UPDATE `Users` SET `psswd` = ? WHERE `user_name` = ?");
        $sql->execute([$newPsswd, $username]);
        echo "Passwd updated in table successfully";
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
    }
}

//NO CHECKS updates passed in usernames email to the one provided
function changeEmail($conn, $username, $newEmail) {
    try {
        $sql = $conn->prepare("UPDATE `Users` SET `email` = ? WHERE `user_name` = ?");
        $sql->execute([$newEmail, $username]);
        echo "Email updated in table successfully";
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
    }
}

//NO CHECKS updates passed in username to the one provided
function changeUsername($conn, $username, $newUsername) {
    try {
        $sql = $conn->prepare("UPDATE `Users` SET `user_name` = ? WHERE `user_name` = ?");
        $sql->execute([$newUsername, $username]);
        echo "Username updated in table successfully";
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
    }
}

function activateAccount($conn, $activationCode) {
    try {
        $sql = $conn->prepare("UPDATE `Users` SET `confirmed_account` = '1' WHERE `activation_code` = ?");
        $sql->execute([$activationCode]);
        echo "Account activated in table successfully";
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
    }
}

//checks if the username and password are matching
//returns 0 if not valid, user_id if valid
function isValidUser($conn, $username, $psswd) {
    try {
        $sql = $conn->prepare("SELECT * FROM Users WHERE (`user_name` = ? AND `psswd` = ?)");
        $sql->execute([$username, $psswd]);
        $result = $sql->fetch();
        if ($result)
            return $result[0];
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
    }
}

//becrypt
?>