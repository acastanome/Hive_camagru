<?php //check with backend

require_once 'db_connect.php';

function sendActivationEmail($user_id) {
    // if(!empty($user_id)) {
        // $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."activate.php?id=" . $user_id;
        $actual_link = "http://localhost:8080/frontend/activate.php?user_id=" . $user_id;
        $toEmail = $_POST["f_email"];
        $subject = "User Registration Activation Email";
        $token = bin2hex(random_bytes(10));
        // $content = "Click this link to activate your account. <a href='" . $actual_link . "'>" . $actual_link . "</a>";
        // $content = "Click this link to activate your account. " . $actual_link;
        $content = "Click this link $token to activate your account. " . $actual_link;
        // $mailHeaders = "From: Camagru Admin\r\n";
        // if(mail($toEmail, $subject, $content, $mailHeaders)) {
        if(mail($toEmail, $subject, $content)) {
            // $message = "You have registered and the activation mail is sent to your email. Click the activation link to activate you account.";	
            // $type = "success";
            return "You have registered and the activation mail is sent to your email: " . $toEmail . ". Click the activation link to activate you account.";	
            // $type = "success";
        }
        else {
            return "didn't work";
        }
        // unset($_POST);
        // return "random";
    // } else {
    //     $message = "Problem in registration. Try Again!";	
    // }
}

?>