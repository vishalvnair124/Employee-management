<?php
//page to view the daily attendance of all employee
include 'session_check.php';
  include '../common/connection.php';
  $Year = date('Y');
  $month = date('m');
  $day= date('d');
  if(isset( $_SESSION['datevalue']))
  {
    $value= $_SESSION['datevalue'];
  }
  else
  {
    $value=$Year."-".$month."-".$day;
  }
  $thmonth = str_replace("-", "", $value);
  $themonth_id = substr($thmonth, 0, 6);
  ?>
<script>
const liview = document.querySelector('.icon');
const liviewicon = document.querySelector('.sub_tree');
liview.classList.add('active');
liviewicon.classList.add('active');
</script>
<div class="Attendance">
    <div class="thefulldivatt">
        <div class="loading2">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
            <h2>Calculating...</h2>
        </div>
    </div>
    <div style="z-index:1;" class="head">
        <form method="post">
            <input style="border-radius:20px;" onchange="this.form.submit()" value="<?php
            if(isset($_POST['daily_date']))
            {
                $daily_date=$_POST['daily_date'];
                $tday=$daily_date;
                echo $daily_date;
            }
            else
            {
                $daily_date=$value;
                $tday=$daily_date;
                echo $daily_date;
            }
            $_SESSION['month_id']=substr($daily_date, 0, 4).substr($daily_date, 5, 2);

        ?>" type="date" name="daily_date" required>
        </form>
        <h2>Daily Attendance</h2>
        <?php echo "<a onclick='loadthebar()' href='?page=dailyadd&date=$tday'><button style='width:70px;'>Generate</button></a>"; ?>
    </div>
    <div class="Daily_att">
        <script>
        const loading = document.querySelector('.loading2');
        const areyou = document.querySelector('.thefulldivatt');

        function loadthebar() {

            if (loading.classList.contains('active')) {
                areyou.classList.remove('active');
                loading.classList.remove('active');
            } else {
                areyou.classList.add('active');
                loading.classList.add('active');
            }
        }
        </script>
        <div class="Daily_att_sub">
            <table>
                <thead>
                    <th>SI</th>
                    <th>Employee ID</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Worked hours</th>
                    <th>Overtime hours</th>
                    <th>STATUS</th>
                </thead>
                <tbody>
                    <?php
                    $thmonth = str_replace("-", "", $daily_date);
                    $themonth_id = substr($thmonth, 0, 6);
                    $day=substr($thmonth, 6, 2);
                    $day = intval($day);
                    $holidayquery="SELECT * FROM holidays WHERE Month_id='$themonth_id' AND day='$day'";
                    $holi=$con->query($holidayquery)->num_rows;
                    if($holi> 0)
                    {
                        echo "<tr><td colspan='8' style='background-color: red; color:white;font-size:30px;'>HOLIDAY</td></tr>";
                    }
                    else
                    {
                    }
                      ?>
                    <div class="sample_data2">
                        <div class="box">
                            <div class="bodypart">
                                <?php
                $sql = "SELECT * FROM daily_attendance WHERE Att_date='$daily_date'";
                $query = $con->query($sql);
                $total=$query->num_rows;
                $sql = "SELECT * FROM daily_attendance WHERE Att_date='$daily_date' AND Att_status=1;";
                $query = $con->query($sql);
                $present = $query->num_rows;
                $absent=$total-$present;
                if($present>0)
                {
                  $percentage = number_format(($present/$total)*100,2);
                }
                else
                {
                  $percentage = 0.00;
                }
              ?>
                                <h3 id='abcd'>0</h3>

                                <p>Total Employees</p>
                            </div>
                        </div>
                        <div class="box">
                            <div class="bodypart">
                                <div
                                    style=" margin-top:10px; width:100%; height:35px;display:flex; flex-direction: row; justify-content:center; align-item:center;">
                                    <h3 style="font-size:30px; margin-top:0px;" id="pers">0.00</h3><sup
                                        style='font-size: 20px;'>%</sup>
                                </div>
                                <p>Present Percentage</p>
                            </div>
                        </div>
                        <div class="box">
                            <div class="bodypart">
                                <h3 id="presents">0</h3>
                                <p>Total Presents</p>
                            </div>
                        </div>
                        <div class="box">
                            <div class="bodypart">
                                <h3 id="absents">0</h3>
                                <p>Total Absents</p>
                            </div>
                        </div>

                    </div>
                    <script>
                        thespeed=0;
                    function callassemble() {
                        thespeed=100-<?php echo $percentage; ?>;
                        autoin1();
                        autoin2();
                        autoin3();
                        autoin4();
                    }
                    window.onload = function() {
                        setTimeout(callassemble, 900);
                    };

                    function autoin1() {
                        var j = 1;
                        var anotherH1Element = document.getElementById('abcd');

                        function updateAnotherValue2() {
                            if (j <= <?php echo $total; ?>) {
                                anotherH1Element.innerHTML = j;
                                j++;
                                setTimeout(updateAnotherValue2, 50);
                            }
                        }

                        updateAnotherValue2();
                    }
                    var min = 10;
                    var max = 99;

                    function autoin2() {
                        var j = 0;

                        var anotherH1Element = document.getElementById('pers');

                        function updateAnotherValue1() {
                            if (j <= <?php echo $percentage; ?>) {
                                var randomNum = Math.floor(Math.random() * (max - min + 1)) + min;
                                anotherH1Element.innerHTML = j + '.' + randomNum;
                                j++;
                                setTimeout(updateAnotherValue1, thespeed);
                            } else {
                                if (<?php echo $percentage; ?> == 0) {
                                    anotherH1Element.innerHTML = '0.00';
                                } else {
                                    anotherH1Element.innerHTML = <?php echo $percentage; ?>;
                                }
                            }
                        }

                        updateAnotherValue1();
                    }

                    function autoin3() {
                        var j = 1;
                        var anotherH1Element = document.getElementById('presents');

                        function updateAnotherValue2() {
                            if (j <= <?php echo $present; ?>) {
                                anotherH1Element.innerHTML = j;
                                j++;
                                setTimeout(updateAnotherValue2, 80);
                            }
                        }

                        updateAnotherValue2();
                    }

                    function autoin4() {
                        var j = 1;
                        var anotherH1Element = document.getElementById('absents');

                        function updateAnotherValue3() {
                            if (j <= <?php echo $absent; ?>) {
                                anotherH1Element.innerHTML = j;
                                j++;
                                setTimeout(updateAnotherValue3, 100);
                            }
                        }

                        updateAnotherValue3();
                    }
                    </script>
                    <?php
                      $sql = "SELECT employee_details.*, daily_attendance.*, MAX(TIME(emp_logs.Time_date)) AS max_time_date
                      FROM employee_details
                      INNER JOIN daily_attendance ON employee_details.Emp_id = daily_attendance.Emp_id
                      LEFT JOIN emp_logs ON employee_details.Rf_id = emp_logs.Rf_id AND DATE(emp_logs.Time_date) = daily_attendance.Att_date
                      WHERE employee_details.Emp_status = 1 AND daily_attendance.Att_date = '$daily_date'
                      GROUP BY employee_details.Emp_id, daily_attendance.Att_id
                      ORDER BY CAST(SUBSTRING(employee_details.Emp_id, 2) AS UNSIGNED);
                      ";
                    $query = $con->query($sql);
                    if($query->num_rows>0)
                    {
                      $count=$query->num_rows;
                      $i=1;
                    while($row = $query->fetch_assoc()){
                        if($row['Working_hour']>0)
                        {
                            $workhrs=$row['Working_hour'];
                            $workhrs=$workhrs."hrs";
                            if($row['max_time_date']!=NULL)
                            {
                                $d1= new DateTime("19:00:00");
                                $d2= new DateTime($row['max_time_date']);
                                if($d2>$d1)
                                {
                                    $diffdata=$d1->diff($d2);
                                    if($diffdata->format('%h')> 0)
                                    {
                                        $over=$diffdata->format('%h')."hrs";
                                    }
                                    else
                                    {
                                        $over="---";
                                    }
                                    
                                }
                                else
                                {
                                    $over="---";
                                }
                            }
                            else
                            {
                                $over="---";
                            }
                        }
                        else
                        {
                            $workhrs="---";
                            $over="---";
                        }
                        
                      ?>
                    <tr style="opacity: 0; z-index:0;" id="<?php echo $i; ?>">
                        <td><?php echo $i; $i++;?></td>
                        <td><?php echo $row['Emp_id']; ?></td>
                        <td><img style="border-radius: 50%; object-fit: cover; width:45px; height:45px;"
                                src="<?php echo (!empty($row['Emp_Photo']))? '../images/'.$row['Emp_Photo']:'../images/profile.jpg'; ?>"
                                width="30px" height="30px"> </td>
                        <td><?php echo $row['Emp_name'];?></td>
                        <td><?php echo $workhrs; ?></td>
                        <td><?php echo $over;?></td>
                        <td><?php echo ($row['Att_status']==1)? "<p style='color: green;'>PRESENT</p>":"<p style='color: red; font-weigth:none;'>ABSENT</p>"; ?>
                        </td>
                    </tr>

                    <?php
                    }
                  }
                  else
                  {
                      echo "<tr><td colspan='8'>No Data</td></tr>";
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