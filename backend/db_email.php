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

?>