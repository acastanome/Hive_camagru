let uploading = document.querySelector("#uploading");
let canvas = document.querySelector("#canvas");
let canvas_stickers = document.querySelector("#canvas_stickers");
let stickers = document.querySelectorAll(".sticker");

let stickers_file = document.querySelector("#stickers_file");
let webcam_file = document.querySelector("#webcam_file");
let post_button = document.querySelector("#post_photo");

let capture_button = document.querySelector("#capture-photo");
capture_button.disabled = true;

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
}

for (i = 0; i < stickers.length; i++) {
	stickers[i].addEventListener("click", (event) => {
		addStickerToCanvas(event.target.id, canvas_stickers);
		capture_button.disabled = false;
		let stickersUrl = canvas_stickers.toDataURL();
		stickers_file.value = stickersUrl;
	});
}
