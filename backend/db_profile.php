<?php
require_once 'db_connect.php';

function checkUsername($username) {
    if (strlen($username) < 1 || strlen($username) > 30) {
      return "Username must be 1 to 30 characters long, you trickster!";
    }
    if (!preg_match('/^[a-zA-Z0-9_]{1,30}$/', $username)) {
      return "Username can only contain letters, numbers and the special character _ you trickster!";
    }
    return true;
}
function checkPsswd($psswd) {
    if (strlen($psswd) < 8 || strlen($psswd) > 30) {
      return "Password must be 8 to 30 characters long, you trickster!";
    }
    if (!preg_match('/^(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-zA-Z])[a-zA-Z0-9!@#$%^&*]{8,30}$/', $psswd)) {
      return "Password can only contain letters, numbers and special characters !@#$%^&* (at least one of each), you trickster!";
    }
    return true;
}
function checkEmail($email) {
    if (strlen($email) < 3 || strlen($email) > 50) {
        return "Email must be 3 to 50 characters long, you trickster!";
    }
    if (!preg_match('/^(?=.*[@])[a-zA-Z0-9!#$%&`*+-\/=?^_\'.{|}~@]{3,50}$/',$email)) {
      return "Email can only contain letters, numbers and special characters !@#$%^&* (atleast one of each), you trickster!";
    }
    return true;
}
function isUsernameTaken($username) {
    $conn = connectPDODB();
    try {
        $sql = $conn->prepare("SELECT * FROM Users WHERE (`user_name` = ?)");
        $sql->execute([$username]);
        $result = $sql->fetch();
        $conn = null;
        if ($result) {
            return $result[0];
        }
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
    }
}
function isEmailTaken($email) {
    $conn = connectPDODB();
    try {
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

function updateNotifications($username, $value) {
    $conn = connectPDODB();
    try {
        $sql = $conn->prepare("UPDATE `Users` SET `notifications` = ? WHERE `user_name` = ?");
        $sql->execute([$value, $username]);
        echo "Notifications have been updated".PHP_EOL;
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
    }
}

function changePasswd($username, $newPsswd) {
    $conn = connectPDODB();
    try {
        $newPsswd = password_hash(htmlspecialchars($newPsswd), PASSWORD_BCRYPT);
        $sql = $conn->prepare("UPDATE `Users` SET `psswd` = ? WHERE `user_name` = ?");
        $sql->execute([$newPsswd, $username]);
        if(!empty($result)) {
            echo "Your password has been reset!".PHP_EOL;
        } else {
            echo "Problem in password reset.".PHP_EOL;
        }
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
    }
}

function changeEmail($username, $newEmail) {
    $conn = connectPDODB();
    try {
        $sql = $conn->prepare("UPDATE `Users` SET `email` = ? WHERE `user_name` = ?");
        $sql->execute([$newEmail, $username]);
        echo "Email updated in table successfully".PHP_EOL;
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
    }
}

function changeUsername($username, $newUsername) {
    $conn = connectPDODB();
    try {
        $sql = $conn->prepare("UPDATE `Users` SET `user_name` = ? WHERE `user_name` = ?");
        $sql->execute([$newUsername, $username]);
        echo "Username updated in table successfully".PHP_EOL;
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
    }
}
?>