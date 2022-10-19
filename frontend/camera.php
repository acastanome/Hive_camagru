<?php require_once 'head.php';
require_once 'navbar.php';?>
	<link rel="stylesheet" href="style_cam.css">
<body>
<?php
if (isset($_SESSION['logged_user'])) {?>
	<div class="container">
		<div class="col-9">
			<div>
				<video id="video" width="320" height="240" autoplay></video>
				<button id="start-camera">Start Camera</button>
			</div>
			<div>
				<canvas id="canvas" width="320" height="240"></canvas>
				<button id="click-photo">Click Photo</button>
			</div>

			<h4>Stickers</h4>
			<div class="card">
					<div class="sticker_circle">
						<div class="circle">
							<img src=
"http://localhost:8080/camagru/stickers/cat-box.png" alt="cat-box.png">
						</div>
					</div>
					<div class="sticker_circle">
						<div class="circle">
							<img src=
"http://localhost:8080/camagru/stickers/flamingo.png" alt="cat-box.png">
						</div>
					</div>
					<div class="sticker_circle">
						<div class="circle">
							<img src=
"http://localhost:8080/camagru/stickers/dog.png" alt="cat-box.png">
						</div>
					</div>
					<div class="sticker_circle">
						<div class="circle">
							<img src=
"http://localhost:8080/camagru/stickers/crocodile.png" alt="cat-box.png">
						</div>
					</div>
					<div class="sticker_circle">
						<div class="circle">
							<img src=
"http://localhost:8080/camagru/stickers/fox.png" alt="cat-box.png">
						</div>
					</div>
					<div class="sticker_circle">
						<div class="circle">
							<img src=
"http://localhost:8080/camagru/stickers/turtle.png" alt="cat-box.png">
						</div>
					</div>
			</div>
		</div>
		<div class="col-3">
			<h4>Pic previews</h4>
			<div class="card">
				<div class="sticker_circle">
					<div class="circle">
						<img src=
"http://localhost:8080/camagru/images/img0.jpg" alt="cat-box.png">
					</div>
				</div>
			</div>
			<div class="card">
				<div class="sticker_circle">
					<div class="circle">
						<img src=
"http://localhost:8080/camagru/images/img0.jpg" alt="cat-box.png">
					</div>
				</div>
			</div>
		</div>
	</div>
		
		<script>
			let camera_button = document.querySelector("#start-camera");
			let video = document.querySelector("#video");
			let click_button = document.querySelector("#click-photo");
			let canvas = document.querySelector("#canvas");
			
			// camera_button.addEventListener('click', async function() {
			// 	let stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
			// 	video.srcObject = stream;
			// });
			async function live_cam() {
				let stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
				video.srcObject = stream;
			};

			live_cam();
			
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