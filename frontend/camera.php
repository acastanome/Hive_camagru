
		
			<div class="camera_container">
				<video id="video" width="320" height="240" autoplay></video>
				<br>
				<button id="capture-photo">Capture Photo</button>
				<br>

				<form class="camera_form" name="cameraPostForm" action="camera_create_post.php" method="POST" enctype='multipart/form-data'>
						<input type="hidden" name="webcam_file" id="webcam_file" value="">
						<input type="hidden" name="stickers_file" id="stickers_file" value="">

						<!-- <img type="hidden" id="uploaded-picture" src=""> -->

						<button type="submit" name="post_photo" id="post_photo">Post</button>
				</form>

				<canvas class="canvas" id="canvas" width="320" height="240"></canvas>
				<canvas class="canvas" id="canvas_stickers" width="320" height="240"></canvas>
			</div>

	<script type="text/javascript" src="js/js_camera.js" charset="utf-8"></script>

