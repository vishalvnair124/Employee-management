<div style=" margin-top:80px;height: 200px;" class="addcal">
    <?php
    //adding new calender to the company calender
include 'session_check.php';
    include '../common/connection.php';
    $month=array("January","February","March","April","May","June","July","August","September","October","November","December");
    ?>
    <form method="POST">
        <div class="main_form">
        <div style="height: 500px;" class="emp_details">
                <h1 style="text-align:center;">Calendar Details</h1>
                <div class="form_div">
                    <label for="year">Year</label>
                    <select name="year" id="year" required>
                    <option value="">-Select-</option>
                        <?php
                        for($i=2022;$i<=2040;$i++)
                        {
                            echo "<option value=".$i.">".$i."</option>";
                        } 
                        ?>
                    </select>
                </div>
                <div class="add_footer">
                    <a href="?page=Calendar"><button type="button" class="cancel_insert">Close</button></a>
                    <button type="submit" name="save_cal" class="save"> Add</button>
                </div>
            </div>
            <?php
            include 'Edit_code/save_cal.php';
            ?>
        </div>
    </form>
</div>