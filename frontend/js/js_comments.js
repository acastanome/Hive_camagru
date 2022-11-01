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
			encodeURIComponent(text);
	} else if (status == "outlineC") {
		imageComment.src = "http://localhost:8080/camagru/media/comment-full.png";
		imageComment.name = "fullC";
		data =
			"comment=1&image_comment=" +
			img_id +
			"&comment_status=like&comment_text=" +
			encodeURIComponent(text);
	} else {
		return;
	}
	xml.open("post", "comments.php?" + data, true);
	xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xml.send(data);
}
