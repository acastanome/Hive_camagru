<?php require_once 'head.php';?>
<body>
<?php require_once 'navbar.php';
require_once '../backend/db_gallery.php';
?>
	<link rel="stylesheet" href="css/cam.css">
<?php
if (isset($_SESSION['logged_user'])) {
	$images = fetch_imagesByUserId($_SESSION['logged_id']);?>
	<div class="container">
		<div class="col-9">
			<div>
				<h2 style="margin: 5px; color: rgb(43, 3, 69);">Create a Post</h2>
				<h4 style="margin: 5px;">42 logic dictates you can upload an image with or without 	stickers,	<br>but you can't capture a photo without stickers.</h4>
			</div>
			<div id="camera_buttons">
						<label for="imageInput" class="myBtns">Select file</label>
						<input type="file" id="imageInput" accept = "image/*" hidden style="max-width: 100%;">
						<button class="myBtns" id="capture-photo">Capture Photo</button>
					</div>
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
				<div>
					<form class="camera_form" name="cameraPostForm" action="camera_create_post.php" method="POST" enctype='multipart/form-data'>
						<input type="hidden" name="webcam_file" id="webcam_file" value="">
						<input type="hidden" name="uploading" id="uploading" value="">
						<input type="hidden" name="count" id="count" value="0">
						<input type="hidden" name="stickers_file" id="stickers_file" value="">
						<button class="myBtns" type="submit" name="post_photo" id="post_photo">Post</button>
					</form>
						<video id="video" width="320" height="240" autoplay></video>
					<div id="canvas_container">
						<canvas class="canvas" id= "canvas" width="320" height="240"></canvas>
						<canvas class="canvas" id="canvas_stickers" width="320" height="240"></canvas>
					</div>
    			</div>
			</div>

		</div>

		<div class="col-3">
			<h4 style="margin: 5px; color: rgb(43, 3, 69);">Previews</h4>
			<?php
			foreach($images as $image) {
					?>
			<div class="card">
				<div class="sticker-circle">
					<div class="circle">
						<img src="<?php echo(htmlspecialchars($image['img_path'])); ?>" alt="img">
					</div>
				</div>
			</div>
			<?php
			}
			?>
		</div>

	</div>

	<script type="text/javascript" src="js/js_add.js" charset="utf-8"></script>
	<script type="text/javascript" src="js/js_camera.js" charset="utf-8"></script>
	<script type="text/javascript" src="js/js_upload.js" charset="utf-8"></script>

<?php
} else {
	header("Location: login.php");
}
?>
<?php require_once 'footer.php';?>
</body>
</html>
