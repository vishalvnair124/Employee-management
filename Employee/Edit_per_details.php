<?php
include 'session_check.php';
    include '../common/connection.php';
    $$id=$_SESSION['Emp_id'];
    $query="SELECT * FROM employee_details WHERE Emp_id='$id'";
    $data=$con->query($query);
    $EMP = $data->fetch_assoc();
    //edit employee details
?>
<div class="edit_div">
    <div class="data">
        <form method="POST" enctype="multipart/form-data">
            <h2>EDIT DETAILS</h2>
            <table class="edit_table">
            <tr>
                    <td>
                        <label for="Username">Username</label>
                    </td>
                    <td>
                        <input type="text" id="name" name="Username" value="<?php echo $EMP['Emp_id'];?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="fullname">Full name</label>
                    </td>
                    <td>
                        <input type="text" id="name" name="fullname" value="<?php echo $EMP['Emp_name'];?>"required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="address" >Address</label>
                    </td>
                    <td>
                        <input type="text" id="address" value="<?php echo $EMP['Emp_Address'];?>" name="address" >
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="photo" >Photo</label>
                    </td>
                    <td>
                        <input value="<?php echo $EMP['Emp_Photo'];?>" style="width:200px" type="file" name="photo" id="photo">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <label for="remove">Do you want to remove Existing photo?</label><input style="margin-left:20px; margin-top:-3px;" type="checkbox" name="doyou" value="1">
                    </td>
                    <td>
                        
                    </td>
                </tr>
                <tr class="footer_tr">
                    <td colspan="2">
                        <div class="Edit_footer">
                            <?php echo "<a href='?page=profile'><button  type='button' class='cancel_edit' >Close</button></a>" ?>
        	                <button type="submit" class="save_edit" name="update" >Update</button>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
    if(isset($_POST['update'])){
        
        $empid = $_POST['Username'];
        $temp_id=$empid;
        $temp_id = substr($temp_id, 1);
        $doyou = $_POST['doyou'];
        $fullname = $_POST['fullname'];
        $address = $_POST['address'];
        $filename = $_FILES['photo']['name'];
        $checkpsql="SELECT * FROM employee_details WHERE Emp_id LIKE 'P%'";
        $covalue=$con->query($checkpsql)->num_rows;
        $id="P".$covalue.$id;
        $tsqw=$covalue.$temp_id;
        $tsqw=$tsqw*1000;
        if(!empty($filename)){ //photo transfer
            move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);
            $sqldata="INSERT INTO employee_details(Emp_id, Emp_name, Emp_Address,Rf_id, Emp_Photo, Emp_status) VALUES ('$id','$fullname','$address','$tsqw','$filename','101')";
        }
        else
        {
            if($doyou==1) //photo removal
            {
                $sqldata="INSERT INTO employee_details(Emp_id, Emp_name, Emp_Address,Rf_id, Emp_status) VALUES ('$id','$fullname','$address','$tsqw','101')";
            }
            else
            {
                $filenamev1="SELECT Emp_Photo FROM employee_details WHERE Emp_id='$empid'";
                $file=$con->query($filenamev1)->fetch_assoc();
                $sqldata="INSERT INTO employee_details(Emp_id, Emp_name, Emp_Address,Rf_id, Emp_Photo, Emp_status) VALUES ('$id','$fullname','$address','$tsqw','".$file['Emp_Photo']."','101')";
            }
            
        }
        
        $con->query($sqldata);
        echo "<script>window.location.href = '?page=profile';</script>";
    }
?>