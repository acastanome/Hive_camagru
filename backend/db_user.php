<?php //check with backend

function isValidUser($username, $psswd) {
    $DB_NAME = "db_camagru";
    $DB_DSN = "mysql:host=localhost";
    $DB_USER = "root";//"username";
    $DB_PASSWORD = "123456";//"password";
    // $conn = connectPDODB();
    try {
        $conn = new PDO("$DB_DSN;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    try {
        $sql = $conn->prepare("SELECT * FROM Users WHERE (`user_name` = ? AND `psswd` = ?)");
        $sql->execute([$username, $psswd]);
        $result = $sql->fetch();
        $conn = null;
        if ($result)
        return $result[0];
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
    }
}

?>