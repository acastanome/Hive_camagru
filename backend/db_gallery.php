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

//TODO check is photo in DB already. save photo to folder let path . name;
function addImgToTable($userId, $imgName, $imgPath) {
    $conn = connectPDODB();
    try {
        $sql = $conn->prepare("INSERT INTO Images (`user_id`, `img_name`, img_path)
        VALUES (?, ?, ?)");
        $result = $sql->execute([$userId, $imgName, $imgPath]);
        echo "Image added to table successfully";
        if ($result) {
            $sql = $conn->prepare("UPDATE `Users` SET `posts` = `posts`+1 WHERE (`user_id` = ?)");
            $sql->execute([$userId]);
            return $result;
        }
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
    }
}

?>