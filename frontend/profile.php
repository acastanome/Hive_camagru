<?php require_once 'head.php'; ?>

<body>
<?php
if (isset($_SESSION['logged_user'])) {
    require_once 'navbar.php';?>
    <div class="bodyContainer">
    <form name="modifyForm" action="profile.php" method="POST" style="padding-top: 20%">
        <input type="text" name="f_username" placeholder="New username" value=""/>
        <br /><br />
        <input type="email" name="f_email" placeholder="New email" value=""/>
        <br /><br />
        <input type="password" name="f_passwd" placeholder="New Password" value=""/>
        <br /><br />
        Notifications: <input type="checkbox" name="f_notifications" id="f_notifications" value="1" checked/>
        <br /><br />
        <input style="margin-top: 15px;" type="submit" name="submit" value="Apply modifications"/>
    </form>

    <?php
    require_once '../backend/db_user.php';
    require_once '../backend/db_profile.php';
    if (isset($_POST['submit'])) {
        $username = $_SESSION['logged_user'];
        if (isset($_POST['f_notifications'])) {
            updateNotifications($username, "1");
        } else {
            updateNotifications($username, "0");
        }
        if (isset($_POST['f_email']) && !empty($_POST['f_email'])) {
            $validInput = checkEmail($_POST['f_email']);
            if ($validInput !== true) {
                echo $validInput;
            } else if (isEmailTaken($_POST['f_email'])) {
                echo "That email isn't valid.";
            } else {
                changeEmail($username, $_POST['f_email']);
            }
        }
        if (isset($_POST['f_passwd']) && !empty($_POST['f_passwd'])) {
            $validInput = checkPsswd($_POST['f_passwd']);
            if ($validInput !== true) {
                echo $validInput;
            } else {
                changePasswd($username, $_POST['f_passwd']);
            }
        }
        if (isset($_POST['f_username']) && !empty($_POST['f_username'])) {
            $validInput = checkUsername($_POST['f_username']);
            if ($validInput !== true) {
                echo $validInput;
            } else if (isUsernameTaken($_POST['f_username'])) {
                echo "That username is already taken.";
            } else {
                changeUsername($username, $_POST['f_username']);
                $_SESSION['logged_user'] = $_POST['f_username'];
            }
        }
    }
} else {
    header("Location: login.php");
}
?>
</div>
<?php require_once 'footer.php';?>
</body>
</html>