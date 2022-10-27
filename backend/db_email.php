<?php

require_once 'db_connect.php';

function deleteUserSimple($email) {
    $conn = connectPDODB();
    try {
        $sql = $conn->prepare("DELETE LOW_PRIORITY FROM Users WHERE (`email` = ?)");
        $result = $sql->execute([$email]);
        // if ($result) {
        //     return $result;
        // }
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
    }
}

function sendActivationEmail($email, $activationCode) {
    $actual_link = "http://localhost:8080/camagru/frontend/activate.php?activation_code=" . $activationCode;
    $toEmail = $email;
    $subject = "User Registration Activation Email";
    $content = "Click this link: " . $actual_link . " to activate your account.";
    if(mail($toEmail, $subject, $content)) {
        return nl2br("Registration has been successfull!\nTo activate your account click the link sent to: " . $toEmail);
    }
    else {
        deleteUserSimple($email);
        return "Problem in registration. Please try again!";
    }
}

function getEmailFromId($id) {
    $conn = connectPDODB();
    try {
        $sql = $conn->prepare("SELECT `email` FROM Users WHERE (`user_id` = ?)");
        $sql->execute([$id]);
        $result = $sql->fetch();
        $conn = null;
        if ($result) {
            return $result[0];
        }
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
    }
}

function sendNotificationEmail($email) {
    $actual_link = "http://localhost:8080/camagru/frontend/home.php";
    $toEmail = $email;
    $subject = "New comment!";
    $content = "You have received a new comment! Check who, what, where: " . $actual_link . ".";
    if(mail($toEmail, $subject, $content)) {
        return true;
    }
    else {
        deleteUserSimple($email);
        return "Problem in notification email.";
    }
}

?>