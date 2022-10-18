<?php require_once 'head.php'; ?>

<body>
<?php
if (isset($_SESSION['logged_user'])) {
    require_once 'navbar.php';?>
    <button id="start-camera">Start Camera</button>
    <video id="video" width="320" height="240" autoplay></video>
    <button id="click-photo">Click Photo</button>
    <canvas id="canvas" width="320" height="240"></canvas>

    <script>
    let camera_button = document.querySelector("#start-camera");
    let video = document.querySelector("#video");
    let click_button = document.querySelector("#click-photo");
    let canvas = document.querySelector("#canvas");

    camera_button.addEventListener('click', async function() {
       	let stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
    	video.srcObject = stream;
    });

    click_button.addEventListener('click', function() {
       	canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
       	let image_data_url = canvas.toDataURL('image/jpeg');

       	// data url of the image
       	console.log(image_data_url);
    });
    </script>
    
    <?php //check with backend
} else {
    header("Location: home.php");
}
?>
</body>

<?php require_once 'footer.php';?>