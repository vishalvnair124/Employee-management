<div style="width:100%;height:92%; display:flex; align-items: center; justify-content: center;">
    <div class="addempin" style="height:530px; margin-top:-110px;">
        <?php
include 'session_check.php';
    include '../common/connection.php';
    //page to add new designation
    $desig_max_sql = "SELECT MAX(Desc_id) AS max FROM employee_designation;";
    $desig_max = $con->query($desig_max_sql);
    $maxdata = $desig_max->fetch_assoc();
    $descid = $maxdata["max"]+1;
    ?>
        <form method="POST">
            <div class="main_form">
                <div class="desc_details">
                    <h1 style="text-align:center;">Designation Details</h1>
                    <div class="form_div">
                        <label for="username">Designation ID</label>
                        <input type="text" id="user" value="<?php echo $descid ?>" name="Descid" readonly required>
                    </div>
                    <div class="form_div">
                        <label for="descname">Designation name</label>
                        <input type="text" id="name" name="descname" required>
                    </div>
                    <div class="form_div">
                        <label for="salary">Basic salary</label>
                        <input type="text" id="salary" name="salary" required>
                    </div>
                    <div class="form_div">
                        <label for="Overtimesalary">Overtime salary</label>
                        <input type="text" id="over_salary" name="over_salary" required>
                    </div>
                    <div class="form_div">
                        <label for="da">Dearness allowance</label>
                        <input type="text" id="da" name="da" required>
                    </div>
                    <div class="form_div">
                        <label for="ma">Medical allowance</label>
                        <input type="text" id="ma" name="ma" required>
                    </div>
                    <div class="form_div">
                        <label for="pf">Provident fund</label>
                        <input type="text" id="pf" name="pf" required>
                    </div>
                    <div class="add_footer">
                        <a href="?page=Designations"><button type="button" class="cancel_insert">Close</button></a>
                        <button type="submit" name="save_desc" class="save"> Add</button>
                    </div>
                </div>
                <?php
            include 'Edit_code/savedesc.php';
            ?>
            </div>
        </form>
    </div>
</div>