<?php
//generating the monthly attendance of all employee
include 'session_check.php';
    if(isset($_GET["year"]))
    {
        $year=$_GET['year'];
        $month=$_GET['month'];
        $date=$year."-".$month;
        $monthid=$year.$month;
        $empdata="SELECT * FROM employee_details WHERE DATE_FORMAT(Emp_DOJ, '%Y%m')<='$monthid' AND Emp_status='1'";
        $empdbdata=$con->query($empdata);
        while($emp=$empdbdata->fetch_array())
        {
            $empid=$emp['Emp_id'];
            $datecheck="SELECT DISTINCT DA.*, 
                (SELECT MAX(TIME(EL_sub.Time_date)) 
                FROM emp_logs EL_sub 
                WHERE det.RF_id = EL_sub.RF_id 
                AND DATE(EL_sub.Time_date) = DA.Att_date) AS max_time
                FROM daily_attendance DA
                INNER JOIN employee_details det ON DA.Emp_id = det.Emp_id
                LEFT JOIN holidays H ON DAY(DA.Att_date) = H.day AND H.Month_id = '$monthid'
                LEFT JOIN emp_logs EL ON det.RF_id = EL.RF_id AND DATE(EL.Time_date) = DA.Att_date
                WHERE DA.Att_date LIKE '$date%'
                AND DA.Emp_id = '$empid'
                AND DA.Att_status = 1
                AND H.day IS NULL
                AND EL.Rf_id IS NOT NULL;";
            $data=$con->query($datecheck);

            $dec_id=$emp['Desc_id'];
            $descforempquery=$con->query("SELECT * FROM designation_for_employee WHERE Emp_id='$empid' ");
            if($descforempquery->num_rows> 0)
            {
                $ir=0;
                while($for_dec_data=$descforempquery->fetch_assoc())
                {
                    $desc_from_date = $for_dec_data["Desc_from_date"];
                    $desc_to_date = $for_dec_data["Desc_to_date"];
                    if($desc_from_date<=$monthid && $desc_to_date>=$monthid)
                    {
                        $dec_id=$for_dec_data["Desc_id"];
                        $ir=1;
                    }
                }
                if($ir!=1)
                {
                    $dec_id= 0;
                }
            } 
            else
            {
                $dec_id= 0;
            }
            $dec="SELECT Desc_overtimesalary FROM employee_designation WHERE Desc_id='$dec_id'";
            $desdata=$con->query($dec);
            $des_os=$desdata->fetch_array();
            $Oversalary=$des_os["Desc_overtimesalary"];
            $monthlydata="SELECT * FROM monthly_attendance WHERE Emp_id='$empid' AND Month_id='$monthid'";
            $monthcheck=$con->query($monthlydata);

            if($data->num_rows > 0)
            {
                $hours1=0;
                $hours2=0;
                $count=0;
                while($row = $data->fetch_assoc())
                {
                    $hours1+=$row['Working_hour'];
                    $d1= new DateTime("19:00:00");//converting time for calculation
                    $d2= new DateTime($row['max_time']);//converting time for calculation
                    if($d2>$d1)
                    {
                        $diffdata=$d1->diff($d2);
                        if($diffdata->format('%h')> 0)
                        {
                            $hours2+=$diffdata->format('%h');
                        }
                                    
                    }
                    
                }
                $normalhours=$hours1;
                $overhours=$hours2;
                if($monthcheck->num_rows>0)
                {
                    $insert_mo="UPDATE monthly_attendance SET Normal_work_hr='$normalhours' WHERE Emp_id='$empid' AND  Month_id='$monthid'";
                    $insert_ov="UPDATE overtime_details SET Overtime_hrs='$overhours' , Overtime_salary='$Oversalary' WHERE Emp_id='$empid' AND  Month_id='$monthid'";
                }
                else
                {
                    $insert_mo="INSERT INTO monthly_attendance(Emp_id, Month_id, Normal_work_hr) VALUES ('$empid','$monthid','$normalhours')";
                    $insert_ov="INSERT INTO overtime_details(Emp_id, Month_id, Overtime_hrs, Overtime_salary) VALUES ('$empid','$monthid','$overhours','$Oversalary')";
                }
            }
            else
            {
                if($monthcheck->num_rows>0)
                {
                    $insert_mo="UPDATE monthly_attendance SET Normal_work_hr=0 WHERE Emp_id='$empid' AND  Month_id='$monthid'";
                    $insert_ov="UPDATE overtime_details SET Overtime_hrs=0, Overtime_salary=0  WHERE Emp_id='$empid' AND  Month_id='$monthid'";
                }
                else
                {
                    $insert_mo="INSERT INTO monthly_attendance(Emp_id, Month_id, Normal_work_hr) VALUES ('$empid','$monthid','0')";
                    $insert_ov="INSERT INTO overtime_details(Emp_id, Month_id, Overtime_hrs, Overtime_salary) VALUES ('$empid','$monthid','0','$Oversalary')";
                }
            }
           $con->query($insert_mo);
            $con->query($insert_ov);

        }
        echo "<script>window.location.href = '?page=Monthly_attendance&date=$date';</script>";
        
    }
?>