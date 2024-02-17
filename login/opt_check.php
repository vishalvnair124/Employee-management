<?php
include '../common/connection.php';
$id=$_COOKIE['theempid'];
$passc=$_COOKIE['theemppass'];
$opt=$_POST['opt'];
if (password_verify($opt, $passc)) {
    echo 1;
} else {
    echo 0;
}


?>