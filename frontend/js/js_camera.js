let video = document.querySelector("#video");

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

capture_button.addEventListener("click", async function () {
	canvas.getContext("2d").drawImage(video, 0, 0, canvas.width, canvas.height);
	let canvasUrl = canvas.toDataURL("image/jpeg");

	webcam_file.value = canvasUrl;
	uploading.value = "";
});
