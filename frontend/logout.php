<?php require_once 'head.php'; ?>

<body>
<?php
if (isset($_SESSION['logged_user'])) {
    session_destroy();
}
header("Location: home.php");
?>

<?php require_once 'footer.php';?>
</body>
</html>