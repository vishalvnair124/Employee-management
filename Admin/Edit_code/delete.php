

<?php
include 'session_check.php';
include '../common/connection.php';
    $data=$_GET['id'];
    $delete="DELETE FROM employee_details WHERE Emp_id='$data'";
    $con->query($delete);
    echo "<script>window.location.href = 'Index.php?page=Employees';</script>";
?>
