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
		// console.log(stickers_file.value);
	});
}

capture_button.addEventListener("click", async function () {
	canvas.getContext("2d").drawImage(video, 0, 0, canvas.width, canvas.height);
	let canvasUrl = canvas.toDataURL("image/jpeg");

	webcam_file.value = canvasUrl;
});

//UPLOAD
// let upl = document.querySelector("#upload_photo");

// let myImg_file = document.querySelector("#myImg_file");

// window.addEventListener("load", function () {
// document
// 	.querySelector('input[type="file"]')
// 	.addEventListener("change", function () {
// 		if (this.files && this.files[0]) {
// 			var img = document.querySelector("#myImg");
// 			img.onload = () => {
// 				URL.revokeObjectURL(img.src); // no longer needed, free memory
// 			};
// 			img.src = URL.createObjectURL(this.files[0]); // set src to blob url
// 			img.innerHTML.width = "320";
// 			console.log(img.src);

// 			canvas.getContext("2d").drawImage(img, 0, 0, canvas.width, canvas.height);

// 			let canvasUrl = canvas.toDataURL();

// 			myImg_file.value = canvasUrl;
// 			console.log(myImg_file.value);
// 			console.log(stickers_file.value);
// 			capture_button.disabled = true;
// 		}
// 	});
// });

let uploadedPicture = document.getElementById("uploaded-picture");
let imageInput = document.querySelector("#image_input");

imageInput.addEventListener("change", function () {
	let readFile = new FileReader();
	let uploadedPicture = "";
	// let fsize = Math.round(this.files[0].size / 1024);

	readFile.addEventListener("load", function () {
		uploadedPicture = readFile.result;
		uploadedPicture.style.display = "block";
		uploadedPicture.src = img;
	});
	readFile.readAsDataURL(this.files[0]);

	if (uploadedPicture.getAttribute("src") !== "")
		canvas
			.getContext("2d")
			.drawImage(uploadedPicture, 0, 0, canvas.width, canvas.height);
	let canvasUrl = canvas.toDataURL("image/jpeg");
	webcam_file.value = canvasUrl;
});
