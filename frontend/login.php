<?php
require_once 'head.php';

if ($_SESSION['logged_user'] || $_SESSION['logged_user'] != "")
{
    header("Location: home.php");
}
?>

<body>
<?php require_once 'navbar.php'; ?>

    <h3>hehe</h3>
    <form name="loginForm" action="login.php" onsubmit="return validateForm()" method="POST" style="padding-top: 20%">
        Username: <input type="text" name="username" value=""/>
        <br /><br />
        Password: <input type="password" name="passwd" value=""/>
        <br />
        <input style="margin-top: 15px;" type="submit" name="submit" value="LOG IN"/>
        <br /><br />
        <a href="create.php" style="background-color:lightgrey; color: black; border: solid #9d969d 1px; border-radius: 2px;">Or create account here</a>
    </form>
    <h3>hehe where is my form</h3>
    
</body>

<?php require_once 'footer.php';?>