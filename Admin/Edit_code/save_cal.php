<?php
//creating the calender for company calender
include 'session_check.php';
$monthco = array(0, 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
if(isset($_POST['save_cal'])){
    $year = $_POST['year'];
    for($i = 1; $i <=12; $i++){
        if($i<10)
        {
            $monthid=$year.'0'.$i;
        }
        else
        {
            $monthid= $year.$i;
        }
        $cale="SELECT * FROM company_calender WHERE Month_id='$monthid'";
        $query2 = $con->query($cale);
        if($query2->num_rows==0)
        {
            if (($year % 4 == 0 && $year % 100 != 0) || ($year % 400 == 0)) {
                $monthco[2]=29;
                }
            else {
                $monthco[2]=28;
            }
            $daysval=$monthco[intval($i)];
            $sql="INSERT INTO company_calender(Month_id,Year, Month, Working_day) VALUES ('$monthid','$year','$i','$daysval')";
            $con->query($sql);
        }
    }
   echo "<script>window.location.href = '?page=calendar';</script>";
}
?>