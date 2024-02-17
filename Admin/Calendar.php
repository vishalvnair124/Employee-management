<?php
//Page to view calender details including holidays and working days
include 'session_check.php';
  include '../common/connection.php';
  $month=array("","January","February","March","April","May","June","July","August","September","October","November","December");
  $monthco = array(0, 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
  if(isset($_GET["date"]))
  {
    $yearmo = $_GET["date"];
  }
  else
  {
    $yearmo = date('Y-m');
  }
  $daysOfWeekarr = array(
    "Sunday" => 1,
    "Monday" => 2,
    "Tuesday" => 3,
    "Wednesday" => 4,
    "Thursday" => 5,
    "Friday" => 6,
    "Saturday" => 7
);
  ?>
<div class="calendar">
    <div style="z-index: 2;" class="head">
        <a href="?page=addcal"><button>ADD</button></a>
        <h2>Calendar Details</h2>
        <form method="post">
            <input style="border-radius:20px;" value="<?php
            if(isset($_POST['month_date']))
            {
                $yearmo=$_POST['month_date'];
            }
            list($Year,$month) = explode('-', $yearmo);
            $mon_id=$Year.$month;
            echo $yearmo;
        ?>" type="month" onchange="this.form.submit()" name="month_date" required>
        </form>
    </div>
    <div class="cal_data">
        <div class="cal_detail">
            <?php
          $cale="SELECT * FROM company_calender WHERE Month_id='$mon_id'";
          $query2 = $con->query($cale);
          if (($Year % 4 == 0 && $Year % 100 != 0) || ($Year % 400 == 0)) {
            $monthco[2]=29;
          }
          if($query2->num_rows==0)
          {
            $daysval=$monthco[intval($month)];
            $sql="INSERT INTO company_calender(Month_id,Year, Month, Working_day) VALUES ('$mon_id','$Year','$month','$daysval')";
            $con->query($sql);
            $cale="SELECT * FROM company_calender WHERE Month_id='$mon_id'";
            $query2 = $con->query($cale);
          }
          $datavalue=$query2->fetch_assoc();
          ?>
            <div style="margin-bottom:5px; width: 100%; height: 50px;  display:flex; justify-content:space-around;">
                <div
                    style="border-radius:20px; width: 400px; height: 100%; background-color: rgba(255, 255, 255, 0.852); display:flex; align-item:center; justify-content:space-around;">
                    <h1 id="worksdate" style="font-size:20px;">Total number of working days :
                        <?php $works=$datavalue['Working_day']; echo $datavalue['Working_day'] ?>
                    </h1>
                </div>
                <div
                    style="border-radius:20px; width: 400px; height: 100%; background-color: rgba(255, 255, 255, 0.852); display:flex; align-item:center; justify-content:space-around;">
                    <h1 id="holidate" style="font-size:20px;">Total number of holidays :
                        <?php $holidata1=$monthco[intval($month)]-$datavalue['Working_day']; echo $monthco[intval($month)]-$datavalue['Working_day'] ?>
                    </h1>
                </div>
            </div>
            <table>
                <thead>
                    <th>SUN</th>
                    <th>MON</th>
                    <th>TUE</th>
                    <th>WED</th>
                    <th>THU</th>
                    <th>FRI</th>
                    <th>SAT</th>
                </thead>
                <tbody id="tablenew">
                    <tr>
                        <?php
                  $t1=7;
                  $nedate = $yearmo."-01";
                  $dayOfWeek = date("l", strtotime($nedate));
                  $temp=$daysOfWeekarr[$dayOfWeek];
                  $i=0;
                    if($i==0)
                    {
                      $i=1;
                      $k=1;
                      $countt=1;
                    while($i<$monthco[intval($month)]+$temp){
                      if($i<$temp)
                      {
                        echo"<td></td>";
                      }
                      else
                      {
                        $holi="SELECT * FROM holidays WHERE Month_id='$mon_id' AND day='$k'";
                        if($con->query($holi)->num_rows> 0)
                        {
                      ?>

                        <td>
                            <div id='<?php echo $countt; ?>'
                                style='background-color:red; color:white; <?php if($k<10){$day='0'.$k;}else{$day=$k;} $date=$yearmo.'-'.$day; if($date==date('Y-m-d')){ echo "border-radius:5px;border: 10px solid white; box-sizing: border-box;";} ?>'>
                                <div
                                    style="width:100%; display:flex; justify-content:center; align-items:center; height:60%;">
                                    <?php echo "<b>".$k."</b>";?>
                                </div>
                                <?php echo "<a onclick='holidays(0,$mon_id,$k)'><button style='background-color:white; color: black;'>Remove Holiday</button></a>"; $k++;?>
                            </div>
                        </td>


                        <?php
                        }
                        else
                        {
                          ?>
                        <td>
                            <div id='<?php echo $countt; ?>'
                                style='<?php if($k<10){$day='0'.$k;}else{$day=$k;} $date=$yearmo.'-'.$day; if($date==date('Y-m-d')){ echo "color:white; border-radius:5px;border: 10px solid white; box-sizing: border-box;";} ?>'>
                                <div
                                    style="width:100%; display:flex; justify-content:center; align-items:center; height:60%;">
                                    <?php echo "<b>".$k."</b>";?>
                                </div>
                                <?php echo "<a onclick='holidays(1,$mon_id,$k)'><button>Add Holiday</button></a>"; $k++; ?>
                            </div>
                        </td>
                        <?php
                        }
                       $countt++;
                      }
                      $i++;
                      if($i%7==1)
                      {
                        echo "</tr><tr>";
                      }
                    }
                    while($i%7!=0)
                    {
                      echo"<td></td>";
                      $i++;
                    }
                    echo"<td></td>";
                    echo "</tr>";
                    
                  }
                  else
                  {
                    ?>
                    <tr>
                        <td colspan="8">
                            NO DATA
                        </td>
                    </tr>
                    <?php
                  }
                  ?>
                </tbody>
            </table>
            <script>
            autoin3();
            autoin4();

            function autoin3() {
                var j = 1;
                var anotherH1Element = document.getElementById('worksdate');

                function updateAnotherValue2() {
                    if (j <= <?php echo $works; ?>) {
                        anotherH1Element.innerHTML = "Total number of working days : " + j;
                        j++;
                        setTimeout(updateAnotherValue2, 20);
                    }
                }

                updateAnotherValue2();
            }

            function autoin4() {
                var j = 1;
                var anotherH1Element = document.getElementById('holidate');

                function updateAnotherValue2() {
                    if (j <= <?php echo $holidata1; ?>) {
                        anotherH1Element.innerHTML = "Total number of holidays : " + j;
                        j++;
                        setTimeout(updateAnotherValue2, 100);
                    }
                }

                updateAnotherValue2();
            }
            trans();

            function trans() {
                for (var i = 1; i < <?php echo $countt; ?>; i++) {
                    var row = document.getElementById(i);
                    row.style.opacity = "0";
                }

                for (var i = 1; i < <?php echo $countt; ?>; i++) {
                    setTimeout(function(i) {
                        var row = document.getElementById(i);
                        if (row) {
                            for (var op = 0; op <= 1; op += 0.1) {
                                setTimeout(function(op) {
                                    if (row) {
                                        row.style.opacity = op;
                                    }
                                }, op * 100, op);
                            }
                        }
                    }, i * 40, i);
                }
            }
            </script>
        </div>
    </div>
</div>