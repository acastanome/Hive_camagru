<?php
require_once 'db_connect.php';

function getUserIdFromUsernameOrEmail($input) {
    // if (preg_match('/^(?=.*[@])$/',$input)) {
        $conn = connectPDODB();
        try {
            $sql = $conn->prepare("SELECT `user_id` FROM Users WHERE (`user_name` = ? OR `email` = ?)");
            $sql->execute([$input, $input]);
            $result = $sql->fetch();
            if ($result) {
                return $result[0];
            }
        } catch(PDOException $e) {
            echo "<br>" . $e->getMessage();
        }
    // }
    // return true;
}

function getEmailFromUserId($uid) {
    $conn = connectPDODB();
    try {
        $sql = $conn->prepare("SELECT `email` FROM Users WHERE (`user_id` = ?)");
        $sql->execute([$uid]);
        $result = $sql->fetch();
        $conn = null;
        if ($result) {
            return $result[0];
        }
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
    }
}

function getActivationCodeFromUserId($uid) {
    $conn = connectPDODB();
    try {
        // echo "PROBLEM 1";
        $sql = $conn->prepare("SELECT `activation_code` FROM Users WHERE (`user_id` = ?)");
        $sql->execute([$uid]);
        $result = $sql->fetch();
        $conn = null;
        if ($result) {
            // echo "PROBLEM 2 $result";
            return $result[0];
        }
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
    }
}

function sendResetEmail($uid) {
    // getEmailFromUserId($uid);
    $activationCode = getActivationCodeFromUserId($uid);
    // echo "PROBLEM $activationCode";

    $actual_link = "http://localhost:8080/camagru_git/frontend/reset_pass.php?reset_code=" . $activationCode;
    $toEmail = getEmailFromUserId($uid);
    $subject = "User Password Reset Email";
    $content = "Click this link: " . $actual_link . " to reset your password.";
    if(mail($toEmail, $subject, $content)) {
        return nl2br("An email has been sent to your account!\nTo reset your password click the link sent to: " . $toEmail);
    }
    else {
        return "Problem in password reset. Please try again!";
    }
    // unset($_POST);
}
?>