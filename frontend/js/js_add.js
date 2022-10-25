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

let canvas = document.querySelector("#canvas");
let canvas_stickers = document.querySelector("#canvas_stickers");
let stickers = document.querySelectorAll(".sticker");

let stickers_file = document.querySelector("#stickers_file");

//stickers for has capture_button.disable in camera but not upload

// let uploadedPicture = document.getElementById("uploaded-picture");
// let imageInput = document.querySelector("#image_input");

// imageInput.addEventListener("change", function () {
// 	let readFile = new FileReader();
// 	let uploadedPicture = "";
// 	// let fsize = Math.round(this.files[0].size / 1024);

// 	readFile.addEventListener("load", function () {
// 		uploadedPicture = readFile.result;
// 		uploadedPicture.style.display = "block";
// 		uploadedPicture.src = img;
// 	});
// 	readFile.readAsDataURL(this.files[0]);

// 	if (uploadedPicture.getAttribute("src") !== "")
// 		canvas
// 			.getContext("2d")
// 			.drawImage(uploadedPicture, 0, 0, canvas.width, canvas.height);
// 	let canvasUrl = canvas.toDataURL("image/jpeg");
// 	webcam_file.value = canvasUrl;
// });
