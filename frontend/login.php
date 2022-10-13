<?php require_once 'head.php'; ?>

<body>
<?php
if (!isset($_SESSION['logged_user'])) {
    require_once 'navbar.php';?>
    <script type="text/javascript" src="js/js_user.js" charset="utf-8"></script>

    <form name="loginForm" action="login.php" onsubmit="return validateLoginForm(event)" method="POST" style="padding-top: 20%">
        Username: <input type="text" name="f_username" required/>
        <br /><br />
        Password: <input type="password" name="f_passwd" value="" required/>
        <br />
        <input style="margin-top: 15px;" type="submit" name="submit" value="LOG IN"/>
        <br /><br />
        <a href="create_account.php" style="background-color:lightgrey; color: black; border: solid #9d969d 1px; border-radius: 2px;">Create account here</a>
        <br /><br />
        <a href="reset_pass.php" style="background-color:lightgrey; color: black; border: solid #9d969d 1px; border-radius: 2px;">Reset password</a>
    </form>

    <?php
    require_once '../backend/db_user.php';

    if (isset($_POST['submit'])) {
        $validInput = checkLoginInput($_POST['f_username'], $_POST['f_passwd']);
        if ($validInput !== true) {
            echo $validInput;
        }
        else {
            $validUser = isValidUser($_POST['f_username'], $_POST['f_passwd']);
            if ($validUser === true)
            {
                $_SESSION['logged_user'] = $_POST['f_username'];
                header("Location: home.php");
            }
            else {
                echo $validUser;
            }
        }
    }
} else {
    header("Location: home.php");
}
?>
</body>

<?php require_once 'footer.php';?>