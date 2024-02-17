<?php
//page to edit the employee personal details
include 'session_check.php';
    include '../common/connection.php';
    $data_id=$_SESSION['detailid'];
    $query="SELECT * FROM employee_details WHERE Emp_id='$data_id'";
    $data=$con->query($query);
    $EMP = $data->fetch_assoc();

?>
<div class="edit_div">
    <div class="data">
        <form id="theformdata" method="POST" enctype="multipart/form-data" action="Edit_code/saveedits.php">
            <h2>EDIT DETAILS</h2>
            <table class="edit_table">
                <tr>
                    <td>
                        <label for="Username">Emp ID</label>
                    </td>
                    <td>
                        <input type="text" id="empid" name="Username" value="<?php echo $EMP['Emp_id'];?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="fullname">Full name</label>
                    </td>
                    <td>
                        <input type="text" id="name" name="fullname" value="<?php echo $EMP['Emp_name'];?>" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="email">Email</label>
                    </td>
                    <td>
                        <input type="text" id="email" name="email" value="<?php echo $EMP['Emp_email'];?>" required>
                    </td>
                </tr>
                <tr style="height:5px; margin:0px;">
                    <td colspan='2'>
                        <div class="form_div" style="margin:0;margin-bottom:0px;">
                            <label
                                style="font-size:13px; color:red; margin-left:100px; margin-top:2px; margin-bottom:0px; color: red; width:51%; text-align:center;"
                                id="notemail"></label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="address">Address</label>
                    </td>
                    <td>
                        <input type="text" id="address" value="<?php echo $EMP['Emp_Address'];?>" name="address">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="gender">Mobile no</label>
                    </td>
                    <td>
                        <input type="text" id="mobile" value="<?php echo $EMP['Emp_mobileno'];?>" name="mobile">
                    </td>
                </tr>
                <tr style="height:5px; margin:0px;">
                    <td colspan='2'>
                        <div class="form_div" style="margin:0;margin-bottom:0px;">
                            <label
                                style="font-size:13px; color:red; margin-left:40px; margin-top:2px; margin-bottom:0px; color: red; width:100%; text-align:center;"
                                id="notnumber"></label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="photo">Photo</label>
                    </td>
                    <td>
                        <input value="<?php echo $EMP['Emp_Photo'];?>" style="width:200px" type="file" name="photo"
                            id="photo">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <label for="remove">Do you want to remove Existing photo?</label><input style="margin-left:20px; margin-top:-3px;" type="checkbox" name="doyou" value="1">
                    </td>
                    <td>
                        
                    </td>
                </tr>
                <tr class="footer_tr">
                    <td colspan="2">
                        <div class="Edit_footer">
                            <?php echo "<a href='?page=View_details'><button  type='button' class='cancel_edit' >Close</button></a>" ?>
                            <button type="button" onclick="thecheckdata()" class="save_edit"
                                name="update">Update</button>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<script>
function thecheckdata() {
    var emp_id = document.getElementById('empid').value;
    emailbox = document.getElementById('email');
    var email = emailbox.value;
    var emaillebal = document.getElementById('notemail');
    emaillebal.textContent = "";
    mobnumberbox = document.getElementById('mobile');
    var mobnumber = mobnumberbox.value;
    var numberlebal = document.getElementById('notnumber');
    numberlebal.textContent = "";
    i = 0;
    j = 0;
    var data = new FormData();
    if (email != '') {
        var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (emailPattern.test(email)) {
            data.append('Email', email);
            emailbox.style.borderColor = '#d2d6de';
        } else {
            emailbox.style.borderColor = 'red';
            emaillebal.textContent = "Enter a valid Email";
        }
    } else {
        emailbox.style.borderColor = 'red';
        emaillebal.textContent = "Email can't be empty";
    }
    if (mobnumber != '') {
        if (!isNaN(mobnumber) && !isNaN(parseFloat(mobnumber))) {
            if (mobnumber.length === 10) {
                data.append('Mobile', mobnumber);
                mobnumberbox.style.borderColor = '#d2d6de';
            } else {
                mobnumberbox.style.borderColor = 'red';
                numberlebal.textContent = "Mobile number must be 10 digits";
            }
        } else {
            mobnumberbox.style.borderColor = 'red';
            numberlebal.textContent = "Enter a valid Mobile number ";
        }
    } else {
        mobnumberbox.style.borderColor = 'red';
        numberlebal.textContent = "Mobile number can't be empty";
    }
    data.append('Empid', emp_id);
    var xhr = new XMLHttpRequest();
    var url = "Edit_code/email_phone_check.php";

    xhr.open("POST", url, true);

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = xhr.responseText.split(',');
            var emaildata = parseInt(response[0]);
            var nodata = parseInt(response[1]);
            if (nodata != 404) {
                if (nodata == 0) {
                    mobnumberbox.style.borderColor = 'green';
                    j = 1;
                } else {
                    mobnumberbox.style.borderColor = 'red';
                    numberlebal.textContent = "Mobile no already exists";
                }
            }

            if (emaildata != 404) {
                if (emaildata == 0) {
                    emailbox.style.borderColor = 'green';
                    i = 1;
                } else {
                    emailbox.style.borderColor = 'red';
                    emaillebal.textContent = "Email already exists";
                }
            }
            if (i == 1 && j == 1) {
                if (checkvalidnew()) {
                    document.getElementById('theformdata').submit();
                } else {
                    return false;
                }
            }
        }
    };
    xhr.send(data);
}

function checkvalidnew() {
    a = []
    b = []
    value1 = document.getElementById('name');
    value2 = document.getElementById('address');
    b.push(value1, value2)
    a.push(value1.value, value2.value)
    co = 0
    for (i = 0; i < 2; i++) {
        if (a[i] == '') {
            co = 1
            b[i].style.borderColor = 'red';
        } else {
            b[i].style.borderColor = '#d2d6de';
        }
    }
    if (co == 1) {
        return false;
    } else {
        return true;
    }
}
</script>