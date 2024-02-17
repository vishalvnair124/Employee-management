<?php
  include 'session_check.php';
  include '../common/connection.php';
if(isset($_POST['Mobile']))
{
    $moblie_no=$_POST['Mobile'];
    $moblie_sql="SELECT Emp_mobileno FROM `employee_details` WHERE Emp_mobileno='$moblie_no'";//checking the mobile number already exist or not
    $moblie_no=$con->query($moblie_sql)->num_rows;
}
else
{
    $moblie_no= 404;
}
if(isset($_POST['Email']))
{
    $emailid=$_POST['Email'];
    $email_sql="SELECT Emp_email FROM employee_details WHERE Emp_email='$emailid'";//checking the email already exist or not
    $emailid=$con->query($email_sql)->num_rows;
}
else
{
    $emailid= 404;
}
$response = $emailid . ',' . $moblie_no;
echo $response;
?>
