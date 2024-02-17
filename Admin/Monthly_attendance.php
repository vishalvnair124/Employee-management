<?php
//page to view the monthly details of all employees
include 'session_check.php';
  include '../common/connection.php';
  $monthar=array("","January","February","March","April","May","June","July","August","September","October","November","December");
  $monthco = array(0, 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
  if(isset($_SESSION['month_id'])){
    $date = $_SESSION['month_id'];
    $month = substr($date, 4, 2);
    $Year = substr($date, 0, 4);
  }
  else{
    $Year = date('Y');
    $month = date('m');
  }
  ?>
<script>
const liview = document.querySelector('.icon');
const liviewicon = document.querySelector('.sub_tree');
liview.classList.add('active');
liviewicon.classList.add('active');
</script>
<div class="Attendance_M">
    <div style="z-index:1;" class="head">
        <form method="post" style="order:3;">
            <input style="border-radius:20px;" value="<?php
            if(isset($_POST['month_date']))
            {
                $date=$_POST['month_date'];
                list($Year,$month) = explode('-', $date);
            }
            $m_id=$Year.$month;
            $_SESSION['month_id']=$m_id;
            echo $Year."-".$month;
        ?>" type="month" onchange="this.form.submit()" name="month_date" required>
        </form>
        <h2 style="order:2;">Monthly Attendance</h2>
        <?php echo "<a style='order:1;' href='?page=generate_month_att&year=$Year&month=$month'><button style='width:70px;'>Generate</button></a>"; ?>
    </div>
    <div class="Monthly_att">
        <div class="Monthly_att_sub">
            <table>
                <thead>
                    <th>SI</th>
                    <th>Employee ID</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Worked hrs</th>
                    <th>Overtime hrs</th>
                    <th>Total working hrs</th>
                </thead>
                <tbody>
                    <?php

                    $sql = "SELECT employee_details.*,monthly_attendance.*,overtime_details.* FROM employee_details 
                    INNER JOIN monthly_attendance ON employee_details.Emp_id = monthly_attendance.Emp_id 
                    INNER JOIN overtime_details ON monthly_attendance.Month_id = overtime_details.Month_id  AND employee_details.Emp_id = overtime_details.Emp_id
                    WHERE employee_details.Emp_status=1 AND monthly_attendance.Month_id='$m_id' ORDER BY CAST(SUBSTRING(employee_details.Emp_id, 2) AS UNSIGNED)";
                    $cale="SELECT * FROM company_calender WHERE Month_id='$m_id'";
                    $query = $con->query($sql);
                    $query2 = $con->query($cale);
                    if($query2->num_rows==0)
                    {
                      if (($Year % 4 == 0 && $Year % 100 != 0) || ($Year % 400 == 0)) {
                        $monthco[2]=29;
                      }
                      $daysval=$monthco[intval($month)];
                      $sqlin="INSERT INTO company_calender(Month_id,Year, Month, Working_day) VALUES ('$m_id','$Year','$month','$daysval')";
                      $con->query($sqlin);
                      $cale="SELECT * FROM company_calender WHERE Month_id='$m_id'";
                      $query2 = $con->query($cale);
                    }
                    $calender=$query2->fetch_assoc();
                    if($query->num_rows>0)
                    {
                      $count=$query->num_rows;
                      $i=1;
                      $no = intval($month);
                    while($row = $query->fetch_assoc()){
                      ?>
                    <tr style="opacity: 0; z-index:0;" id="<?php echo $i; ?>">
                        <td><?php echo $i; $i++;?></td>
                        <td><?php echo $row['Emp_id']; ?></td>
                        <td><img style="border-radius: 50%; object-fit: cover; width:45px; height:45px;"
                                src="<?php echo (!empty($row['Emp_Photo']))? '../images/'.$row['Emp_Photo']:'../images/profile.jpg'; ?>"
                                width="30px" height="30px"> </td>
                        <td><?php echo $row['Emp_name'];?></td>
                        <td><?php echo (!empty($row['Normal_work_hr']))?$row['Normal_work_hr']."hrs":"---" ?></td>
                        <td><?php echo (!empty($row['Overtime_hrs']))?$row['Overtime_hrs']."hrs":"---" ?></td>
                        <td><?php echo $calender['Working_day']*8;echo"hrs" ?></td>
                    </tr>
                    <?php
                    }
                  }
                  else
                  {
                    ?>
                    <tr>
                        <td colspan="8">NO Data</td>
                    </tr>
                    <?php
                  }
                  ?>
                </tbody>
            </table>
            <script>
            trans();

            function trans() {
                for (var i = 1; i <= <?php echo $count; ?>; i++) {
                    var row = document.getElementById(i);
                    row.style.transform = "rotateX(90deg)";
                }
                for (var i = 1; i <= <?php echo $count; ?>; i++) {
                    setTimeout(function(i) {
                        var row = document.getElementById(i);
                        if (row) {
                            row.style.opacity = "1";
                            for (var p = 90; p >= 0; p--) {
                                setTimeout(function(p) {
                                    if (row) {
                                        row.style.transform = 'rotateX(' + p + 'deg)';
                                    }
                                }, (90 - p) * 1.5, p);
                            }
                        }
                    }, i * 100, i);
                }

            }
            </script>
        </div>
    </div>
</div>