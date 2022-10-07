<?php require_once 'head.php'; ?>

<body>
<?php
if (isset($_SESSION['logged_user'])) {

    require_once 'navbar.php';?>
    <script type="text/javascript" src="js/js_user.js" charset="utf-8"></script>

    <form name="loginForm" action="login.php" onsubmit="return validateForm()" method="POST" style="padding-top: 20%">
        Username: <input type="text" name="f_username" autocomplete="username" required/>
        <br /><br />
        Password: <input type="password" name="f_passwd" value="" required/>
        <br />
        <input style="margin-top: 15px;" type="submit" name="submit" value="LOG IN"/>
    </form>

    <?php //check with backend
    require_once '../backend/db_user.php';

    if (isset($_POST['submit'])) {
        // $uId = $_POST['f_username'];
        // $pId = $_POST['f_passwd'];
        
        if (isValidUser($_POST['f_username'], $_POST['f_passwd']))
        {
            $_SESSION['logged_user'] = $_POST['f_username'];
            header("Location: home.php");
        }
        else {//if (!isset($_POST['submit']))
            echo "log in NOT successfull";
        }
    }

} else {
    header("Location: home.php");
}
?>
</body>

<?php require_once 'footer.php';?>