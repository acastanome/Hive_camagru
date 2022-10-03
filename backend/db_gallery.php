<?php //check with backend

require_once 'db_connect.php';

function getAllImages() {
    $conn = connectPDODB();
    try {
        $sql = $conn->prepare("SELECT * FROM `Images`");
        $sql->execute();
        $result = $sql->fetch();
        $conn = null;
        return $result;//[0] would return userid but creates a warning with apache
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
        return false;
    }
}
?>