<div class="update_empin">

    <?php 
    //page to view the personal details of an employee
    include 'session_check.php';
        include '../common/connection.php';
        $monthar=array("","January","February","March","April","May","June","July","August","September","October","November","December");?>
    <div class="update_form">
        <?php 
            $id=$_SESSION['detailid'];
            $query="SELECT employee_details.*, employee_designation.Desc_name, designation_for_employee.Desc_id
            FROM employee_details
            INNER JOIN designation_for_employee ON employee_details.Emp_id = designation_for_employee.Emp_id
            INNER JOIN employee_designation ON designation_for_employee.Desc_id = employee_designation.Desc_id
            WHERE employee_details.Emp_id = '$id' AND designation_for_employee.Desc_status = '1';";
            $data=$con->query($query);
            $EMP = $data->fetch_assoc(); ?>

        <div class="emp_details_view">
            <div class="header_view">
                <a href="?page=Employees">X</a>
                <h1> Details of the Employee</h1>
                <div></div>
            </div>
            <div class="theprofile">
                <div class="profile">
                    <img style=" object-fit: cover; "
                        src="<?php echo (!empty($EMP['Emp_Photo']))? '../images/'.$EMP['Emp_Photo']:'../images/profile.jpg'; ?>">
                    <h2><?php echo $EMP['Emp_name'];?></h2>
                    <div class="id_show">ID: <?php echo $EMP['Emp_id']; ?></div>
                    <div class="Desc_show">
                        <h4>DESIGNATION</h4><?php echo $EMP['Desc_name'];?>
                    </div>
                    <div class="Desc_show">
                        <h4>RF ID</h4><?php echo $EMP['Rf_id']; $rf=$EMP['Rf_id'];?>
                    </div>
                    <div class="Desc_show">
                        <h4>DATE OF JOIN</h4><?php echo $EMP['Emp_DOJ'];?>
                    </div>
                    <div class="Desc_show">
                        <h4>STATUS</h4><?php 
                          if($EMP['Emp_status']==0) 
                          {
                            echo "<span style='color: red; font-weigth:none;'>INACTIVE</span>";
                          }
                          elseif($EMP['Emp_status']==1)
                          {
                            echo "<span style='color: green;'>ACTIVE</span>";
                          }
                          elseif($EMP['Emp_status']== 2)
                          {
                            echo "<span style='color: red;'>Ex Emp</span>";
                          }
                          else {
                            echo "<span style='color: blue;'>PENDING</span>";
                          }
                          ?>
                    </div>
                </div>

                <div class="data_edit">

                    <div class="data_1">
                        <h3>PERSONAL DETAILS</h3>
                        <div class="bar_le">
                            <label>Full name</label>
                            <h6><?php echo $EMP['Emp_name'];?></h6>
                        </div>
                        <div class="sub_div">
                            <div class="DOB">
                                <label>DATE OF BIRTH</label>
                                <h6><?php echo $EMP['Emp_DOB'];?></h6>
                            </div>
                            <div class="Gender">
                                <label>GENDER</label>
                                <h6><?php echo $EMP['gender'];?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="data_2">
                        <h3>CONTACT</h3>
                        <div class="bar_le">
                            <label>ADDRESS</label>
                            <h6><?php echo $EMP['Emp_Address'];?></h6>
                        </div>
                        <div class="bar_le">
                            <label>Moblie No</label>
                            <h6><?php echo $EMP['Emp_mobileno'];?></h6>
                        </div>
                        <div class="bar_le">
                            <label>Email</label>
                            <h6><?php echo $EMP['Emp_email'];?></h6>
                        </div>
                    </div>
                    <div class="Buttons_bar">
                        <?php
                        $data=$EMP['Emp_id'];
                        if($EMP['Emp_status']!= 2)
                        {
                          echo "<a href='?page=Edit'><button style='background-color: lightblue; color:black;'>EDIT</button></a>";
                          echo "<a href='?page=Editdesc'><button style='background-color: brown; color:white;'>EDIT DESC</button></a>";
                          echo "<a href='Edit_code/status.php?id=$data&st=2'><button style='background-color: yellow; color:black;'>DELETE</button></a>";
                            if($EMP['Emp_status']==1)
                            {
                                echo "<a href='Edit_code/status.php?id=$data&st=0'><button style='background-color: red; color:white;'>SUSPEND</button></a>";
                            }
                            elseif($EMP['Emp_status']==0)
                            {
                                echo "<a href='Edit_code/status.php?id=$data&st=1'><button style='background-color: green; color:white;'>ACTIVE</button></a>" ;
                            }
                            else
                            {
                                echo "<a href=''><button style='background-color: blue; color:white;'>Pending</button></a>" ;
                            }
                        }
                        else {
                            echo "<button style='border-radius:20px; border:2px solid white; width:100%;background-color: red; color:white;'>This account can't be edited</button>";
                        }
                            ?>
                    </div>
                </div>
            </div>
            <div class="per_att">
                <div style="height:90%; width:98%;" class="per_att_table">
                    <?php $line_check_query=$con->query("SELECT COUNT(*) as no_of_data FROM daily_attendance WHERE Emp_id='$data'");
                        $no=$line_check_query->fetch_assoc();
                        if($no["no_of_data"]>=5)
                        {
                            $num=5;
                        }
                        else
                        {
                            $num=$no["no_of_data"];
                        }
                        ?>
                    <h2 style="width:100%; color: white; ">Attendance of last <?php echo $num;?> days</h2>
                    <table>
                        <thead style="background-color: transparent;">
                            <th>Date</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                            <th>Worked hours</th>
                            <th>Status</th>
                        </thead>
                        <tbody id="tabledata">
                            <?php
                                        $sql="SELECT DISTINCT Att_date as thedate FROM daily_attendance WHERE Emp_id='$data' ORDER BY Att_date DESC  LIMIT $num;";
                                        $query = $con->query($sql);
                                    if($query->num_rows>0 && $num> 0)
                                    {
                                        $i=1;
                                        while($row = $query->fetch_assoc())
                                        {
                                            $date=$row['thedate'];
                                            $invalue_sql="SELECT * FROM emp_logs WHERE Rf_id='$rf' AND DATE(Time_date)='$date'  AND Log_status='IN'";
                                            $inquery = $con->query($invalue_sql);
                                            if($inquery->num_rows)
                                            {
                                                $in=$inquery->fetch_assoc();
                                                $outvalue_sql="SELECT * FROM emp_logs WHERE Rf_id='$rf' AND DATE(Time_date)='$date'  AND Log_status='OUT'";
                                                $outquery = $con->query($outvalue_sql);
                                                $out=$outquery->fetch_assoc();
                                                $timein = date("H:i", strtotime($in['Time_date']));
                                                $timeout = date("H:i", strtotime($out['Time_date']));
                                                $timeincal =strtotime($in['Time_date']);
                                                $timeoutcal = strtotime($out['Time_date']);
                                                $diffInSeconds = $timeoutcal - $timeincal;
                                                $hours = floor($diffInSeconds / 3600); 
                                                $status=1;
                                            }
                                            else
                                            {
                                                $timein = "---";
                                                $timeout = "---";
                                                $status=0;
                                                $hours=0;
                                            }
                                ?>
                            <tr>
                                <td><?php echo $date; ?></td>
                                <td><?php echo $timein ?></td>
                                <td><?php echo $timeout ?></td>
                                <td><?php echo (!empty($hours))?$hours."hrs":"---" ;?></td>
                                <td><?php echo ($status==1)? "<p style='color: rgb(13, 255, 0);'>PRESENT</p>":"<p style='color: red; font-weigth:none;'>ABSENT</p>"; ?>
                                </td>
                            </tr>
                            <?php
                                        }
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
                    <?php echo "<a href='?page=per_att_view'><button class='Moreview'>More Details</button></a>" ?>
                </div>
            </div>
            <div class="per_att">
                <div style="height:90%; width:98%;" class="per_att_table">
                    <?php $line_check_query=$con->query("SELECT COUNT(*) as no_of_data FROM salary_paid WHERE Emp_id='$data'");
                        $no=$line_check_query->fetch_assoc();
                        if($no["no_of_data"]>=5)
                        {
                            $num=5;
                        }
                        else
                        {
                            $num=$no["no_of_data"];
                        }
                        ?>
                    <h2 style="width:100%; color: white; ">Payroll of last <?php echo $num;?> Months</h2>
                    <table>
                        <thead style="background-color: transparent;">
                            <th>Date</th>
                            <th>Worked Hours</th>
                            <th>Overtime Hours</th>
                            <th>Total salary</th>
                            <th>Status</th>
                        </thead>
                        <tbody id="tabledata">
                            <?php
                                        $sql="SELECT *
                                        FROM salary_paid
                                        INNER JOIN overtime_details ON salary_paid.Month_id = overtime_details.Month_id AND salary_paid.Emp_id = overtime_details.Emp_id WHERE salary_paid.Emp_id='$data' ORDER BY salary_paid.Month_id DESC LIMIT 5;";
                                        $query = $con->query($sql);
                                    if($query->num_rows > 0 && $num> 0)
                                    {
                                        $i=1;
                                        while($row = $query->fetch_assoc())
                                        {
                                            $monthdata = substr($row['Month_id'], 4, 2);
                                            $yeardata = substr($row['Month_id'], 0, 4);
                                            $monthdata = intval($monthdata);
                                ?>
                            <tr>
                                <td><?php echo $monthar[$monthdata]." ".$yeardata; ?></td>
                                <td><?php echo (!empty($row['Working_hour']))?$row['Working_hour']."hrs":"---" ; ?></td>
                                <td><?php echo (!empty($row['Overtime_hrs']))?$row['Overtime_hrs']."hrs":"---" ;?></td>
                                <td><?php echo "₹ ".number_format($row['Total_salary']); ?></td>
                                <td><?php echo ($row['Salary_status']==1)? "<p style='color: rgb(13, 255, 0);'>PAID</p>":"<p style='color: red; font-weigth:none;'>PENDING</p>"; ?>
                                </td>
                            </tr>
                            <?php
                                        }
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
                    <?php echo "<a href='?page=per_pay_view'><button class='Moreview'>More Details</button></a>" ?>
                </div>
            </div>
        </div>
    </div>
</div>