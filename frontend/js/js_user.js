//password_verify and bcrypt

// function validateLoginForm(event) {
//   let name = document.forms["loginForm"]["f_username"].value;
//   let pswd = document.forms["loginForm"]["f_passwd"].value;

//   if (!validateLoginUsername(name) || !validateLoginPassword(pswd)) {
//     event.preventDefault();
//   }
// }

function validateLoginForm(event) {
  let name = document.forms["loginForm"]["f_username"].value;
  let pswd = document.forms["loginForm"]["f_passwd"].value;

  if (!validateLoginUsername(name) || !validateLoginPassword(pswd)) {
    event.preventDefault();
  }
}

function validateLoginUsername(name) {
  let regularExpression = /^[a-zA-Z0-9_]{1,30}$/;

  if (name.length < 1 || name.length > 30 || !regularExpression.test(name)) {
    alert("Invalid username.");
    return false;
  }
  return true;
}

function validateLoginPassword(pswd) {
  let regularExpression =
    /^(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-zA-Z])[a-zA-Z0-9!@#$%^&*]{8,30}$/;

  if (pswd.length < 8 || pswd.length > 30 || !regularExpression.test(pswd)) {
    alert("Invalid password.");
    return false;
  }
  return true;
}

function validateCreateForm(event) {
  let name = document.forms["createForm"]["f_username"].value;
  let pswd = document.forms["createForm"]["f_passwd"].value;
  let email = document.forms["createForm"]["f_email"].value;

  if (
    !validateUsername(name) ||
    !validatePassword(pswd) ||
    !validateEmail(email)
  ) {
    event.preventDefault();
  }
}

function validateUsername(name) {
  let regularExpression = /^[a-zA-Z0-9_]{1,30}$/;
  if (name.length < 1 || name.length > 30) {
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
  let regularExpression =
    /^(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-zA-Z])[a-zA-Z0-9!@#$%^&*]{8,30}$/;
  if (pswd.length < 8 || pswd.length > 30) {
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
  console.log(email.length);
  let regularExpression = /^(?=.*[@])[a-zA-Z0-9!#$%&`*+-/=?^_'.{|}~@]{3,50}$/;
  if (email.length < 3 || email.length > 50) {
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
