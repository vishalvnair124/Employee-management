<div class="update_empin">
    <?php //page to view personal payroll details of an employee
    include 'session_check.php';
        include '../common/connection.php';
        $year=date('Y');
        $monthar=array("","January","February","March","April","May","June","July","August","September","October","November","December");?>
    <div class="update_form">
        <?php 
            $data=$_SESSION['detailid'];
            $emp_query=$con->query("SELECT Rf_id, Emp_name FROM employee_details WHERE Emp_id='$data'");
            $emp_row=$emp_query->fetch_array();
            $rf=$emp_row["Rf_id"];
            ?>
        <div style="width: 110%" class="emp_details_view">
            <div class="header_view">
                <?php echo "<a href='?page=View_details'>X</a>"; ?>
                <h1 style="width: 60%">Payrolls of <?php echo $emp_row["Emp_name"]?></h1>
                <div></div>
            </div>
            <div style="border: none; margin-top:0px" class="per_att">
                <div style="height:90%; width:98%;" class="per_att_table">
                    <form style="width:100%; height: 20px; " method="POST">
                        <select onchange="this.form.submit()"
                            style="float:right; height: 30px;color: #333; width: 130px; border-radius:10px; text-align: center;"
                            name="year_select" id="">
                            <?php
                        if(isset($_POST["year_select"])){
                            $year=$_POST["year_select"];
                        }
                        for($i= 2020;$i<=2030;$i++)
                        {
                            if($year==$i)
                            {
                              echo "<option selected value='$i'>$i</option>";
                            }
                            else
                            {
                              echo "<option value='$i'>$i</option>";
                            }
                        }
                        ?>
                        </select>
                    </form>
                    <table>
                        <thead style="background-color: transparent;">
                            <th>Date</th>
                            <th>Designation</th>
                            <th>Worked Hours</th>
                            <th>Overtime Hours</th>
                            <th>Total salary</th>
                            <th>Status</th>
                        </thead>
                        <tbody id="tabledata">
                            <?php
                                        $sql="SELECT *
                                        FROM salary_paid
                                        INNER JOIN overtime_details ON salary_paid.Month_id = overtime_details.Month_id AND salary_paid.Emp_id = overtime_details.Emp_id 
                                        INNER JOIN employee_designation ON salary_paid.Desc_id = employee_designation.Desc_id 
                                        WHERE salary_paid.Month_id LIKE '$year%' AND salary_paid.Emp_id='$data' ORDER BY salary_paid.Month_id DESC;";
                                        $query = $con->query($sql);
                                    if($query->num_rows)
                                    {
                                        $i=1;
                                        $workedhours=0;
                                        $overtimehours=0;
                                        $totalsalary=0;
                                        while($row = $query->fetch_assoc())
                                        {
                                            $monthdata = substr($row['Month_id'], 4, 2);
                                            $yeardata = substr($row['Month_id'], 0, 4);
                                            $monthdata = intval($monthdata);
                                ?>
                            <tr style="opacity: 0; z-index:0;" id="<?php echo $i; $i++; ?>">
                                <td><?php echo $monthar[$monthdata]." ".$yeardata; ?></td>
                                <td><?php echo  $row['Desc_name']; ?></td>
                                <td><?php echo (!empty($row['Working_hour']))?$row['Working_hour']."hrs":"---"; $workedhours=$workedhours+$row['Working_hour'];?>
                                </td>
                                <td><?php echo (!empty($row['Overtime_hrs']))?$row['Overtime_hrs']."hrs":"---"; $overtimehours=$overtimehours+$row['Overtime_hrs'];?>
                                </td>
                                <td><?php echo (!empty($row['Total_salary']))?"₹ ".number_format($row['Total_salary']):"---"; $totalsalary=$totalsalary+$row['Total_salary']; ?>
                                </td>
                                <td><?php echo ($row['Salary_status']==1)? "<p style='color: rgb(13, 255, 0);'>PAID</p>":"<p style='color: red; font-weigth:none;'>PENDING</p>"; ?>
                                </td>
                            </tr>
                            <?php }
                            if ($totalsalary >= 1000000000000) {
                                $tsalary = number_format(($totalsalary / 1000000000000), 2) . "T";
                            } elseif ($totalsalary >= 1000000000) {
                                $tsalary = number_format(($totalsalary / 1000000000), 2) . "B";
                            } elseif ($totalsalary >= 1000000) {
                                $tsalary = number_format(($totalsalary / 1000000), 2) . "M";
                            } elseif ($totalsalary >= 1000) {
                                $tsalary = number_format(($totalsalary / 1000), 2) . "k";
                            } else {
                                $tsalary = $totalsalary;
                            }
                            
                            
                            ?>
                            <tr style="opacity: 0; z-index:0; background-color: #8200006a;" id="<?php echo $i; $i++; ?>">
                                <td colspan="2" style="font-size:25px;">TOTAL</td>
                                <td><?php echo (!empty($workedhours))?$workedhours."hrs":"---";?>
                                </td>
                                <td><?php echo (!empty($overtimehours))?$overtimehours."hrs":"---";?>
                                </td>
                                <td><?php echo "₹ ".$tsalary; ?>
                                </td>
                                <td>
                                </td>
                            </tr>
                            <?php
                            $count=$i;
                            }
                            else
                            {
                            ?>
                            <tr>
                                <td colspan="9">
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
    </div>
</div>