<?php
//deleting an allowance
include 'session_check.php';
include '../common/connection.php';
$theid=$_GET['bid'];
$monthid=$_SESSION['m_id'];
$drop="DELETE FROM bonus_salary WHERE Bonus_id='$theid'"; 
$con->query($drop);
echo "<script>window.location.href = '?page=Bonus_details&mid=$monthid';</script>";
?>