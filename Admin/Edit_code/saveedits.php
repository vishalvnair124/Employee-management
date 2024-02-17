<?php
//creating the new designation
include '../session_check.php';
include '../../common/connection.php';
    $empid = $_POST['Username'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $filename = $_FILES['photo']['name'];
    $doyou = $_POST['doyou'];
    if(!empty($filename)){
        move_uploaded_file($_FILES['photo']['tmp_name'], '../../images/'.$filename);	
        $sql = "UPDATE employee_details SET Emp_name='$fullname',Emp_Address='$address',Emp_mobileno='$mobile',Emp_email='$email',Emp_Photo='$filename' WHERE Emp_id='$empid'";	
    }
    else
    {
        if($doyou==1)
        {
            $sql = "UPDATE employee_details SET Emp_name='$fullname',Emp_Address='$address',Emp_mobileno='$mobile',Emp_email='$email',Emp_Photo='' WHERE Emp_id='$empid'";
        }
        else
        {
            $sql = "UPDATE employee_details SET Emp_name='$fullname',Emp_Address='$address',Emp_mobileno='$mobile',Emp_email='$email' WHERE Emp_id='$empid'";
        }
        
    }
    $con->query($sql);
    echo "<script>window.location.href = '../index.php?page=View_details';</script>";

?>