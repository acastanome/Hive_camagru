let imgInput = document.getElementById("imageInput");

imgInput.addEventListener("change", function (e) {
	canvas.getContext("2d").clearRect(0, 0, canvas.width, canvas.height);
	if (e.target.files) {
		let imageFile = e.target.files[0]; //here we get the image file
		var reader = new FileReader();
		reader.readAsDataURL(imageFile);
		reader.onloadend = function (e) {
			var myImage = new Image();
			myImage.src = e.target.result; // Assigns converted image to image object
			myImage.onload = function (ev) {
				var MAX_WIDTH = 320;
				var MAX_HEIGHT = 240;
				var width = myImage.width;
				var height = myImage.height;

				// Resizing logic
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
				let imgUrl = canvas.toDataURL("image/jpeg", 0.75); // Assigns image base64 string in jpeg format to a variable
				webcam_file.value = imgUrl;
				uploading.value = "1";
			};
		};
	}
});
