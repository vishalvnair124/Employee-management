<?php
include '../common/connection.php';
if(isset($_COOKIE['theempid']))
{
    $id=$_COOKIE['theempid'] ;
    $pass=$_GET['password'];
    setcookie("theempid", "", time() - 3600, "/");
    setcookie("theemppass", "", time() - 3600, "/");
    $password = password_hash($pass, PASSWORD_DEFAULT);
    $passup="UPDATE employee_details SET Emp_Password='$password' WHERE Emp_id='$id'";
    $con->query($passup);
    echo "<script>window.location.href = '../login.php';</script>";
}
else
{
    echo "<script>alert('Password Time out')</script>";
    echo "<script>window.location.href = '../login.php';</script>";
}
?>