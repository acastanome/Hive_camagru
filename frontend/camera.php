<?php require_once 'head.php';
require_once 'navbar.php';?>
	<link rel="stylesheet" href="css/cam.css">
<body>
<?php
if (isset($_SESSION['logged_user'])) {?>
	<div class="container">
		<div class="col-9">
		<h4>Select a sticker<br>or</h4>
		<button id="upload-photo">Upload a Photo</button>
			<div class="card">
					<div class="sticker-circle">
						<div class="circle">
							<img class="sticker" id="sticker1" src="http://localhost:8080/camagru/stickers/turtle.png" alt="turtle.png">
						</div>
					</div>
					<div class="sticker-circle">
						<div class="circle">
							<img class="sticker" id="sticker2" src="http://localhost:8080/camagru/stickers/flamingo.png" alt="flamingo.png">
						</div>
					</div>
					<div class="sticker-circle">
						<div class="circle">
						<img class="sticker" id="sticker3" src="http://localhost:8080/camagru/stickers/cat-box.png" alt="cat-box.png">
						</div>
					</div>
					<div class="sticker-circle">
						<div class="circle">
							<img class="sticker" id="sticker4" src="http://localhost:8080/camagru/stickers/crocodile.png" alt="crocodile.png">
						</div>
					</div>
					<div class="sticker-circle">
						<div class="circle">
							<img class="sticker" id="sticker5" src="http://localhost:8080/camagru/stickers/fox.png" alt="fox.png">
						</div>
					</div>
					<div class="sticker-circle">
						<div class="circle">
							<img class="sticker" id="sticker6" src="http://localhost:8080/camagru/stickers/dog.png" alt="dog.png">
						</div>
					</div>
			</div>
			<div class="camera_container">
				<video id="video" width="320" height="240" autoplay></video>
				<br>
				<button id="capture-photo">Capture Photo</button>
				<br>
				<form class="camera_form" name="cameraPostForm" action="camera_create_post.php" method="POST" enctype='multipart/form-data'>
						<input type="hidden" name="webcam_file" id="webcam_file" value="">
						<input type="hidden" name="stickers_file" id="stickers_file" value="">
						<button type="submit" name="post_photo" id="post_photo">Post</button>
				</form>
				<canvas class="canvas" id="canvas" width="320" height="240"></canvas>
				<canvas class="canvas" id="canvas_stickers" width="320" height="240"></canvas>
			</div>
		</div>
		<div class="col-3">
			<h4>Pic previews</h4>
			<div class="card">
				<div class="sticker-circle">
					<div class="circle">
						<img src=
"http://localhost:8080/camagru/images/img0.jpg" alt="img0">
					</div>
				</div>
			</div>
			<div class="card">
				<div class="sticker-circle">
					<div class="circle">
						<img src=
"http://localhost:8080/camagru/images/img0.jpg" alt="cat-box.png">
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="js/js_camera.js" charset="utf-8"></script>

<?php
} else {
	header("Location: login.php");
}
?>
</body>

<?php require_once 'footer.php';?>