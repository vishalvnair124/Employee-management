<?php
include '../common/connection.php';

$sql = "SELECT employee_details.Emp_id, employee_details.Emp_name, employee_details.Emp_Photo, employee_designation.Desc_name, emp_logs.Log_status
FROM employee_details, emp_logs, employee_designation
WHERE employee_details.Rf_id = emp_logs.Rf_id
AND emp_logs.log_id = (SELECT MAX(log_id) FROM emp_logs) 
AND employee_details.Desc_id = employee_designation.Desc_id";

$result = mysqli_query($con, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    $row = array("Emp_id" => "N/A", "Emp_name" => "N/A", "Log_status" => "N/A");
}

$row['Emp_Photo'] = null;
?>

<div>
  <div class="empimg">
    <img src="<?php echo (!empty($row['Emp_Photo'])) ? '../images/' . $row['Emp_Photo'] : '../images/profile.jpg'; ?>" alt="Oops,No Internet" class="empimage">
  </div>
  <div class="empdetails">
    <pre>
    EMPID        : <?php echo  $row["Emp_id"]; ?><br>
    NAME         : <?php echo  $row["Emp_name"]; ?><br>
    Designation  : <?php echo  $row["Desc_name"]; ?><br>
    STATUS       : <span <?php if ($row["Log_status"] == "IN") {
                            echo 'class="in"';
                        } else {
                            echo 'class="out"';
                        } ?>><?php echo  $row["Log_status"]; ?></span>
  </pre>
  </div>
</div>


<style>
  .empimg {
    float: left;
    height: 100%;
    width: 35%;
    justify-content: center;
    display: flex;
    align-items: center;
  }

  .empdetails {
    float: right;
    height: 100%;
    width: 65%;
    justify-content: center;
    display: flex;
    align-items: center;
    font-size: 27px;
    font-style: normal;
  }

  .empimage {
    height: 70%;
    width: 60%;
    border: 3px solid blue;
  }

  .out {
    background-color: #da0909;
    padding-left: 20px;
    padding-right: 20px;
  }

  .in {
    background-color: #3dff3d;
    padding-left: 20px;
    padding-right: 20px;
  }
</style>