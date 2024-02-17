<?php
//checking the mobile number and email already exist in the database
  include '../session_check.php';
  include '../../common/connection.php';
if(isset($_POST['Mobile']))
{
    $moblie_no=$_POST['Mobile'];
    if(isset($_POST['Empid']))
    {
        $theid=$_POST['Empid'];
        $moblie_sql="SELECT Emp_mobileno FROM `employee_details` WHERE Emp_mobileno='$moblie_no' AND Emp_id!='$theid'";
    }
    else
    {
        $moblie_sql="SELECT Emp_mobileno FROM `employee_details` WHERE Emp_mobileno='$moblie_no'";
    }
    $moblie_no=$con->query($moblie_sql)->num_rows;
}
else
{
    $moblie_no= 404;
}
if(isset($_POST['Email']))
{
    $emailid=$_POST['Email'];
    if(isset($_POST['Empid']))
    {
        $theid=$_POST['Empid'];
        $email_sql="SELECT Emp_email FROM employee_details WHERE Emp_email='$emailid' AND Emp_id!='$theid'";
    }
    else
    {
        $email_sql="SELECT Emp_email FROM employee_details WHERE Emp_email='$emailid'";
    }
    $emailid=$con->query($email_sql)->num_rows;
}
else
{
    $emailid= 404;
}
$response = $emailid . ',' . $moblie_no;
echo $response;
?>
