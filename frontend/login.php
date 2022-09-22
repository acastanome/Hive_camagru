<?php require_once 'head.php'; ?>

<body>
<?php
if (!isset($_SESSION['logged_user'])) {

    require_once 'navbar.php';?>
    
    <!-- <script
    function validateForm() {
        let name = document.forms["loginForm"]["username"].value;
        if (name = "") {
            alert("Username must be filled out");
            return false;
        }
    }>
    </script> -->

    <form name="loginForm" action="login.php" method="POST" style="padding-top: 20%">
        Username: <input type="text" name="f_username" autocomplete="username" required/>
        <br /><br />
        Password: <input type="password" name="f_passwd" value="" required/>
        <br />
        <input style="margin-top: 15px;" type="submit" name="submit" value="LOG IN"/>
        <br /><br />
        <a href="create.php" style="background-color:lightgrey; color: black; border: solid #9d969d 1px; border-radius: 2px;">Or create account here</a>
    </form>

    <?php //check with backend
    require_once '../backend/db_user.php';

    if (isset($_POST['f_username']) && isset($_POST['f_passwd'])) {
        if (isValidUser($_POST['f_username'], $_POST['f_passwd']))
        {
            $_SESSION['logged_user'] = $_POST['f_username'];
            // echo "log in successfull";
            header("Location: home.php");
        }
        else {
            echo "log in NOT successfull";
        }
    }
} else {
    header("Location: home.php");
}
?>
</body>

<?php require_once 'footer.php';?>