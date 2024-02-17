<?php
//generating the monthly payroll of all employee
include 'session_check.php';
    if(isset($_GET["mid"]))
    {
        $monthid=$_GET["mid"];
        $empdata="SELECT * FROM employee_details WHERE Emp_status=1 AND Emp_id  NOT LIKE 'U%' AND DATE_FORMAT(Emp_DOJ, '%Y%m')<='$monthid'";
        $empdbdata=$con->query($empdata);
        $calender_sql="SELECT * FROM company_calender WHERE Month_id='$monthid'";
        $cal_query=$con->query($calender_sql);
        $cal_day=$cal_query->fetch_assoc();
        $cal_value=$cal_day["Working_day"];
        while($emp=$empdbdata->fetch_assoc())
        {
            $empid=$emp["Emp_id"];
            $descforempquery=$con->query("SELECT * FROM designation_for_employee WHERE Emp_id='$empid'");
            if($descforempquery->num_rows> 0)
            {
                $ir=0;
                while($for_dec_data=$descforempquery->fetch_assoc())
                {
                    $desc_from_date =$for_dec_data["Desc_from_date"];
                    $desc_to_date = $for_dec_data["Desc_to_date"];
                    if($desc_from_date<=$monthid && $desc_to_date>=$monthid)
                    {
                        $descid=$for_dec_data["Desc_id"];
                        $ir=1;
                    }
                }
                if($ir!=1)
                {
                    $descid= 0;
                }
            } 
            else
            {
                $descid= 0;
            }
            $monthly_att_sql="SELECT ma.*, od.*
            FROM monthly_attendance AS ma
            LEFT JOIN overtime_details AS od
            ON ma.Emp_id = od.Emp_id AND ma.Month_id = od.Month_id
            WHERE ma.Emp_id = '$empid' AND ma.Month_id = '$monthid';";
            $monthly_att_result=$con->query($monthly_att_sql);
            if( $monthly_att_result->num_rows> 0)
            {
                $monthly_data=$monthly_att_result->fetch_assoc();
                $workhr=$monthly_data["Normal_work_hr"];
                if($monthly_data['Overtime_hrs']>4)
                {
                    $ov_salary=$monthly_data['Overtime_salary']*4;
                }
                else
                {
                    $ov_salary=$monthly_data['Overtime_hrs']*$monthly_data['Overtime_salary'];
                }
                
                $emp_desc_query=$con->query("SELECT * FROM employee_designation WHERE Desc_id='$descid'");
                $emp_desc=$emp_desc_query->fetch_assoc();
                $salarybasic=$emp_desc["Desc_basic"];
                $salaryda=$emp_desc["Desc_da"];
                $salaryma=$emp_desc["Desc_ma"];
                $salarypf=$emp_desc["Desc_pf"];
                    if($workhr<=(($cal_value-2)*8))
                {
                    $hour_salary=$salarybasic/($cal_value*8);
                    $month_basic=$workhr*$hour_salary;
                    $month_basic = (int)$month_basic;
                }
                else
                {
                    $month_basic=$salarybasic;
                }
                $month_total=($month_basic+$salaryda+$salaryma)-$salarypf;
                if($month_total<=0)
                {
                    $month_total= 0;
                }
                else
                {
                    $month_total=$month_total+$ov_salary;
                }
                $bonus="SELECT Bonus_salary FROM bonus_salary WHERE Emp_id='$empid' AND Month_id='$monthid' "; 
                $bonusquery=$con->query($bonus);
                if($bonusquery->num_rows>0)
                {
                    while($bonusdata=$bonusquery->fetch_assoc())
                    {
                        $month_total=$month_total+$bonusdata['Bonus_salary'];
                    }
                }
                $check_salary_sql="SELECT * FROM salary_paid WHERE Emp_id='$empid' AND Month_id='$monthid'";
                $check_salary_query=$con->query($check_salary_sql);
                
                if($check_salary_query->num_rows > 0)
                {
                    $salary_insert="UPDATE salary_paid SET Desc_id='$descid', Salary_basic = '$month_basic', Salary_da = '$salaryda', Salary_ma = '$salaryma', Salary_pf = '$salarypf', Working_hour = '$workhr', Total_salary = '$month_total' WHERE Emp_id = '$empid' AND Month_id = '$monthid';";
                }
                else
                {
                    $salary_insert="INSERT INTO salary_paid (Emp_id, Desc_id, Month_id, Salary_basic, Salary_da, Salary_ma, Salary_pf, Salary_status, Working_hour, Total_salary) VALUES ('$empid','$descid','$monthid','$month_basic','$salaryda','$salaryma','$salarypf',0,'$workhr','$month_total')";
                }
                $con->query($salary_insert);
            }
            else{
                echo "<script>alert('Monthly attendance not found')</script>";
                echo "<script>window.location.href = '?page=Monthly_attendance';</script>";
            }
            
        }
        echo "<script>window.location.href = '?page=Payrolls';</script>";
    }
?>