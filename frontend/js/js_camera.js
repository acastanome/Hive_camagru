let video = document.querySelector("#video");
let capture_button = document.querySelector("#capture-photo");
// let canvas = document.querySelector("#canvas");
// let canvas_stickers = document.querySelector("#canvas_stickers");
let post_button = document.querySelector("#post_photo");
// let stickers = document.querySelectorAll(".sticker");

let webcam_file = document.querySelector("#webcam_file");
// let stickers_file = document.querySelector("#stickers_file");

capture_button.disabled = true;

//yes
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

// let uploadedPicture = document.getElementById("uploaded-picture");
// let imageInput = document.querySelector("#image_input");

// imageInput.addEventListener("change", function () {
// 	let readFile = new FileReader();
// 	let uploadedPicture = "";

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
