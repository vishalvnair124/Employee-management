<?php
include 'session_check.php';
include '../common/connection.php';
$id=$_POST['Username'];
$name=$_POST['fullname'];
$address=$_POST['address'];
$DOB=$_POST['DOB'];
$mobile=$_POST['mobile'];
$gender=$_POST['gender'];
$filename = $_FILES['photo']['name'];
if(!empty($filename)){
    move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	
}
$update_status="UPDATE employee_details SET Emp_status='4' WHERE Emp_id='$id'";
$id="R".$id;
$insert="INSERT INTO employee_details(Emp_id, Emp_name, gender, Emp_Address, Emp_DOB, Emp_mobileno,Emp_Photo, Emp_status) VALUES ('$id','$name','$gender','$address','$DOB','$mobile','$filename','101')";
$con->query($insert);
$con->query($update_status);
echo "<script>window.location.href = 'index.php';</script>";
?>