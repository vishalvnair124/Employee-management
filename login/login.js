

function validation(){
  
    defaultView();
    var isUsernameValid = validateuser();
    var isPasswordValid = validatepass();
  
    return isPasswordValid&&isUsernameValid;
  }
  function validateuser(){
    var uname = /^[A-Za-z0-9]*$/;
    var username = document.getElementById("username");
    var username12 = document.getElementById("theuserdiv");
  
    if (!username.value.trim().match(uname)|| (username.value=="")) {
      document.getElementById("usernameinvalid").style.visibility = "visible";
      username12.style.borderBottom = "solid 3px red";
      return false;
    } else {
      return true;
    }
  }
  function validatepass(){
    var errorText = "Invalid password :";
    var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;
    var password = document.getElementById("password").value;
  
    if (password.trim().match(passw)) {
      return true;
    } else {
      if (password.length < 8) {
        errorText += "Password must be at least 8 characters long. ";
      } else if (!/[A-Z]/.test(password)) {
        errorText += "Password must contain at least one uppercase letter. ";
      } else if (!/[a-z]/.test(password)) {
        errorText += "Password must contain at least one lowercase letter. ";
      } else if (!/\d/.test(password)) {
        errorText += "Password must contain at least one digit. ";
      } else if (!/[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/.test(password)) {
        errorText += "Password must contain at least one special character. ";
      }
      document.getElementById("passwordinvalid").innerHTML = errorText;
      document.getElementById("passwordinvalid").style.visibility = "visible";
      document.getElementById("thepassdiv").style.borderBottom = "solid 3px red";
      return false;
    }
  }
  
  function defaultView(){
    document.getElementById("username").style.border = "none";
    document.getElementById("password").style.border = "none";
    document.getElementById("passwordinvalid").style.visibility = "hidden";
    document.getElementById("usernameinvalid").style.visibility = "hidden";
    document.getElementById("wrongpassword").style.visibility = "hidden";
    document.getElementById("theuserdiv").style.borderBottom = "3px solid rgb(155, 155, 155)";

  }
  
  function typechange(data)
{
    const Inputbox = document.getElementById(data);
    if (Inputbox.type === "text") {
        Inputbox.type="password";
      } else {
        Inputbox.type="text";
      }
}

const pa_main =document.querySelector('.pbox');
function show_first(){
    var passwordInput = document.getElementById("password");
    if(passwordInput.type=="password")
    {
        passwordInput.type="text";
        pa_main.classList.add('show_it');
    }
    else
    {
        passwordInput.type="password";
        pa_main.classList.remove('show_it');
    }
}