let canvas = document.querySelector("#myCanvas");
let canvas_stickers = document.querySelector("#canvas_stickers");
// let post_button = document.querySelector("#post_photo");
let stickers = document.querySelectorAll(".sticker");

let stickers_file = document.querySelector("#stickers_file");
// let file = document.querySelector("#file");
// let upload_form = document.querySelector("#uploadPostForm");

// window.addEventListener("load", async () => {
// 	try {
// 		let stream = await navigator.mediaDevices.getUserMedia({
// 			video: true,
// 			audio: false,
// 		});
// 		video.srcObject = stream;
// 	} catch (err) {
// 		alert("Please, turn your camera on.");
// 	}
// });

for (i = 0; i < stickers.length; i++) {
	stickers[i].addEventListener("click", (event) => {
		addStickerToCanvas(event.target.id, canvas_stickers);
		// capture_button.disabled = false;
		// console.log(stickers_file.value);
	});
}

// upload_form.addEventListener("click", async function () {
// 	// canvas.getContext("2d").drawImage(video, 0, 0, canvas.width, canvas.height);
// 	// let canvasUrl = canvas.toDataURL("image/jpeg");
// 	// webcam_file.value = canvasUrl;
// 	// data.append("file", upload_form["file"].files[0]);
// 	// var data = new FormData();
// 	// data.append("file", upload_form["file"].files[0]);
// 	console.log(upload_form["file"].files[0]);
// });

// post_button.addEventListener("click", async function () {
// 	canvas.getContext("2d").drawImage(video, 0, 0, canvas.width, canvas.height);
// 	let canvasUrl = canvas.toDataURL("image/jpeg");

// 	webcam_file.value = canvasUrl;
// });

let imgInput = document.getElementById("imageInput");

imgInput.addEventListener("change", function (e) {
	if (e.target.files) {
		let imageFile = e.target.files[0]; //here we get the image file
		var reader = new FileReader();
		reader.readAsDataURL(imageFile);
		reader.onloadend = function (e) {
			var myImage = new Image(); // Creates image object
			myImage.src = e.target.result; // Assigns converted image to image object
			myImage.onload = function (ev) {
				// var myCanvas = document.getElementById("myCanvas"); // Creates a canvas object
				// var myContext = myCanvas.getContext("2d"); // Creates a contect object
				// myCanvas.width = myImage.width; // Assigns image's width to canvas
				// myCanvas.height = myImage.height; // Assigns image's height to canvas
				// myContext.drawImage(myImage, 0, 0); // Draws the image on canvas

				var MAX_WIDTH = 320;
				var MAX_HEIGHT = 240;
				var width = myImage.width;
				var height = myImage.height;

				// Add the resizing logic
				if (width > height) {
					if (width > MAX_WIDTH) {
						height *= MAX_WIDTH / width;
						width = MAX_WIDTH;
					}
				} else {
					if (height > MAX_HEIGHT) {
						width *= MAX_HEIGHT / height;
						height = MAX_HEIGHT;
					}
				}
				let start_x = canvas.width - width;
				if (start_x > 0) {
					start_x = start_x / 2;
				} else {
					start_x = 0;
				}
				let start_y = canvas.height - height;
				if (start_y > 0) {
					start_y = start_y / 2;
				} else {
					start_y = 0;
				}
				canvas
					.getContext("2d")
					.drawImage(myImage, start_x, start_y, width, height);
				// canvas
				// 	.getContext("2d")
				// 	.drawImage(myImage, 0, 0, myImage.width, myImage.height);

				// let imgData = myCanvas.toDataURL("image/jpeg", 0.75); // Assigns image base64 string in jpeg format to a variable
				let imgData = canvas.toDataURL("image/jpeg", 0.75); // Assigns image base64 string in jpeg format to a variable
			};
		};
	}
});
