<?php //check with backend

require_once 'db_connect.php';

function checkLoginInput($username, $psswd) {
    if (strlen($username) < 1 || strlen($username) > 30 || !preg_match('/^[a-zA-Z0-9_]{1,30}$/', $username) || strlen($psswd) < 8 || strlen($psswd) > 30 || !preg_match('/^(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-zA-Z])[a-zA-Z0-9!@#$%^&*]{8,30}$/', $psswd)) {
      return "Invalid input, you trickster!";
    }
    return true;
}
function checkCreateAccountInput($username, $psswd, $email) {
    //check username
    if (strlen($username) < 1 || strlen($username) > 30) {
      return "Username must be 1 to 30 characters long, you trickster!";
    }
    if (!preg_match('/^[a-zA-Z0-9_]{1,30}$/', $username)) {
      return "Username can only contain letters, numbers and the special character _ you trickster!";
    }
    //check password
    if (strlen($psswd) < 8 || strlen($psswd) > 30) {
      return "Password must be 8 to 30 characters long, you trickster!";
    }
    if (!preg_match('/^(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-zA-Z])[a-zA-Z0-9!@#$%^&*]{8,30}$/', $psswd)) {
      return "Password can only contain letters, numbers and special characters !@#$%^&* (at least one of each), you trickster!";
    }
    //check email
    if (strlen($email) < 3 || strlen($email) > 50) {
        return "Email must be 3 to 50 characters long, you trickster!";
    }
    if (!preg_match('/^(?=.*[@])[a-zA-Z0-9!#$%&`*+-\/=?^_\'.{|}~@]{3,50}$/',$email)) {
      return "Email can only contain letters, numbers and special characters !@#$%^&* (atleast one of each), you trickster!";
    }
    return true;
}

function isValidUser($username, $psswd) {
    $conn = connectPDODB();
    try {
        $sql = $conn->prepare("SELECT * FROM Users WHERE (`user_name` = ?)");
        $sql->execute([$username]);
        $result = $sql->fetch();
        //echo "<script>console.log('Debug Objects: " . $result['psswd'] . "' );</script>";
        $conn = null;
        if ($result && password_verify($psswd, $result['psswd'])) {
            return $result[0];
        }
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
    }
}

function isUserOrEmailTaken($username, $email) {
    $conn = connectPDODB();
    try {
        $sql = $conn->prepare("SELECT * FROM Users WHERE (`user_name` = ?)");
        $sql->execute([$username]);
        $result = $sql->fetch();
        if ($result) {
            return $result[0];
        }
        $sql = $conn->prepare("SELECT * FROM Users WHERE (`email` = ?)");
        $sql->execute([$email]);
        $result = $sql->fetch();
        $conn = null;
        if ($result) {
            return $result[0];
        }
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
    }
}

//adds whatever info is passed, NO CHECKS here
function addUserToTable($username, $email, $psswd) {
    $conn = connectPDODB();
    $psswd = password_hash($psswd, PASSWORD_BCRYPT);
    $code = $email.time();
    $activationCode = password_hash($code, PASSWORD_BCRYPT);
    try {
        $sql = $conn->prepare("INSERT INTO Users (`user_name`, `email`, psswd, activation_code)
        VALUES (?, ?, ?, ?)");
        $sql->execute([$username, $email, $psswd, $activationCode]);
        $conn = null;
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
    }
}
?>