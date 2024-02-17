<?php
//'Pay the bill' button request responds
include 'session_check.php';
include '../common/connection.php';
    $month_id=$_GET['id'];
    $payquery="UPDATE salary_paid SET Salary_status='1' WHERE Month_id='$month_id'";
    $con->query($payquery);
    echo "<script>window.location.href = '?page=Payrolls&date=$month_id';</script>";

?>