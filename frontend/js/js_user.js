
function validateForm() {
    let name = document.forms["loginForm"]["f_username"].value;
    if (name = "albi") {
        alert("Username must be filled out");
        return false;
    }
}