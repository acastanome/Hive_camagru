function postDelete(img_id) {
	let xml = new XMLHttpRequest();

	// data = "delete=1&imgId=" + img_id;
	// data = "delete=1&image_id=" + img_id + "";
	data = "like=1&image_id=" + img_id + "&heart_status=like";
	xml.open("post", "delete.php?" + data, true);
	xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	console.log(data);
	// console.log(data);
	xml.send(data);
}