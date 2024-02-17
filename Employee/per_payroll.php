<?php
  include 'session_check.php';
  include '../common/connection.php';
    $id=$_SESSION['Emp_id'];
    $date=$_GET['check'];
    $year = substr($date, 0, 4);
    $month = substr($date, 4, 2);
    $datevalue = $year . '-' . $month;
?>
<div class="pay_details">
    <div class="pay_details_sub">
        <div style="width:100%;display:flex;flex-direction:row; align-items: center; justify-content:space-between;">
        <?php echo "<a style='margin-left:20px;text-decoration: none;font-size:28px;color:white;'href='?page=payroll'><b>X</b></a>"; ?>
        <h1>PAYROLL DETAIL</h1>
        <?php echo "<a style='margin-right:20px;font-size:28px;opacity:0;'>X</a>"; ?></div>
        
        <div class="payroll_head">
            <div>
                <h1>Salary in </h1>
                <form method="POST">
                <input value="<?php
                if(isset($_POST['month_date']))
                {
                    $datevalue=$_POST['month_date'];
                    list($Year,$month) = explode('-', $datevalue);
                    $date=$Year.$month;
                }
                echo $datevalue;
                ?>" 
                type="month" style="border-radius: 20px;" onchange="this.form.submit()" name="month_date" required>
                </form>
            </div>
        </div>
        <?php 
         $details="SELECT salary_paid.*, company_calender.*, employee_designation.*,employee_details.Emp_name,overtime_details.* FROM salary_paid 
         INNER JOIN employee_designation ON salary_paid.Desc_id=employee_designation.Desc_id
         INNER JOIN employee_details ON employee_details.Emp_id=salary_paid.Emp_id
         INNER JOIN company_calender ON company_calender.Month_id=salary_paid.Month_id
         INNER JOIN overtime_details ON overtime_details.Emp_id=salary_paid.Emp_id AND overtime_details.Month_id=salary_paid.Month_id
         WHERE salary_paid.Emp_id='$id' AND salary_paid.Month_id='$date'";
         $rowquery=$con->query($details);
         $bonusamount=0;
         $bonus="SELECT Bonus_salary FROM bonus_salary WHERE Emp_id='$id' AND Month_id='$date' "; 
        $bonusquery=$con->query($bonus);
        if($bonusquery->num_rows>0)
        {
            while($bonusdata=$bonusquery->fetch_assoc())
            {
                $bonusamount=$bonusamount+$bonusdata['Bonus_salary'];
            }
        }
         if($rowquery->num_rows > 0)
         {
            $row=$rowquery->fetch_assoc();
        ?>
        <div class="payroll_scale01">
            <h1>SCALE</h1>
            <table border="3">
                <thead>
                    <th>Designation name</th>
                    <th>Basic Salary</th>
                    <th>Dearness allowance</th>
                    <th>Provident fund</th>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $row['Desc_name'];?></td>
                        <td><?php echo "₹".number_format($row['Desc_basic']);?></td>
                        <td><?php echo "₹".number_format($row['Desc_da']);?></td>
                        <td><?php echo "₹".number_format($row['Desc_pf']);?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="payroll_scale02">
            <div>
                <table>
                    <tr>
                        <td><p>Worked hours</P></td>
                        <td>:</td>
                        <td><P><?php echo $row['Working_hour']."hrs";?></p></td>
                    </tr>
                    <tr>
                        <td><P>Salary</p></td>
                        <td>:</td>
                        <td><P><?php echo "₹".number_format($row['Desc_basic']/($row['Working_day']*8),2)." /hr";?></p></td>
                    </tr>
                    <tr>
                        <td><P>Total</p></td>
                        <td>:</td>
                        <td><P><?php echo "₹".number_format($row['Salary_basic']);?></p></td>
                    </tr>
                </table>
            </div>
            <div>
                <table>
                        <tr>
                            <td><p>Overtime hours</P></td>
                            <td>:</td>
                            <td><P><?php echo $row['Overtime_hrs']."hrs";?></p></td>
                        </tr>
                        <tr>
                            <td><P>Overtime Salary</p></td>
                            <td>:</td>
                            <td><P><?php echo "₹".number_format($row['Desc_overtimesalary'])."/hrs";?></p></td>
                        </tr>
                        <tr>
                            <td><P>Total</p></td>
                            <td>:</td>
                            <td><P><?php echo "₹".number_format($row['Overtime_salary']);?></p></td>
                        </tr>
                </table>
            </div>
        </div>
        <div class="payroll_salarydet">
            <h1>SALARY</h1>
            <table border="3">
                <thead>
                    <th>Basic Salary</th>
                    <th>Dearness allowance</th>
                    <th>Medical allowance</th>
                    <th>Provident fund</th>
                    <th>Overtime total</th>
                    <th>Extra Allowance</th>
                    <th>Total Salary</th>
                    <th>Status</th>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo "₹".number_format($row['Salary_basic']);?></td>
                        <td><?php echo "₹".number_format($row['Salary_da']);?></td>
                        <td><?php echo "₹".number_format($row['Salary_ma']);?></td>
                        <td><?php echo "₹".number_format($row['Salary_pf']);?></td>
                        <td><?php echo ($row['Overtime_hrs']>4)? "₹".number_format($row['Overtime_salary']*4):  "₹".number_format($row['Overtime_salary']*$row['Overtime_hrs'])?></td>
                        <td><?php echo "₹".number_format($bonusamount);?></td>
                        <td><?php echo "₹".number_format($row['Total_salary']);?></td>
                        <td><?php echo ($row['Salary_status']==1)? "<p style='color: green;'>PAID</p>":"<p style='color: red; font-weigth:none;'>PENDING</p>"; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php
        }
        else
        {
            ?>
            <div style=" height:72%; width:100%; display:flex; align-items: center; justify-content: center;">
                <h1 style="font-size:90px">NO DATA</h1>
            </div>
            <?php
        } ?>
    </div>
</div>