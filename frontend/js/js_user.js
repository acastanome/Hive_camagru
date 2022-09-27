function validateForm() {
  //let name = document.forms["loginForm"]["f_username"].value;
  let pswd = document.forms["loginForm"]["f_passwd"].value;
  let regularExpression =
    /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,30}$/;

  // if (document.forms["loginForm"]["f_username"].length < 8) {
  //   //alert("Username must be albi");
  //   alert("Username must be at least 8 characters long");
  //   return false;
  // }
  // if (document.forms["loginForm"]["f_username"].value != "albialbi") {
  //   //alert("Username must be albi");
  //   alert(
  //     "Username must be at least 8 characters long, with one special character"
  //   );
  //   return false;
  // }
  if (pswd.length < 8 || pswd.length > 30 || (!regularExpression.test(pswd))) {
    alert("Password must be between 8 and 30 characters long");
    return false;
  }
}

//password_verify and bcrypt

function validatePassword(let pswd) {
  let minNumberofChars = 8;
  let maxNumberofChars = 30;
  let regularExpression =
    /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,30}$/;
  if (
    pswd.length < minNumberofChars ||
    pswdd.length > maxNumberofChars
  ) {
    return false;
  }
  if (!regularExpression.test(newPassword)) {
    alert(
      "password should contain atleast one number and one special character"
    );
    return false;
  }
}
