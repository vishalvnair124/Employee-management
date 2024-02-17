<?php
//creating a new designation
include 'session_check.php';
                include '../common/connection.php';
            	if(isset($_POST['save_desc'])){
                    $descid = $_POST['Descid'];
                    $descname = $_POST['descname'];
                    $salary = $_POST['salary'];
                    $OVsalary = $_POST['over_salary'];
                    $da = $_POST['da'];
                    $ma = $_POST['ma'];
                    $pf = $_POST['pf'];
                    $sql = "INSERT INTO employee_designation (Desc_id, Desc_name, Desc_basic,Desc_overtimesalary, Desc_da, Desc_ma, Desc_pf, Desc_status) VALUES ('$descid','$descname','$salary','$OVsalary','$da','$ma','$pf',1)";
                    $con->query($sql);
                    echo "<script>window.location.href = '?page=Designations';</script>";
                }

?>
            