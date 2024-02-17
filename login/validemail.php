<?php
include '../common/connection.php';
$email=$_POST['input'];
$email="SELECT Emp_email FROM employee_details WHERE Emp_email='$email'";
$query=$con->query($email);
if($query->num_rows>0)
{
    $data=$query->fetch_assoc();
    echo 1;
}
else
{
    echo 0;
}
?>