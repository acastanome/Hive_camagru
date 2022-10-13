<?php require_once 'head.php'; ?>

<body>
<?php
require_once 'navbar.php';

if (!empty($_GET["reset_code"])) {// echo "There is a reset_code";
    // $code = htmlspecialchars($_GET["reset_code"]);
?>
    <script type="text/javascript" src="js/js_user.js" charset="utf-8"></script>

    <form name="newPassForm" action="reset_pass.php" onsubmit="return validateNewPassForm(event)" method="POST" style="padding-top: 20%">
    Enter a new password:
    <br/><br/>
        <input type="password" name="f_newpass" value="" required/>
        <input type="hidden" name="f_code" value="<?php echo htmlspecialchars($_GET["reset_code"]);?>"/>
        <br />
        <input style="margin-top: 15px;" type="submit" name="submit" value="RESET"/>
    </form>

<?php
} else {//there is no reset_code
?>
    <script type="text/javascript" src="js/js_user.js" charset="utf-8"></script>

    <form name="resetPassForm" action="reset_pass.php" onsubmit="return validateResetPassForm(event)" method="POST" style="padding-top: 20%">
    Enter your username or email and we'll send you a link to reset your password:
    <br/><br/>
        <input type="text" name="f_input" required/>
        <br />
        <input style="margin-top: 15px;" type="submit" name="submit" value="Send Reset link"/>
    </form>

    <?php
}
require_once '../backend/db_reset.php';
if (isset($_POST['submit']) && isset($_POST['f_input'])) {//send email
    $input = htmlspecialchars($_POST['f_input']);
    $uid = getUserIdFromUsernameOrEmail($input);
    if (!$uid) {
        echo "Couldn't find a match with that input.";
    }
    else {
        echo sendResetEmail($uid);
    }
} else {//set newpass
    if (isset($_POST['submit']) && isset($_POST['f_code'])) {
        $code = htmlspecialchars($_POST['f_code']);
        $newpass = htmlspecialchars($_POST['f_newpass']);
        require_once '../backend/db_user.php';
        $conn = connectPDODB();
        try {
            $sql = $conn->prepare("UPDATE `Users` SET `psswd` = ? WHERE (`activation_code` = ?)");
            $sql->execute([$newpass, $code]);
            $result = $sql->rowCount();
            if(!empty($result)) {
                echo "Your password has been reset!";
            } else {
                echo "Problem in password reset.";
            }
        } catch(PDOException $e) {
            echo "<br>" . $e->getMessage();
        }
    }
}
?>
</body>

<?php require_once 'footer.php';?>