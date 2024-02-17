<?php
//deleting a designation
include 'session_check.php';
include '../common/connection.php';
    $data=$_GET['id'];
    $update="UPDATE employee_designation SET Desc_status=2 WHERE Desc_id='$data'";
    $con->query($update);
    echo "<script>window.location.href = 'Index.php?page=Designations';</script>";
?>
