function ajaxLike(img_id) {
	let xml = new XMLHttpRequest();
	let imageHeart = document.getElementById("heart" + img_id);
	let likes = parseInt(document.getElementById("likeNb" + img_id).innerHTML);
	let status = imageHeart.name;

	if (status == "full") {
		imageHeart.src = "http://localhost:8080/camagru/stickers/heart-full.png";
		imageHeart.name = "outline";
		data = "like=1&image_heart=" + img_id + "&heart_status=like";
		document.getElementById("likeNb" + img_id).innerHTML = likes + 1;
	} else if (status == "outline") {
		imageHeart.src = "http://localhost:8080/camagru/stickers/heart-outline.png";
		imageHeart.name = "full";
		data = "like=1&image_heart=" + img_id + "&heart_status=dislike";
		if (likes > 0) {
			document.getElementById("likeNb" + img_id).innerHTML = likes - 1;
		}
	}

	xml.open("post", "like.php?" + data, true);
	xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xml.send(data);
}
