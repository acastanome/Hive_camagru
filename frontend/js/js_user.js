function validateCreateForm() {
  let name = document.forms["createForm"]["f_username"].value;
  let pswd = document.forms["createForm"]["f_passwd"].value;

  if (!validateUsername(name) || !validatePassword(pswd)) {
    return false;
  }
}

function validateForm() {
  let name = document.forms["loginForm"]["f_username"].value;
  let pswd = document.forms["loginForm"]["f_passwd"].value;

  if (!validateUsername(name) || !validatePassword(pswd)) {
    return false;
  }
}

//password_verify and bcrypt

function validateUsername(name) {
  let minNumberofChars = 1;
  let maxNumberofChars = 30;
  let regularExpression = /^[a-zA-Z0-9_]{1,30}$/;
  if (name.length < minNumberofChars || name.length > maxNumberofChars) {
    alert("Username can't be over 30 characters long");
    return false;
  }
  if (!regularExpression.test(name)) {
    alert(
      "Username can only contain letters, numbers and the special character _"
    );
    return false;
  }
  return true;
}

function validatePassword(pswd) {
  let minNumberofChars = 8;
  let maxNumberofChars = 30;
  let regularExpression =
    /^(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-zA-Z])[a-zA-Z0-9!@#$%^&*]{8,30}$/;
  if (pswd.length < minNumberofChars || pswd.length > maxNumberofChars) {
    alert("Password must be between 8 and 30 characters long");
    return false;
  }
  if (!regularExpression.test(pswd)) {
    alert(
      "Password can only contain letters, numbers and special characters !@#$%^&* (at least one of each)"
    );
    return false;
  }
  return true;
}
