<?php

//TODO check is photo in DB already. save photo to folder let path . name;
function addImgToTable($conn, $userId, $imgName, $imgPath) {
    try {
        $sql = $conn->prepare("INSERT INTO Images (`user_id`, `img_name`, img_path)
        VALUES (?, ?)");
        $sql->execute([$userId, $imgName, $imgPath]);
        echo "Image added to table successfully";
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
    }
}

?>