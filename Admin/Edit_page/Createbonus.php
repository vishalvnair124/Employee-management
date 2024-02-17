<?php 
//page to creating the allowance for the employee
$m_id=$_SESSION['m_id'];
include 'session_check.php';
include '../common/connection.php'; ?>
<div style="width:100%;height:92%; display:flex; align-items: center; justify-content: center;">
    <div class="bonusadd">
        <div class="head">
            <h1>Create Allowance Details</h1>
        </div>
        <div class="subbody1">
            <form method="post">
                <div class="in1">
                    <div class="form_div">
                        <div
                            style="margin-left:10px;height:100%; width:35%; display:flex; align-items: center; justify-content: center;">
                            <div>Allowance Category</div>
                        </div>
                        <div
                            style="height:100%; width:65%; display:flex; align-items: center; justify-content: center;">
                            <input placeholder="Enter the Allowance Category" style=" text-align:center;width:90%; border-radius:10px;" type="text" id="Bonuscat" name="Bonuscat" required >
                        </div>
                    </div>
                    <div class="form_div">
                        <div
                            style="margin-left:10px;height:100%; width:35%; display:flex; align-items: center; justify-content: center;">
                            <div>Allowance Amount</div>
                        </div>
                        <div
                            style="height:100%; width:65%; display:flex; align-items: center; justify-content: center;">
                            <input placeholder="Enter the Allowance Amount ₹" style="text-align:center;width:90%;border-radius:10px;" type="text" id="Bonusamo" name="Bonusamo" required >
                        </div>
                    </div>
                </div>
                <div class="in2">
                    <div
                        style="background-color: rgba(222, 222, 222, 0.923);height:50px;width:100%;display:flex; flex-direction:row;">
                        <div style="height:100%; width:30%;"></div>
                        <div
                            style="height:100%; width:40%; display:flex; justify-content:center; align-items:center; font-size:20px">
                            <b>Employees</b>
                        </div>
                        <div style="height:100%; width:30%;display:flex; justify-content:center; align-items:center;">
                        </div>
                    </div>
                    <table>
                        <thead>
                            <th style="width:60px;">SI</th>
                            <th style="width:90px;">ID</th>
                            <th style="width:250px;">Name</th>
                            <th style="width:80%;display:flex; justify-content:center; align-items:center;"><b>Select all  <span style="opacity:0;">  d</span></b> <input onclick="checkall()"  type="checkbox"
                                name="all" id="allcheck"></th>
                        </thead>
                        <tbody id="desctabledata">
                            <?php
                    $sql = "SELECT * FROM employee_details WHERE Emp_status=1 ORDER BY CAST(SUBSTRING(employee_details.Emp_id, 2) AS SIGNED);";
                    $query = $con->query($sql);
                    if($query->num_rows)
                    {
                      $i=1;
                    while($row = $query->fetch_assoc()){
                      ?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td><?php echo $row['Emp_id']?></td>
                                <td><?php echo $row['Emp_name']?></td>
                                <td style="margin-left:60px; width:100px;display:flex; justify-content:center; align-items:center;">
                                    <?php $data=$row['Emp_id'];?>
                                    <input type="checkbox" name="<?php echo $row['Emp_id']; ?>" id="<?php echo $i; ?>">
                                </td>
                            </tr>
                            <?php
                            $i++; 
                    }
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
                </div>
                <div class="bo_foot">
                    <?php echo "<a href='?page=Bonus_details&mid=$m_id'><button style='width:90px;height:35px;'  type='button' class='cancel_edit' >Close</button></a>" ?>
                    <button style='width:90px;height:35px;' type="submit" class="save_edit" name="create">Create</button>
                </div>
            </form>
            <script>
            function checkall() {
                var mainbox = document.getElementById('allcheck');
                if (mainbox.checked == true) {
                    for (i = 1; i < <?php echo $i ?>; i++) {
                        document.getElementById(i).checked = true;
                    }
                } else {
                    for (i = 1; i < <?php echo $i ?>; i++) {
                        document.getElementById(i).checked = false;
                    }
                }
                i = 1
            }
            </script>
            <?php if(isset($_POST['create']))
            {
                $sqlcheck = "SELECT * FROM employee_details WHERE Emp_status=1 ORDER BY CAST(SUBSTRING(employee_details.Emp_id, 2) AS SIGNED);";
                $querycheck = $con->query($sqlcheck);
                $monthid=$_SESSION['m_id'];
                $bsalary=$_POST['Bonusamo'];
                $bcate=$_POST['Bonuscat'];
                $_SESSION['cat']=$bcate;
                while($datas=$querycheck->fetch_assoc())
                {
                    $id=$datas['Emp_id'];
                    if(isset($_POST[$id]))
                    {
                        $insert_bonus="INSERT INTO bonus_salary(Emp_id, Month_id, Bonus_salary, Bonus_category) VALUES ('$id','$monthid','$bsalary','$bcate')";
                        $con->query($insert_bonus);
                    }
                }
                echo "<script>window.location.href = '?page=Bonus_details&mid=$monthid';</script>";
            } ?>
        </div>
    </div>
</div>