<?php
  include 'session_check.php';
  include '../common/connection.php';
  $currentmonth=date("Y-m");
  $monthid=date("Ym");
  $Year=date("Y");
  $month=date("m");
  $monthvalue=date("n");
  $id=$_SESSION['Emp_id'];
  $monthdays = array(0,31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
  ?>
<div class="EMP_HOME">
    <div style="display: flex; justify-content: space-between; z-index:1;" class="head">
        <div></div>
        <h3>Daily Attendance report </h3>
        <form method="post">
            <input style="border-radius:20px;" value="<?php
            if(isset($_POST['month_date']))//date from the user
            {
                $date=$_POST['month_date'];
                list($Year,$month) = explode('-', $date);//separating the year and month
                $monthvalue=intval($month);
            }
            $monthid=$Year.$month;
            $currentmonth=$Year.'-'.$month;
            echo $Year."-".$month;
            if (($Year % 4 == 0 && $Year % 100 != 0) || $Year % 400 == 0) {//checking the leap year
              $monthdays[2]=29;
          }
          $topdate=  $monthdays[intval($month)];
        ?>" type="month" onchange="this.form.submit()" name="month_date" required>
        </form>

    </div>
    <div class="data1">
        <?php $sqldatacheck="SELECT * FROM daily_attendance WHERE Att_date LIKE '$currentmonth%' AND Emp_id='$id'"; 
        $calendercheck="SELECT * FROM company_calender WHERE Month_id='$monthid'";
        //side box
        if((($con->query($sqldatacheck)->num_rows)>0)&&(($con->query($calendercheck)->num_rows)>0))
        {
        ?>
        <div class="sample_data">
            <div class="box">
                <div class="bodypart">
                    <?php
                        $sql = "SELECT Working_day FROM company_calender WHERE Month_id='$monthid'";
                        $query = $con->query($sql);
                        $calender_data=$query->fetch_assoc();
                        $total_days=$calender_data['Working_day'];
                    ?>
                    <h3 id="wrdays">0</h3>
                    <p>Total Working days</p>
                </div>
                <div class="footerpart">
                    <a href="">More info</a>
                </div>
            </div>
            <div class="box">
                <div class="bodypart">
                    <?php
                    //calculating the number of presents and absents
                        $EMPsql = "SELECT * FROM employee_details WHERE Emp_id='$id';";
                        $empquery = $con->query($EMPsql);
                        $row = $empquery->fetch_assoc();
                        $rf=$row["Rf_id"];
                        $att_sql="SELECT COUNT(*) as Present FROM daily_attendance WHERE Att_date LIKE '$currentmonth%' AND Emp_id='$id' AND Att_status=1";
                        $present = $con->query($att_sql)->fetch_assoc();
                        $percentage = number_format(($present['Present']/$calender_data['Working_day'])*100,2);
                        $presentdata=$present['Present'];
                        $absent=$calender_data['Working_day']-$present['Present'];
                    ?>
                    <div
                        style=" margin-top:10px; width:100%; height:35px;display:flex; flex-direction: row; justify-content:center; align-item:center;">
                        <h3 style="font-size:30px; margin-top:0px;" id="perpre">0.00</h3><sup
                            style='font-size: 20px;'>%</sup>
                    </div>
                    <p>Total Present Percentage</p>
                </div>
                <div class="footerpart">
                    <a href="?page=attendace">More info</a>
                </div>
            </div>
            <div class="box">
                <div class="bodypart">
                    <h3 id="perpresen">0</h3>
                    <p>Total Presents</p>
                </div>
                <div class="footerpart">
                    <a href="?page=attendace">More info</a>
                </div>
            </div>
            <div class="box">
                <div class="bodypart">
                    <h3 id="perabsent">0</h3>
                    <p>Total Absents</p>
                </div>
                <div class="footerpart">
                    <a href="">More info</a>
                </div>
            </div>

        </div>
        <script>
        thespeed = 0;
            //count animations
        function callassemble() {
            thespeed = 100 - <?php echo $percentage; ?>;
            autoin1();
            autoin2();
            autoin3();
            autoin4();
        }
        window.onload = function() {
            setTimeout(callassemble, 800);
        };

        function autoin1() {
            var j = 1;
            var anotherH1Element = document.getElementById('wrdays');

            function updateAnotherValue2() {
                if (j <= <?php echo $total_days; ?>) {
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

            var anotherH1Element = document.getElementById('perpre');

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
            var anotherH1Element = document.getElementById('perpresen');

            function updateAnotherValue2() {
                if (j <= <?php echo $presentdata; ?>) {
                    anotherH1Element.innerHTML = j;
                    j++;
                    setTimeout(updateAnotherValue2, 70);
                }
            }

            updateAnotherValue2();
        }

        function autoin4() {
            var j = 1;
            var anotherH1Element = document.getElementById('perabsent');

            function updateAnotherValue3() {
                if (j <= <?php echo $absent; ?>) {
                    anotherH1Element.innerHTML = j;
                    j++;
                    setTimeout(updateAnotherValue3, 70);
                }
            }

            updateAnotherValue3();
        }
        </script>
        <div class="employee_att">
            <div id="barmenu" style="opacity:0;" class="bar_main">
                <div class="bat_title">
                    <div class="infobar">
                        <div style="background-color:yellow;">
                        </div>
                        <h3>Below normal Working hour</h3>
                    </div>
                    <div class="infobar">
                        <div style="background-color:red;">
                        </div>
                        <h3>Zero hours worked(Absent)</h3>
                    </div>
                    <div class="infobar" style="width:24%;">
                        <div style="background-color:limegreen;">
                        </div>
                        <h3>Normal Working hours completed</h3>
                    </div>
                    <div class="infobar" style="width:12%;">
                        <div style="background-color:lightsalmon;">
                        </div>
                        <h3>Public holiday</h3>
                    </div>
                </div>
                <div class="bar_top">
                    <div class="bar11">
                        <table border='1'>
                            <tbody>
                                <?php $total_days= $topdate; $temphr=10;//garph
                                echo"<tr><td rowspan='11'><div style='transform: rotate(-90deg);'>Hours</div></td><td>$temphr</td></tr>";
                                $temphr--;
                                while($temphr>=0)
                                {

                                    echo"<tr><td>0$temphr</td></tr>";//side hours
                                    $temphr--;
                                }
                                 ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="bar12">
                        <table>
                            <div class="barblur"></div>
                            <tbody>
                                <tr>
                                    <?php $days=1;
                                    echo "<script>let barheights = [];</script>";//to store the height of each bar for animations
                                    while($days<=$total_days)
                                    {
                                        if($days<10)
                                        {
                                            $pri="0".$days;
                                        }
                                        else
                                        {
                                            $pri=$days;
                                        }
                                        $checkdate=$currentmonth."-".$pri;

                                        $sqlbar="SELECT Working_hour FROM daily_attendance WHERE Emp_id='$id' AND Att_date='$checkdate'";
                                        $datahr=$con->query($sqlbar);
                                        if($datahr->num_rows>0)//check holiday or not
                                        {
                                            $valueshr=$datahr->fetch_assoc();
                                            if($valueshr['Working_hour']=='0')//check present or not
                                            {
                                                $hourdata=5;
                                                $colordata="red";
                                            }
                                            else
                                            {
                                                $hourdata=($valueshr['Working_hour']*10);
                                                if($valueshr['Working_hour']==8)//checking the worked overtime
                                                {
                                                    $colordata='limegreen';
                                                    $sqlbarover="SELECT MAX(TIME(Time_date)) as time FROM `emp_logs` 
                                                    INNER JOIN employee_details ON employee_details.Rf_id=emp_logs.Rf_id 
                                                    WHERE DATE(Time_date)='$checkdate' AND employee_details.Emp_id='$id' AND Log_status='OUT'";
                                                    $datahrover=$con->query($sqlbarover);
                                                    $rowch=$datahrover->fetch_assoc();
                                                    if($rowch['time']!=NULL)//time calculation
                                                    {
                                                        $d1= new DateTime("19:00:00");
                                                        $d2= new DateTime($rowch['time']);
                                                        if($d2>$d1)
                                                        {
                                                            $diffdata=$d1->diff($d2);
                                                            if($diffdata->format('%h')> 0)
                                                            {
                                                                $hourdata=$hourdata+($diffdata->format('%h'))*10;
                                                            }
                                    
                                                        }
                                                    }

                                                }
                                                else
                                                {
                                                    $colordata="yellow";
                                                }
                                            }
                                        }
                                        else
                                        {
                                            $hourdata=5;
                                            $colordata="lightsalmon";
                                        }
                                        if($hourdata>=100)
                                        {
                                            $hourdata=100-2;
                                            $ts=10;
                                        }
                                        else
                                        {
                                            $ts=($hourdata==5)?"-- ":$hourdata/10;
                                            $hourdata=$hourdata-2;
                                        }
                                        $ts=(($ts<10)&&($ts!="-- "))?"0".$ts."hrs":$ts."hrs";
                                        echo "<td><div class='thebarmain'><div class='commonbar' id='B$days' style='background-color:$colordata;'><h3>$ts</h3></div></div></td>";
                                        echo "<script>barheights[$days]=$hourdata;</script>";
                                        $days++;
                                    } ?>
                                </tr>
                            </tbody>
                        </table>
                        <script>
                        const commonBars = document.querySelectorAll('.commonbar');
                        const barBlur = document.querySelector('.barblur');
                        //basic view animation
                        commonBars.forEach(commonBar => {
                            commonBar.addEventListener('mouseover', function() {
                                barBlur.style.backdropFilter ='blur(3px)'; 
                            });

                            commonBar.addEventListener('mouseout', function() {
                                barBlur.style.backdropFilter =''; 
                            });
                        });

                        baranime();
                        //bar animation
                        function baranime() {
                            for (var i = 1; i < barheights.length; i++) {
                                setTimeout(function(i) {
                                    var row = document.getElementById('B' + i);
                                    if (row) {
                                        for (var p = 0; p <= barheights[i]; p++) {
                                            setTimeout(function(p) {
                                                if (row) {
                                                    row.style.height = p + '%';
                                                }
                                            }, (100 + p) * 4, p);
                                        }
                                    }
                                }, i * 50, i);
                            }
                        }
                        </script>
                    </div>
                </div>
                <div class="bar_bottom">
                    <div class="bar21"></div>
                    <div class="bar22">
                        <table border='1'>
                            <tbody>
                                <tr>
                                    <?php $days=1;
                                    while($days<=$total_days)//graph x axis
                                    {
                                        if($days<10)
                                        {
                                            $pri="0".$days;
                                        }
                                        else
                                        {
                                            $pri=$days;
                                        }
                                        echo "<td>$pri</td>";
                                        $days++;
                                    } ?>
                                </tr>
                                <tr>
                                    <td colspan='<?php echo $total_days; ?>'>Days</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="att_sub_div1">
                <table id="thetable" style=' border-collapse: collapse;opacity:0; transition: all .3s ease-in-out;'>
                    <thead>
                        <th>SI</th>
                        <th>Date</th>
                        <th>Log in Time</th>
                        <th>Log out Time</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        <?php
                        if($row['Emp_status'] !=1)
                        {
                          echo "<tr><td colspan='7' style='background-color: rgb(192, 19, 19); color:white;font-size:30px;'>SUSPENDED ACCOUNT</td></tr>";
                        }
                    if($empquery->num_rows>0)
                    {
                        $i=1;
                        $p=0;
                        $row = $query->fetch_assoc();
                      ?>
                        <?php
                      for($day= 1;$day<=$monthdays[$monthvalue];$day++)
                      {
                        if($day<10)
                        {
                            $currentdate=$currentmonth."-0".$day;
                        }
                        else
                        {
                            $currentdate=$currentmonth."-".$day;
                        }
                            $monthhliid = str_replace("-", "", $currentmonth);
                            $holidayquet="SELECT * FROM holidays WHERE Month_id='$monthhliid' AND day='$day'";
                            $holiday=$con->query($holidayquet)->num_rows;
                            $select1="SELECT MIN(emp_logs.Time_date) as Time_date
                            FROM emp_logs 
                            LEFT JOIN employee_details ON employee_details.Rf_id = emp_logs.Rf_id
                            LEFT JOIN daily_attendance ON DATE(daily_attendance.Att_date) = DATE(emp_logs.Time_date) AND employee_details.Emp_id = daily_attendance.Emp_id
                            WHERE emp_logs.Rf_id = '$rf' 
                              AND DATE(emp_logs.Time_date) = '$currentdate'  
                              AND emp_logs.Log_status = 'IN'
                              AND daily_attendance.Att_date IS NOT NULL
                            GROUP BY emp_logs.Rf_id;";//query for fetch
                            $IN = $con->query($select1);
                            if($IN->num_rows> 0)//check present or not
                            {
                              $att=1;
                              while($INrow = $IN->fetch_assoc())
                                {
                                    $INdata = date('H:i:s', strtotime($INrow['Time_date']));
                                    $select2="SELECT MAX(Time_date) as Time_date FROM emp_logs WHERE DATE(Time_date)='$currentdate' AND Rf_id=$rf AND Log_status='OUT'";
                                    $OUT = $con->query($select2);
                                    if($OUT->num_rows> 0)
                                    {
                                        $OUTrow = $OUT->fetch_assoc();
                                        $OUTdata = date('H:i:s', strtotime($OUTrow['Time_date']));
                                    }
                                    else
                                    {
                                        $OUTdata="---";
                                    }
                                }
                            }
                            else
                            {
                              $att=0;
                              $INdata="---";
                              $OUTdata="---";
                            }
                             if($holiday==0)
                            { 

                          ?>
                        <tr style="opacity: 0; z-index:0;font-size:17px;" id="<?php echo 'Home'.$i; ?>">
                            <td><?php echo $i; $i++;?></td>
                            <td><?php echo $currentdate;?></td>
                            <td><?php echo $INdata; ?></td>
                            <td><?php echo $OUTdata; ?></td>
                            <td><?php  if($att==1)
                          {
                            echo "<p style='color: green;'>PRESENT</p>";
                            $p++;
                          } 
                          else
                          {
                            echo "<p style='color: red; font-weigth:none;'>ABSENT</p>";
                          } ?></td>
                        </tr>

                        <?php
                        }
                        else
                        {
                            echo"<tr id='Home$i' class='holidaysbo' style='opacity: 0;background-color: rgb(192, 19, 19); color:white;'>
                                    <td>$i</td>
                                    <td>$currentdate</td>
                                    <td colspan='6' ><p style=' font-size:20px; '>Public Holiday</p></td>
                                </tr>";
                            $i++;
                        }
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
                  $count=$i;
                  ?>
                    </tbody>
                </table>
                <script>
                trans();
                  //animation
                function trans() {
                    for (var i = 1; i < <?php echo $count; ?>; i++) {
                        var row = document.getElementById('Home' + i);
                        row.style.transform = "rotateX(90deg)";
                        var row1 = document.getElementById('barmenu');
                        row1.style.opacity = "1";
                        var table = document.getElementById('thetable');
                        table.style.opacity = "1";

                    }
                    for (var i = 1; i < <?php echo $count; ?>; i++) {
                        setTimeout(function(i) {
                            var row = document.getElementById('Home' + i);
                            if (row) {
                                for (var p = 90; p >= 0; p--) {
                                    setTimeout(function(p) {
                                        if (row) {
                                            row.style.transform = 'rotateX(' + p + 'deg)';
                                            row.style.opacity = "1";
                                        }
                                    }, (90 - p) * 1.5, p);
                                }
                            }
                            if (i == <?php echo $count-1; ?>) {
                                const holi = document.getElementsByClassName('holidaysbo');
                                if (holi.length > 0) {
                                    for (j = 0; j < holi.length; j++) {
                                        holi[j].style.border = '2px solid white';
                                        holi[j].style.boxSizing = 'border-box';
                                    }
                                }

                            }
                        }, i * 100, i);
                    }

                }
                </script>
            </div>
        </div>
        <?php } else
                {
                ?>
        <div style=" height:72%; width:100%; display:flex; align-items: center; justify-content: center;">
            <h1 style="font-size:90px">NO DATA</h1>
        </div>
        <?php   
        }?>
    </div>
</div>