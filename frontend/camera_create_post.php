<?php require_once 'head.php'; ?>

<?php
if (isset($_SESSION['logged_user']) && isset($_SESSION['logged_id'])) {

    require_once '../backend/db_user.php';
    require_once '../backend/db_gallery.php';
    if (isset($_POST['post_photo']) && !empty($_POST['webcam_file']) && !empty($_POST['stickers_file'])) {
        $webcam_file = $_POST['webcam_file'];
        $stickers_file = $_POST['stickers_file'];
        $image_name = strval(time()) . ".jpg";

	    list($type, $url_webcam) = explode(';', $webcam_file);
	    list(, $url_webcam) = explode(',', $url_webcam); 
	    $cam = imagecreatefromstring(base64_decode($url_webcam));

	    list($type, $url_stickers) = explode(';', $stickers_file);
	    list(, $url_stickers) = explode(',', $url_stickers); 
	    $stickers = imagecreatefromstring(base64_decode($url_stickers));

        if ($cam && $stickers) {
            imagecopy($cam, $stickers, 0, 0, 0, 0, 700, 500);
            imagepng($cam, "../images/".$image_name);
            $path = "http://localhost:8080/camagru/images/". $image_name;
            addImgToTable($_SESSION['logged_id'], $image_name, $path);
        }
        else {
             ?>
             <script type="text/javascript">
                 console.log("Base64 value isn't a valid image.");
             </script>
             <?php
        }
    }

    // if (isset($_POST['post_photo']) && isset($_FILES['file']['name']) && !empty($_FILES['file']['name'])) {
    //     // upload_form['file'].files[0];
    //     echo "whaaaaat" . $_FILES['file']['name'] . "full path:" . $_FILES['file']['full_path'] . "tmp_name:" . $_FILES['file']['tmp_name'];
    //     // print_r(array_keys( $_FILES['file']));
    //     //name [1] => full_path [2] => type [3] => tmp_name [4] => error [5] => size
    // }
} else {
    header("Location: login.php");
}
?>
