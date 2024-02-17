<div class="addempin" style="height: 510px; margin-top: -110px;">
    <?php
    //upade the designation details of an employee
    include 'session_check.php';
    $id=$_GET['id'];
    include '../common/connection.php';
    $desc_details = "SELECT * FROM employee_designation WHERE Desc_id='$id'";
    $datavalue= $con->query($desc_details);
    $desig_max_sql = "SELECT MAX(Desc_id) AS max FROM employee_designation;";
    $desig_max = $con->query($desig_max_sql);
    $maxdata = $desig_max->fetch_assoc();
    $descid = $maxdata["max"]+1;
    $row= $datavalue->fetch_assoc();

    ?>
    <form method="POST">
        <div class="main_form">
            <div class="desc_details">
                <h1 style="text-align:center;">Designation Details</h1>
                <div class="form_div">
                    <label for="username">Designation ID</label>
                    <input type="text" id="user" value="<?php echo $row['Desc_id']; ?>" name="Descid" readonly required>
                </div>
                <div class="form_div">
                    <label for="descname">Designation name</label>
                    <input type="text" id="name" name="descname" value="<?php echo $row['Desc_name']; ?>" required>
                </div>
                <div class="form_div">
                    <label for="salary">Basic salary</label>
                    <input type="text" id="salary" name="salary" value="<?php echo $row['Desc_basic']; ?>" required>
                </div>
                <div class="form_div">
                    <label for="Overtimesalary">Overtime salary</label>
                    <input type="text" id="over_salary" name="over_salary" value="<?php echo $row['Desc_overtimesalary']; ?>" required>
                </div>
                <div class="form_div">
                    <label for="da">Dearness allowance</label>
                    <input type="text" id="da" name="da" value="<?php echo $row['Desc_da']; ?>" required>
                </div>
                <div class="form_div">
                    <label for="ma">Medical allowance</label>
                    <input type="text" id="ma" name="ma" value="<?php echo $row['Desc_ma']; ?>" required>
                </div>
                <div class="form_div">
                    <label for="pf">Provident fund</label>
                    <input type="text" id="pf" name="pf" value="<?php echo $row['Desc_pf']; ?>" required>
                </div>
                <div class="add_footer">
                    <a href="?page=Designations"><button type="button" class="cancel_insert">Close</button></a>
                    <button type="submit" name="update_desc" class="save"> Add</button>
                </div>
            </div>
            <?php
            	if(isset($_POST['update_desc'])){
                    $desc_id = $_POST['Descid'];
                    $descname = $_POST['descname'];
                    $salary = $_POST['salary'];
                    $OVsalary = $_POST['over_salary'];
                    $da = $_POST['da'];
                    $ma = $_POST['ma'];
                    $pf = $_POST['pf'];
                    $sql_update="UPDATE employee_designation SET Desc_status=0 WHERE Desc_id='$desc_id'";
                    $con->query($sql_update);
                    $sql = "INSERT INTO employee_designation (Desc_id, Desc_name, Desc_basic,Desc_overtimesalary, Desc_da, Desc_ma, Desc_pf, Desc_status) VALUES ('$descid','$descname','$salary',$OVsalary,'$da','$ma','$pf',1)";
                    $con->query($sql);
                    echo "<script>window.location.href = '?page=Designations';</script>";
                }

?>
            
        </div>
    </form>
</div>