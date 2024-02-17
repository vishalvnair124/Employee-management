<?php //dashboard shows the current days attendance
 include 'session_check.php';?>
<div class="thefulldiv">
    <div class="loading">
        <div align='center' class="sureq">
            <h4>Are you sure? </h4><br>
            <h4>You want to delete all data</h4>
            <div class="footer">
                <button onclick='areyousure()'>Cancel</button>
                <?php echo "<a onclick='loadthebar()' href='?page=dailyadd'><button>Yes</button></a>"; ?>
            </div>
        </div>
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
        <h2>Please wait till <br>all data are fetched <br>(This will take a while)</h2>
    </div>
</div>
<div class="Bashboard">
    <div style="display: flex; justify-content: space-between; z-index:1;" class="head">
    <div></div>
        <?php /* echo "<a onclick='areyousure()'><button style='width:140px; height: 36px; font-size: 17px;'>Refresh all data</button></a>"; */ ?>
        <h3>Daily Attendance report </h3>
        <div></div>
        <script>
        const loading = document.querySelector('.loading');
        const areq = document.querySelector('.sureq');
        const areyou = document.querySelector('.thefulldiv');

        function loadthebar() {

            if (loading.classList.contains('active')) {
                loading.classList.remove('active');
            } else {
                loading.classList.add('active');
                areq.classList.add('deactive');
            }
        }

        function areyousure() {
            if (areyou.classList.contains('active')) {
                areyou.classList.remove('active');
            } else {
                areyou.classList.add('active');
            }
        }
        </script>
        <?php
  include '../common/connection.php';
  $currentdate=date("Y-m-d");
  $sql = "SELECT * FROM Employee_details WHERE Emp_status=1";
  $query = $con->query($sql);
  $total=$query->num_rows;
  $sql = "SELECT DISTINCT Rf_id FROM emp_logs WHERE Rf_id IN (SELECT Rf_id FROM employee_details WHERE Emp_status = '1') AND DATE(Time_date)='$currentdate';";
  $query = $con->query($sql);
  $present = $query->num_rows;
  $absent=$total-$present;
  $percentage = ($present/$total)*100;
  $percentage=number_format($percentage, 2);
  ?>

    </div>
    <div class="data1">
        <div class="sample_data" style="<?php if(isset($_SESSION['init2']))
        {
            echo "height:100%";
        }
        else
        {
            $_SESSION['init2']=1;
            echo "height:91%";
        }?>">
            <div class="box">
                <div class="bodypart">
                    <h3 id="toemp">0</h3>
                    <p>Total Employees</p>
                </div>
                <div class="footerpart">
                    <a href="?page=Employees">More info</a>
                </div>
            </div>
            <div class="box">
                <div class="bodypart">
                    <div
                        style=" margin-top:10px; width:100%; height:35px;display:flex; flex-direction: row; justify-content:center; align-item:center;">
                        <h3 style="font-size:30px; margin-top:0px;" id="pre">0.00</h3><sup
                            style='font-size: 20px;'>%</sup>
                    </div>
                    <p>Present Percentage</p>
                </div>
                <div class="footerpart">
                    <a href="?page=Monthly_attendance">More info</a>
                </div>
            </div>
            <div class="box">
                <div class="bodypart">
                    <h3 id="topre">0</h3>
                    <p>Today's Present</p>
                </div>
                <div class="footerpart">
                    <a href="?page=Attendance">More info</a>
                </div>
            </div>
            <div class="box">
                <div class="bodypart">
                    <h3 id="toab">0</h3>
                    <p>Today's Absents</p>
                </div>
                <div class="footerpart">
                    <a href="?page=Attendance">More info</a>
                </div>
            </div>

        </div>
        <script>
        function callassemble() {
            autoin1();
            autoin2();
            autoin3();
            autoin4();
        }

        function autoin1() {
            var j = 1;
            var anotherH1Element = document.getElementById('toemp');

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

            var anotherH1Element = document.getElementById('pre');

            function updateAnotherValue1() {
                if (j <= <?php echo $percentage; ?>) {
                    var randomNum = Math.floor(Math.random() * (max - min + 1)) + min;
                    anotherH1Element.innerHTML = j + '.' + randomNum;
                    j++;
                    setTimeout(updateAnotherValue1, 10);
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
            var anotherH1Element = document.getElementById('topre');

            function updateAnotherValue2() {
                if (j <= <?php echo $present; ?>) {
                    anotherH1Element.innerHTML = j;
                    j++;
                    setTimeout(updateAnotherValue2, 70);
                }
            }

            updateAnotherValue2();
        }

        function autoin4() {
            var j = 1;
            var anotherH1Element = document.getElementById('toab');

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
            <div class="att_sub_div1">
                <table>
                    <thead>
                        <?php 
                        $monthidva=date("Ym");
                        $dayva=intval(date("d"));
                        $holidaysql="SELECT * FROM holidays WHERE Month_id='$monthidva' AND day='$dayva'";
                        $yesorno = $con->query($holidaysql)->num_rows;
                        if($yesorno> 0)
                        {
                          echo "<tr><td colspan='7' style='background-color: red; color:white;font-size:30px;'>HOLIDAY</td></tr>";
                        }
                        ?>
                        <th>SI</th>
                        <th>Employee ID</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Log in Time</th>
                        <th>Log out Time</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        <?php

                    $sql = "SELECT * FROM employee_details WHERE Emp_status=1 ORDER BY CAST(SUBSTRING(`Emp_id`, 2) AS SIGNED);";
                  
                    $query = $con->query($sql);
                    if($query->num_rows>0)
                    {
                      $i=1;
                      $p=0;
                    while($row = $query->fetch_assoc()){
                      ?>
                        <tr style="opacity: 0; z-index:0; transform: rotateX(90deg);" id="<?php echo $i;?>">
                            <td><?php echo $i; $i++;?></td>
                            <td><?php echo $row['Emp_id']; ?></td>
                            <td><img style="border-radius: 50%; object-fit: cover; width:45px; height:45px;"
                                    src="<?php echo (!empty($row['Emp_Photo']))? '../images/'.$row['Emp_Photo']:'../images/profile.jpg'; ?>"
                                    width="30px" height="30px" loading="lazy"> </td>
                            <td><?php echo $row['Emp_name']; ?></td>
                            <?php
                            $rf=$row['Rf_id'];
                            $select1="SELECT Time_date FROM emp_logs WHERE DATE(Time_date)='$currentdate' AND Rf_id=$rf AND Log_status='IN'";
                            $IN = $con->query($select1);
                            if($IN->num_rows> 0 )
                            {
                              $att=1;
                              $INrow = $IN->fetch_assoc();
                              $INdata = date('H:i:s', strtotime($INrow['Time_date']));
                              $select2="SELECT MAX(Time_date) as Time_date FROM emp_logs WHERE DATE(Time_date)='$currentdate' AND Rf_id=$rf AND Log_status='OUT'";
                              $OUT = $con->query($select2);
                              if($OUT->num_rows> 0)
                              {
                                $OUTrow = $OUT->fetch_assoc();
                                if($OUTrow['Time_date']==NULL)
                                {
                                    $OUTdata="---";
                                }
                                else
                                {
                                    $OUTdata = date('H:i:s', strtotime($OUTrow['Time_date']));
                                }
                              }
                              else
                              {
                                $OUTdata="---";
                              }
                            }
                            else
                            {
                              $att=0;
                              $INdata="---";
                              $OUTdata="---";
                            }
                          ?>
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
                    $count=$i;
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
</div>