<?php

require_once 'db_connect.php';

function sendActivationEmail($email, $activationCode) {
    // $actual_link = "http://localhost:8080/frontend/activate.php?user_id=" . $user_id;
    $actual_link = "http://localhost:8080/camagru_git/frontend/activate.php?activation_code=" . $activationCode;
    $toEmail = $email;
    $subject = "User Registration Activation Email";
    $content = "Click this link: " . $actual_link . " to activate your account.";
    // $mailHeaders = "From: Camagru Admin\r\n";
    // if(mail($toEmail, $subject, $content, $mailHeaders)) {
    if(mail($toEmail, $subject, $content)) {
        // $message = "You have registered and the activation mail is sent to your email. Click the activationlink to activate you account.";
        return nl2br("Registration has been successfull!\nTo activate your account click the link sent to: " . $toEmail);
    }
    else {
        return "Problem in registration. Please try again!";
    }
    // unset($_POST);
}

?>