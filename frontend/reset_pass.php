<?php require_once 'head.php'; ?>

<body>
<?php
require_once 'navbar.php'; ?>

<div class="bodyContainer">
    <?php
if (!empty($_GET["reset_code"])) {
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
} else {
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
if (isset($_POST['submit']) && isset($_POST['f_input'])) {
    $input = htmlspecialchars($_POST['f_input']);
    $uid = getUserIdFromUsernameOrEmail($input);
    if (!$uid) {
        echo "Problem in password reset.";
    }
    else {
        echo sendResetEmail($uid);
    }
} else {
    if (isset($_POST['submit']) && isset($_POST['f_code'])) {
        $code = htmlspecialchars($_POST['f_code']);
        $newpass = password_hash(htmlspecialchars($_POST['f_newpass']), PASSWORD_BCRYPT);
        require_once '../backend/db_user.php';
        $conn = connectPDODB();
        try {
            $sql = $conn->prepare("UPDATE `Users` SET `psswd` = ? WHERE (`activation_code` = ?)");
            $sql->execute([$newpass, $code]);
            $result = $sql->rowCount();
            if(!empty($result)) {
                $newCode = bin2hex(random_bytes(10));
                $sql = $conn->prepare("UPDATE `Users` SET `activation_code` = ? WHERE (`activation_code` = ?)");
                $sql->execute([$newCode, $code]);
                echo "Your password has been reset!";
            } else {
                echo "Problem in password reset. Please try again";
            }
        } catch(PDOException $e) {
            echo "<br>" . $e->getMessage();
        }
    }
}
?>
</div>
<?php require_once 'footer.php';?>
</body>
</html>