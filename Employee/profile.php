<div class="per_profile_details">
    <?php   include 'session_check.php';
        include '../common/connection.php';?>
    <div class="update_form">
        <?php 
            $id=$_SESSION['Emp_id'];
            $query="SELECT employee_details.*, employee_designation.Desc_name, designation_for_employee.Desc_id
            FROM employee_details
            INNER JOIN designation_for_employee ON employee_details.Emp_id = designation_for_employee.Emp_id
            INNER JOIN employee_designation ON designation_for_employee.Desc_id = employee_designation.Desc_id
            WHERE employee_details.Emp_id = '$id' AND designation_for_employee.Desc_status = '1';";
            $data=$con->query($query);
            $EMP = $data->fetch_assoc(); ?>
        <div class="emp_details_view">
            <div class="header_view">
                <div></div>
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
                        <h4>STATUS</h4>
                        <?php echo ($EMP['Emp_status']==0)? "<span style='color:red;'>INACTIVE</span>":"<span style='color:green;'>ACTIVE</span>";?>
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
                        <div></div>
                        <?php 
                        $query= "SELECT * FROM employee_details WHERE Emp_id LIKE 'P%' AND Emp_id LIKE '%$id'";
                        $datacount=$con->query($query)->num_rows;  
                        ?>
                        <?php echo "<a href='?page=Edit_per_details'><button style='background-color: lightblue;width:200px; color:black;'>EDIT DETAILS</button></a>" ?>
                        <?php if($datacount > 0){echo "<a href=''><button style='background-color: red;width:200px; color:white;'>PENDING REQUESTS:<b>".$datacount."</b> </button></a>"; } ?>
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>