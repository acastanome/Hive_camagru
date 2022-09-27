<?php
//session_destroy();
// require_once '../config/database.php';
// require_once '../backend/connect_PDO.php';
include 'header.php';
include_once '../backend/db_users.php';
?>

<script
function validateForm() {
    let name = document.forms["loginForm"]["name"].value;
    if (name = "") {
        alert("Name must be filled out");
        return false;
    }
}>
</script>

<?php
if (!$_SESSION['logged_user'] || $_SESSION['logged_user'] === "")
{
    ?>
    <form name="loginForm" action="login.php" onsubmit="return validateForm()" method="POST" style="padding-top: 20%">
        Username: <input type="text" name="username" value=""/>
        <br /><br />
        Password: <input type="password" name="passwd" value=""/>
        <br />
        <input style="margin-top: 15px;" type="submit" name="submit" value="LOG IN"/>
        <br /><br />
        <a href="create.php" style="background-color:lightgrey; color: black; border: solid #9d969d 1px; border-radius: 2px;">Or create account here</a>
    </form>
    <?php
	if (isValidUser($_POST['username'], $_POST['passwd']) > 0)
	{
		$_SESSION['logged_user'] = $_POST['username'];
		header("Location: index.php");
	}
	else
	{
		$_SESSION['logged_user'] = "";
        echo "empty or invalid user";
		// header("Location: login.php");
	}
}
    ?>

<?php
// header("Location: frontend/login.php");
include 'footer.php';
?>