<?php
require_once 'db_connect.php';

function getUserIdFromUsernameOrEmail($input) {
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
        $sql = $conn->prepare("SELECT `activation_code` FROM Users WHERE (`user_id` = ?)");
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

function sendResetEmail($uid) {
    $activationCode = getActivationCodeFromUserId($uid);

    $actual_link = "http://localhost:8080/camagru/frontend/reset_pass.php?reset_code=" . $activationCode;
    $toEmail = getEmailFromUserId($uid);
    $subject = "User Password Reset Email";
    $content = "Click this link: " . $actual_link . " to reset your password.";
    if(mail($toEmail, $subject, $content)) {
        return nl2br("An email has been sent to your account!\nTo reset your password click the link sent to: " . $toEmail);
    }
    else {
        return "Problem in password reset. Please try again!";
    }
}
?>