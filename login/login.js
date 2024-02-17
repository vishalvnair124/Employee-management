

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
    var errorText = "Invalid password ";
    var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;
    var password = document.getElementById("password").value;
  
    if (password.trim().match(passw)) {
      return true;
    } else {
      if (password.length < 8) {
        errorText += " : Password must be at least 8 characters long. ";
      } else if (!/[A-Z]/.test(password)) {
        errorText += " : Password must contain at least one uppercase letter. ";
      } else if (!/[a-z]/.test(password)) {
        errorText += " : Password must contain at least one lowercase letter. ";
      } else if (!/\d/.test(password)) {
        errorText += " : Password must contain at least one digit. ";
      } else if (!/[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/.test(password)) {
        errorText += " : Password must contain at least one special character. ";
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
function forgot()
{
  window.location.href = 'forgot.php';
}
g=0;
function check_emailv2()
{
  mail=document.getElementById("Email").value;
  green=document.getElementById("mark");
  green.style.visibility = "hidden";
  if (mail.match(/^[a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/)) 
  {
        var input = mail;
        $.ajax({
            url: "validemail.php",
            method: "POST",
            data: {
                input: input
            },
            success: function(data) {
                if (data.trim() === '1') {  
                  green.style.visibility = "visible";
                  g=1;
                }
                else
                {
                  g=0;
                }
            }
        });
    }
}
function emailsubmit()
{
  mail=document.getElementById("Email").value;
  
  if(mail=="")
  {
    alert("Enter your Email");
  }
  else
  {
    if(g==1)
    {
      const loads =document.getElementById('theloadscreen');
      loads.classList.add('active');
      window.location.href = 'OPT_sender.php/?em='+mail;
    }
    else
    {
      alert("Email not found");
    }
  }
  
}
function optcheck(theid)
{
  const page =document.getElementById('pagefor');
  opt=document.getElementById("Token").value;
  wrongtoken=document.getElementById("wrongtoken");
  wrongtoken.style.visibility = "hidden";
  if (opt!="") 
  {
        $.ajax({
            url: "opt_check.php",
            method: "POST",
            data: {
                opt: opt
            },
            success: function(data) {
                if (data.trim() === '1') {  
                  page.classList.add('active');
                }
                else
                {
                  wrongtoken.innerHTML="Wrong Password";
                  wrongtoken.style.visibility = "visible";
                }
            }
        });
    }
    else
    {
      wrongtoken.innerHTML="Please enter the OPT";
      wrongtoken.style.visibility = "visible";
    }
}

function validatepass2() {
  var errorText = "Invalid password: ";
  var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;

  var password = document.getElementById('Password').value;
  var password2 = document.getElementById('Password2').value;
  document.getElementById("pass2div").style.borderBottom = "3px solid rgb(108, 108, 108)";
  document.getElementById("newpassbar").style.borderBottom = "3px solid rgb(108, 108, 108)";
  document.getElementById('formatwrong').style.visibility = "hidden";
  document.getElementById('formatwrong').innerHTML="";
  document.getElementById('label11').style.color = "rgb(108, 108, 108)";
  document.getElementById('label22').style.color = "rgb(108, 108, 108)";
  if (password.trim().match(passw)) {
    if(password!=password2)
    {
      document.getElementById('formatwrong').innerHTML = "Passwords are not same";
      document.getElementById('formatwrong').style.visibility = "visible";
      document.getElementById('pass2div').style.borderBottom = "solid 3px red";
      document.getElementById('label22').style.color = "red";
      return false;
    }
    else
    {
      window.location.href = 'reset_pass.php/?password='+password;
    }
      
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
      document.getElementById('formatwrong').innerHTML = errorText;
      document.getElementById('formatwrong').style.visibility = "visible";
      document.getElementById('newpassbar').style.borderBottom = "solid 3px red";
      document.getElementById('label11').style.color = "red";
      return false;
  }
}