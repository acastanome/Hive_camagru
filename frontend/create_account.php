<?php require_once 'head.php'; ?>

<body>
<?php
if (!isset($_SESSION['logged_user'])) {
    require_once 'navbar.php';?>
    <div class="fuckingfuck">
    <script type="text/javascript" src="js/js_user.js" charset="utf-8"></script>

    <form name="createForm" action="create_account.php" onsubmit="return validateCreateForm(event)" method="POST" style="padding-top: 20%">
        <input type="text" name="f_username" placeholder="Username" required/>
        <br /><br />
        <input type="email" name="f_email" placeholder="Email" required/>
        <br /><br />
        <input type="password" name="f_passwd" value="" placeholder="Password" required/>
        <br />
        <input style="margin-top: 15px;" type="submit" name="submit" value="CREATE USER"/>
        <br /><br />
        <a href="login.php" style="background-color:lightgrey; color: black; border: solid #9d969d 1px; border-radius: 2px;">Or click here to log in</a>
    </form>

    <?php //check with backend
    require_once '../backend/db_user.php';
    require_once '../backend/db_email.php';
    if (isset($_POST['submit'])) {
        $validInput = checkCreateAccountInput($_POST['f_username'], $_POST['f_passwd'], $_POST['f_email']);
        if ($validInput !== true) {
            echo $validInput;
        }
        else {
            echo createAccount($_POST['f_username'], $_POST['f_email'], $_POST['f_passwd']);
        }
    } ?>
    </div>
    <?php
} else {
    header("Location: home.php");
}
?>

<?php require_once 'footer.php';?>
</body>
</html>