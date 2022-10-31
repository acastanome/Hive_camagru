function confirmDelete() {
	let agree = confirm("Are you sure you wish to delete this picture?");

	if (agree) return true;
	else return false;
}
