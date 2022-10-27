function ajaxComment(img_id) {
	let xml = new XMLHttpRequest();
	let imageComment = document.getElementById("comment" + img_id);
	let text = document.getElementById("f_comment" + img_id).value;
	let status = imageComment.name;

	if (status == "fullC") {
		data =
			"comment=1&image_comment=" +
			img_id +
			"&comment_status=like&comment_text=" +
			text;
	} else if (status == "outlineC") {
		imageComment.src =
			"http://localhost:8080/camagru/stickers/comment-full.png";
		imageComment.name = "fullC";
		data =
			"comment=1&image_comment=" +
			img_id +
			"&comment_status=like&comment_text=" +
			text;
	} else {
		return;
	}
	xml.open("post", "comments.php?" + data, true);
	xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xml.send(data);
}
// function ajaxComment(img_id) {
// 	let xml = new XMLHttpRequest();
// 	let imageComment = document.getElementById("comment" + img_id);
// 	let text = document.getElementById("f_comment" + img_id).value;
// 	let status = imageComment.name;

// 	if (status == "full") {
// 		imageComment.src =
// 			"http://localhost:8080/camagru/stickers/comment-full.png";
// 		imageComment.name = "outline";
// 		data = "comment=1&image_comment=" + img_id + "&comment_status=like";
// 	} else if (status == "outline") {
// 		imageComment.src =
// 			"http://localhost:8080/camagru/stickers/comment-outline.png";
// 		imageComment.name = "full";
// 		data = "comment=1&image_comment=" + img_id + "&comment_status=dislike";
// 	}

// 	xml.open("post", "comments.php?" + data, true);
// 	xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
// 	xml.send(data);
// }
