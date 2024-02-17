<?php
//page to view the payroll of all employee
include 'session_check.php';
  include '../common/connection.php';
  if(isset($_SESSION['month_id'])){
    $date = $_SESSION['month_id'];
    $month = substr($date, 4, 2);
    $Year = substr($date, 0, 4);
  }else{
    $Year = date('Y');
    $month = date('m');
  }
  unset($_SESSION['cat']);
  $monthco = array(0, 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
  ?>
<div class="Payrolls">
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

        <h2 style="order:2;">Payrolls Details</h2>
        <div style='order:1;' >
        <?php echo "<a  href='?page=generate_payroll&mid=$m_id'><button style='width:70px;'>Generate</button></a>" ?>
        <?php echo "<a style='margin-left:-10px;  ' href='?page=Bonus_details&mid=$m_id'><button style='width:70px;'>Allowance</button></a>" ?>
        </div>
        
    </div>
    <div class="payrolls_details">
        <div class="payrolls_details_sub">
            <table>
                <thead>
                    <th>Employee ID</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Basic Salary</th>
                    <th>Worked hrs</th>
                    <th>Overtime Worked</th>
                    <th>Total Salary</th>
                    <th>Status</th>
                    <th>Tools</th>
                </thead>
                <tbody>
                    <?php
                    $cale="SELECT * FROM company_calender WHERE Month_id='$m_id'";
                    $query2 = $con->query($cale);
                    if($query2->num_rows==0)
                    {
                      if (($Year % 4 == 0 && $Year % 100 != 0) || ($Year % 400 == 0)) {
                        $monthco[2]=29;
                      }
                      $daysval=$monthco[intval($month)];
                      $sqlin="INSERT INTO company_calender(Month_id,Year, Month, Working_day) VALUES ('$m_id','$Year','$month','$daysval')";
                      $con->query($sqlin);
                    }

                    $sql = "SELECT DISTINCT employee_details.Emp_id, employee_details.Emp_Photo, employee_details.Emp_name, salary_paid.*, overtime_details.*, employee_designation.*
                    FROM employee_details
                    INNER JOIN salary_paid ON employee_details.Emp_id = salary_paid.Emp_id
                    INNER JOIN employee_designation ON salary_paid.Desc_id = employee_designation.Desc_id
                    INNER JOIN overtime_details ON employee_details.Emp_id = overtime_details.Emp_id
                    AND salary_paid.Month_id = overtime_details.Month_id
                    AND salary_paid.Emp_id = overtime_details.Emp_id
                    WHERE employee_details.Emp_status = 1 AND salary_paid.Month_id = '$m_id'
                    ORDER BY CAST(SUBSTRING(employee_details.Emp_id, 2) AS UNSIGNED);";
                    $query = $con->query($sql);
                    if($query->num_rows > 0)
                    {
                      $i=1;
                    while($row = $query->fetch_assoc()){
                      ?>
                    <tr style="opacity: 0; z-index:0;" id="<?php echo $i; ?>">
                        <td><?php echo $row['Emp_id']; ?></td>
                        <td><img style="border-radius: 50%; object-fit: cover; width:45px; height:45px;"
                                src="<?php echo (!empty($row['Emp_Photo']))? '../images/'.$row['Emp_Photo']:'../images/profile.jpg'; ?>"
                                width="30px" height="30px"> </td>
                        <td><?php echo $row['Emp_name']?></td>
                        <td><?php echo $row['Desc_name']; ?></td>
                        <td><?php echo "₹".number_format($row['Salary_basic']); ?></td>
                        <td><?php echo ($row['Salary_basic']!=0)? $row['Working_hour']."hrs":"---" ?></td>
                        <td><?php echo ($row['Salary_basic']!=0)? $row['Overtime_hrs']."hrs":"---"  ?></td>
                        <td><?php echo "₹".number_format($row['Total_salary']); ?></td>
                        <td><?php echo ($row['Salary_status']==1)? "<p style='color: green;'>PAID</p>":"<p style='color: red; font-weigth:none;'>PENDING</p>"; ?>
                        </td>
                        <td>
                            <?php $data=$row['Emp_id']; echo "<a href='?page=page_controller&id=$data&pageto=2'><button class='thebuttons' style='height:30px;width:90px;background-color:slategrey; color:white' >View Details</button></a>"; $i++;?>
                        </td>
                    </tr>
                    <?php
                    }
                    ?><tr style="opacity: 0; z-index:0;" id="<?php echo $i; ?>">
                        <td colspan="10">
                            <?php echo "<a href='?page=paythebill&id=$m_id'><button class='pay'>Pay the Bill</button></a>" ?>
                        </td>
                    </tr><?php
                    $count=$i;
                  }
                  else
                  {
                    ?>
                    <tr>
                        <td colspan="10">
                            NO DATA
                        </td>
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