<?php
include '../common/connection.php';
$crtime = date('h:i:s');
$sql = "SELECT employee_details.Emp_id, employee_details.Emp_name, employee_details.Emp_Photo, employee_designation.Desc_name, emp_logs.Log_status,emp_logs.Time_date as toptime,designation_for_employee.Desc_id,designation_for_employee.Desc_status
        FROM employee_details, emp_logs, employee_designation,designation_for_employee
        WHERE employee_details.Rf_id = emp_logs.Rf_id
        AND emp_logs.log_id = (SELECT MAX(log_id) FROM emp_logs) 
        AND designation_for_employee.Desc_status=1
        AND designation_for_employee.Desc_id = employee_designation.Desc_id
        AND employee_details.Emp_id=designation_for_employee.Emp_id";
        
$result = mysqli_query($con, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    $row = array("Emp_id" => "N/A", "Emp_name" => "N/A", "Log_status" => "N/A");
}

?>

<div>
    <div class="empimg">
        <img style=" object-fit: cover; " src="<?php echo (!empty($row['Emp_Photo'])) ? '../images/' . $row['Emp_Photo'] : '../images/profile.jpg'; ?>"
            alt="Oops,No Internet" class="empimage">
    </div>
    <div class="empdetails">
      <h3 style="margin-top:10px; margin-bottom:20px;">DETAILS</h3>
        <table>
            <tr>
                <td>
                    Emp ID
                </td>
                <td>
                    :<div style="width:30px;"></div>
                </td>
                <td>
                    <?php echo  $row["Emp_id"]; ?>
                </td>
            </tr>
            <tr>
                <td>
                    Name
                </td>
                <td>
                    :
                </td>
                <td>
                    <?php echo  $row["Emp_name"]; ?>
                </td>
            </tr>
            <tr>
                <td>
                    Designation
                </td>
                <td>
                    :
                </td>
                <td>
                    <?php echo  $row["Desc_name"]; ?>
                </td>
            </tr>
            <tr style=" color:<?php if ($row["Log_status"] == "IN") {
                  echo "green";
                        } else {
                          echo "red";
                        } ?>">
                <td>
                    <b>STATUS</b>
                </td>
                <td>
                    :
                </td>
                <td>
                    <?php echo  "<b>".$row["Log_status"]."<b>"; ?>
                </td>
            </tr>
        </table>
    </div>
</div>


<style>
.empimg {
    float: left;
    height: 100%;
    width: 40%;
    justify-content: center;
    display: flex;
    align-items: center;
    border-right: 3px solid;
    box-sizing: border-box;
    border-color: white;
}

.empdetails {
    float: right;
    height: 100%;
    width: 60%;
    
    display: flex;
    align-items: center;
    font-size: 27px;
    flex-direction: column;
}

.empimage {
    height: 250px;
    width: 250px;
    border: 3px solid black;
    border-radius: 19px;
}
.empdetails >table
{
  height: 60%;
  width: 80%;
  font-size: 20px;
}
</style>