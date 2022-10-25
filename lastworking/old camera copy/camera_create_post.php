<?php require_once 'head.php'; ?>

<?php
if (isset($_SESSION['logged_user']) && isset($_SESSION['logged_id'])) {

    require_once '../backend/db_user.php';
    require_once '../backend/db_gallery.php';
    if (isset($_POST['post_photo']) && !empty($_POST['webcam_file']) && !empty($_POST['stickers_file'])) {
        echo "in camera upl";
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
    } else if (isset($_POST['post_photo']) && !empty($_POST['myImg_file'])) {//upload
        echo "in file upload";
        $myImg_file = $_POST['myImg_file'];
        $image_name = strval(time()) . ".jpg";
        
	    list($type, $url_myIng) = explode(';', $myImg_file);
	    list(, $url_myIng) = explode(',', $url_myIng); 
	    $upload = imagecreatefromstring(base64_decode($url_myIng));
        
        if (!empty($_POST['stickers_file'])) {
            $stickers_file = $_POST['stickers_file'];
            list($type, $url_stickers) = explode(';', $stickers_file);
            list(, $url_stickers) = explode(',', $url_stickers); 
            $stickers = imagecreatefromstring(base64_decode($url_stickers));
        }
        
        if ($upload && $stickers) {
            imagecopy($upload, $stickers, 0, 0, 0, 0, 700, 500);
            imagepng($upload, "../images/".$image_name);
            $path = "http://localhost:8080/camagru/images/". $image_name;
            addImgToTable($_SESSION['logged_id'], $image_name, $path);
        }
        else if ($upload) {
            imagepng($upload, "../images/".$image_name);
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
    // header("Location: camera.php");
    } else {
        echo "in end else";
        // header("Location: login.php");
        // header("Location: test.php");
        if (isset($_POST['post_photo'])) {
            echo "post_photo:    ";
            echo $_POST['post_photo'];
        }
        if(!empty($_POST['webcam_file'])) {
            echo "  webcam_file:   ";
            echo $_POST['webcam_file'];
        }
        if (!empty($_POST['stickers_file'])) {
            echo "  stickers_file: ";
            echo $_POST['stickers_file'];
        }
        if (!empty($_POST['myImg'])) {
            echo "  myImg: ";
            echo $_POST['myImg'];
        }
    }
}
?>
