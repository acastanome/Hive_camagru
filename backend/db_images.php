<?php

//TODO check is photo in DB already. save photo to folder let path . name;
function addImgToTable($conn, $userid, $imgname) {
    try {
        $sql = $conn->prepare("INSERT INTO Images (userId, imgName)
        VALUES ('$userid', '$imgname')");
        $sql->execute();
        echo "Image added to table successfully";
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
}

?>