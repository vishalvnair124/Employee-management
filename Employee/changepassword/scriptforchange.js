
function validation() {
    defaultView();
    var isCurPassValid = validatepass("cur-password", "cur-passwordinvalid");
    var isNewPassValid = validatepass("new-password", "new-passwordinvalid");
    var isConPassValid = validatepass("con-password", "con-passwordinvalid");
    
    
    if (isNewPassValid && isConPassValid) {
        var newPassword = document.getElementById("new-password").value;
        var confirmPassword = document.getElementById("con-password").value;

        if (newPassword !== confirmPassword) {
            document.getElementById("same-password").style.visibility = "visible";
            return false;
        }
    }

    return isCurPassValid && isNewPassValid && isConPassValid;
}

function validatepass(inputId, errorLabelId) {
    var errorText = "Invalid password: ";
    var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;
    var password = document.getElementById(inputId).value;

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
        document.getElementById(errorLabelId).innerHTML = errorText;
        document.getElementById(errorLabelId).style.visibility = "visible";
        document.getElementById(inputId).style.border = "solid 3px red";
        return false;
    }
}

function defaultView() {
    document.getElementById("cur-password").style.border = "1px solid #ccc";
    document.getElementById("cur-passwordinvalid").style.visibility = "hidden";
    document.getElementById("new-password").style.border = "1px solid #ccc";
    document.getElementById("new-passwordinvalid").style.visibility = "hidden";
    document.getElementById("con-password").style.border = "1px solid #ccc";
    document.getElementById("con-passwordinvalid").style.visibility = "hidden";
    document.getElementById("same-password").style.visibility = "hidden";
    document.getElementById("passwordresult").style.visibility = "hidden";
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