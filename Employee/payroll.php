<div class="per_Payrolls">
    <?php    include 'session_check.php';
    include '../common/connection.php';
    $monthar=array("","January","February","March","April","May","June","July","August","September","October","November","December");
    $id=$_SESSION['Emp_id'];
    $year=date('Y');
    $calend1="SELECT MAX(Month_id) as topdate, MIN(Month_id) as botdate FROM company_calender ";//getting the max and min from the compaany calender
    $caldata=$con->query($calend1)->fetch_assoc();
    $string1 = $caldata["topdate"];
    $string2 = $caldata["botdate"];
    $theupdate = substr($string1, 0, 4);
    $thedowdate = substr($string2, 0, 4);
    ?>
    <div class="head">
        <div></div>
        <h2>Payrolls Details</h2>
        <form method="post">
        <select style="border-radius:20px;" onchange="this.form.submit()" name="date" id="">
              <?php
              if(isset($_POST["date"]))
              {
                $year=$_POST["date"];
              }
                for($j= $thedowdate;$j<=$theupdate;$j++)//print he years available
                {
                  if($year==$j)
                  {
                    echo "<option selected value='$j'>$j</option>";
                  }
                  else
                  {
                    echo "<option value='$j'>$j</option>";
                  }
                  
                }
              ?>
            </select>
        </form>
    </div>
    <div class="payrolls_details">
        <div class="payrolls_details_sub">
            <table >
                <thead style="background-color: white;">
                  <th>Month</th>
                  <th>Designation</th>
                  <th>Designation Salary</th>
                  <th>Worked hrs</th>
                  <th>Basic Salary</th>
                  <th>Overtime Worked</th>
                  <th>Total Salary</th>
                  <th>Status</th>
                  <th>Tools</th>
                </thead>
                <tbody >
                  <?php
                    $sql = "SELECT employee_designation.*, salary_paid.*, overtime_details.*
                    FROM salary_paid
                    INNER JOIN employee_designation ON employee_designation.Desc_id = salary_paid.Desc_id
                    INNER JOIN overtime_details ON salary_paid.Emp_id = overtime_details.Emp_id AND salary_paid.Month_id = overtime_details.Month_id
                    WHERE salary_paid.Emp_id = '$id' AND salary_paid.Month_id LIKE '$year%';";
                    $query = $con->query($sql);
                    if($query->num_rows > 0)
                    {
                      $i=1;
                    while($row = $query->fetch_assoc()){
                        $monthdata = substr($row['Month_id'], 4, 2);
                        $monthdata = intval($monthdata);
                        if($row['Salary_basic']>0)//checking the salary
                        {
                            echo "<tr style='font-size:17px; opacity: 0; z-index:0;' id='$i'>";
                            $st="green";
                        }
                        else
                        {
                            echo "<tr style='background-color: darkred; font-size:17px; color:white;border: 2px solid white;opacity: 0; z-index:0;' id='$i'>";
                            $st="lightgreen";
                        }
                      ?>
                        
                            <td><?php echo $year." ".$monthar[$monthdata];  ?></td>
                            <td><?php echo $row['Desc_name']; ?></td>
                            <td><?php echo "₹".number_format($row['Desc_basic']);?></td>
                            <td><?php echo ($row['Salary_basic']!=0)? $row['Working_hour']:0 ?>hr</td>
                            <td><?php echo "₹".number_format($row['Salary_basic']); ?></td>
                            <td><?php echo ($row['Salary_basic']!=0)? $row['Overtime_hrs']:0 ?>hr</td>
                            <td><?php echo "₹".number_format($row['Total_salary']); ?></td>
                            <td><?php echo ($row['Salary_status']==1)? "<p style='color: $st;'>PAID</p>":"<p style='color: red; font-weigth:none;'>PENDING</p>"; ?></td>
                            <td>
                          <?php $month=$row['Month_id'];  echo "<a href='?page=per_payroll&check=$month'><button class='view-emp' >View Details</button></a>" ?>                            
                          </td>
                        </tr>
                      <?php
                      $i++;
                    }
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
              //table abimation
                for (var i = 1; i < <?php echo $count; ?>; i++) {
                  
                    var row = document.getElementById(i);
                    row.style.transform = "rotateX(90deg)";
                }
                for (var i = 1; i < <?php echo $count; ?>; i++) {
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