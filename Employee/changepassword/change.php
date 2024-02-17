<?php
  include 'session_check.php';
include '../../common/connection.php';
session_start();
if(isset($_SESSION['Emp_id'])) {
  $empid=$_SESSION['Emp_id'];
  $sql="SELECT Emp_Password FROM `employee_details` WHERE Emp_id='$empid'";
  $result=mysqli_query($con,$sql);
  $row=mysqli_fetch_array($result);
  $dbpassword=$row["Emp_Password"];
  if(isset($_POST["cur-password"])){
    $current_password=$_POST["cur-password"];
    if (password_verify($current_password,$dbpassword)) {
        if(isset($_POST["new-password"])){
            $new_password=$_POST["new-password"];
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $sql= "UPDATE employee_details SET Emp_Password='$hashed_password' WHERE Emp_id='$empid'";
            mysqli_query($con,$sql);
            header("location:../index.php?page=changepassword&passwordchanged=true");
          }
    } else {
        header("location:../index.php?page=changepassword&wrongpassword=true");
    }
  }
   
}else{
    header("location:../../login/login.php");
}

?>