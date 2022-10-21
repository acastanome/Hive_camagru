// let camera_button = document.querySelector("#start-camera");
let video = document.querySelector("#video");
let capture_button = document.querySelector("#capture-photo");
// let upload_button = document.querySelector("#upload-photo");
let canvas = document.querySelector("#canvas");
let canvas_stickers = document.querySelector("#canvas_stickers");
let post_button = document.querySelector("#post_photo");
let stickers = document.querySelectorAll(".sticker");

let webcam_file = document.querySelector("#webcam_file");
let stickers_file = document.querySelector("#stickers_file");

// camera_button.addEventListener('click', async function() {
// 	let stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
// 	video.srcObject = stream;
// });
async function live_cam() {
	try {
		let stream = await navigator.mediaDevices.getUserMedia({
			video: true,
			audio: false,
		});
		video.srcObject = stream;
	} catch (err) {
		alert("Please, turn your camera on.");
	}
}

function addStickerToCanvas(id, canvas) {
	let img = document.getElementById(id);
	let pos_x = canvas.width / 6;
	let pos_y = canvas.height - pos_x;
	switch (id) {
		case "sticker1":
			canvas.getContext("2d").drawImage(img, 3, pos_y, pos_x, pos_x);
			break;
		case "sticker2":
			canvas.getContext("2d").drawImage(img, pos_x, pos_y, pos_x, pos_x);
			break;
		case "sticker3":
			canvas.getContext("2d").drawImage(img, pos_x * 2, pos_y, pos_x, pos_x);
			break;
		case "sticker4":
			canvas.getContext("2d").drawImage(img, pos_x * 3, pos_y, pos_x, pos_x);
			break;
		case "sticker5":
			canvas.getContext("2d").drawImage(img, pos_x * 4, pos_y, pos_x, pos_x);
			break;
		case "sticker6":
			canvas.getContext("2d").drawImage(img, pos_x * 5, pos_y, pos_x, pos_x);
			break;
	}
	let stickersUrl = canvas.toDataURL();
	stickers_file.value = stickersUrl;
	// console.log(stickers_file.value);
}

live_cam();
capture_button.disabled = true;

capture_button.addEventListener("click", async function () {
	canvas.getContext("2d").drawImage(video, 0, 0, canvas.width, canvas.height);
	let canvasUrl = canvas.toDataURL("image/jpeg");
	// data url of the image
	// console.log(cam_data_url);
	webcam_file.value = canvasUrl;
	// console.log(webcam_file.value);
});

// upload_button.addEventListener("click", function () {
// 	canvas.getContext("2d").drawImage(video, 0, 0, canvas.width, canvas.height);
// 	let image_data_url = canvas.toDataURL("image/jpeg");
// 	// data url of the image
// 	console.log(image_data_url);
// });

// save_button.addEventListener("click", function () {
// 	canvas.getContext("2d").drawImage(video, 0, 0, canvas.width, canvas.height);
// 	let image_data_url = canvas.toDataURL("image/jpeg");
// 	// data url of the image
// 	console.log(image_data_url);
// });

//arrow functions
for (i = 0; i < stickers.length; i++) {
	stickers[i].addEventListener("click", (event) => {
		//console.log(event.target.id);
		addStickerToCanvas(event.target.id, canvas_stickers);
		// stickers[i]_button.disabled = true;
		capture_button.disabled = false;
	});
}

//SAVE
// post_button.addEventListener("click", function () {
// 	//photo
// 	canvas.getContext("2d").drawImage(video, 0, 0, canvas.width, canvas.height);
// 	let canvas_data_url = canvas.toDataURL("image/jpeg");

// 	//stickers
// 	canvas_stickers
// 		.getContext("2d")
// 		.drawImage(video, 0, 0, canvas.width, canvas.height);
// 	let stickers_data_url = canvas.toDataURL("image/jpeg");
// 	// data url of the image

// 	console.log(image_data_url);
// 	console.log(stickers_data_url);
// });
