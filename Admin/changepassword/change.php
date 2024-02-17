<?php
  include 'session_check.php';
include '../../common/connection.php';
session_start();
if(isset($_SESSION['Admin_id'])) {
  $empid=$_SESSION['Admin_id'];
  $sql="SELECT Admin_password FROM `admin` WHERE Admin_id='$empid'";
  $result=mysqli_query($con,$sql);
  $row=mysqli_fetch_array($result);
  $dbpassword=$row["Admin_password"];
  if(isset($_POST["cur-password"])){
    $current_password=$_POST["cur-password"];
    if (password_verify($current_password,$dbpassword)) {
        if(isset($_POST["new-password"])){
            $new_password=$_POST["new-password"];
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $sql= "UPDATE admin SET Admin_password='$hashed_password' WHERE Admin_id='$empid'";
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