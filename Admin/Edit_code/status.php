<?php
//status controller of employee
include '../session_check.php';
    include '../../common/connection.php';
    $id=$_GET['id'];
    $status=$_GET['st'];
    $update="UPDATE employee_details SET Emp_status='$status' WHERE Emp_id='$id'";
    $con->query($update);
    if($status==2)
    {
        echo "<script>window.location.href = '../Index.php?page=Employees';</script>";
    }
    else
    {
        echo "<script>window.location.href = '../Index.php?page=View_details';</script>";
    }
    
?>
