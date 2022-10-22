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
}

let video = document.querySelector("#video");
let capture_button = document.querySelector("#capture-photo");
// let upload_button = document.querySelector("#upload-photo");
let canvas = document.querySelector("#canvas");
let canvas_stickers = document.querySelector("#canvas_stickers");
let post_button = document.querySelector("#post_photo");
let stickers = document.querySelectorAll(".sticker");

let webcam_file = document.querySelector("#webcam_file");
let stickers_file = document.querySelector("#stickers_file");

capture_button.disabled = true;

window.addEventListener("load", async () => {
	try {
		let stream = await navigator.mediaDevices.getUserMedia({
			video: true,
			audio: false,
		});
		video.srcObject = stream;
	} catch (err) {
		alert("Please, turn your camera on.");
	}
});

for (i = 0; i < stickers.length; i++) {
	stickers[i].addEventListener("click", (event) => {
		addStickerToCanvas(event.target.id, canvas_stickers);
		capture_button.disabled = false;
	});
}

capture_button.addEventListener("click", async function () {
	canvas.getContext("2d").drawImage(video, 0, 0, canvas.width, canvas.height);
	let canvasUrl = canvas.toDataURL("image/jpeg");

	webcam_file.value = canvasUrl;
});

//UPLOAD
//https://www.youtube.com/watch?v=RvzWGElvr7w
upload_photo.onchange = (event) => {
	const [file] = upload_photo.files;
	if (file) {
		console.log(file.path);
		// picture.src = URL.createObjectURL(file);
		canvas.getContext("2d").drawImage(file, 0, 0, file.width, file.height);
		// setTimeout(() => {
		// 	if (picture.height < 400)
		// 		alert(
		// 			"Stickers may not show properly on images of this size. Choose a different image if you wish to add stickers."
		// 		);
		// 	if (picture.width < picture.height) {
		// 		let maxHeight = 700;
		// 		let maxWidth = 500;
		// 		if (picture.width > maxWidth || picture.height > maxHeight) {
		// 			let ratio = picture.width / picture.height;
		// 			if (ratio > 1) {
		// 				picture.width = maxWidth;
		// 				picture.height = maxHeight / ratio;
		// 			} else {
		// 				picture.width = maxWidth * ratio;
		// 				picture.height = maxHeight;
		// 				alert(
		// 					"Stickers may not show properly on images of this size. Choose a different image if you wish to add stickers."
		// 				);
		// 			}
		// 		}
		// 	}
		// }, 50);
	}
};
