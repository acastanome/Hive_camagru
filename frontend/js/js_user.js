function validateCreateForm(event) {
  // event.preventDefault();
  let name = document.forms["createForm"]["f_username"].value;
  let pswd = document.forms["createForm"]["f_passwd"].value;
  let email = document.forms["createForm"]["f_email"].value;
  // const form = document.getElementById("create-form");

  // if (validateUsername(name) && validatePassword(pswd) && validateEmail(email)) {
  if (!validateUsername(name) || !validatePassword(pswd) || !validateEmail(email)) {
    // return false;
    event.preventDefault();
  }
}

function validateForm() {
  let name = document.forms["loginForm"]["f_username"].value;
  let pswd = document.forms["loginForm"]["f_passwd"].value;

  if (!validateUsername(name) || !validatePassword(pswd)) {
    // return false;
    event.preventDefault();
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

/* characters that can be included in email addresses according to RFC 3696 */
function validateEmail(email) {
  console.log(email.length)
  let minNumberofChars = 3;
  let maxNumberofChars = 50;
  let regularExpression =
    /^(?=.*[@])[a-zA-Z0-9!#$%&`*+-/=?^_'.{|}~@]{3,50}$/;
  if (email.length < minNumberofChars || email.length > maxNumberofChars) {
    alert("Email must be between 3 and 50 characters long");
    return false;
  }
  if (!regularExpression.test(email)) {
    alert(
      "Eamil can only contain letters, numbers and special characters !#$%&`*+-/=?^_'.{|}~@"
    );
    return false;
  }
  return true;
}
