<?php
//To control the pages that the admin request to visit
include 'session_check.php';
    if(isset($_GET["id"]))
    {
        $_SESSION['detailid']=$_GET["id"];
        $page=$_GET["pageto"];
        
        if($page== 1)
        {
            echo "<script>window.location.href = '?page=View_details';</script>";
        }
        else
        {
            if($page== 2)
            {
                echo "<script>window.location.href = '?page=payroll_details';</script>";
            }
        }
    }
?>