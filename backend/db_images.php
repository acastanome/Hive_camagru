<?php

//TODO check is photo in DB already. save photo to folder let path . name;
function addImgToTable($conn, $userid, $imgname) {
    try {
        $sql = $conn->prepare("INSERT INTO Images (userId, imgName)
        VALUES (?, ?)");
        $sql->execute([$userid, $imgname]);
        echo "Image added to table successfully";
    } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
    }
}

?>