<?php 
//searching the designation
include '../session_check.php';
include '../../common/connection.php';
$search = $_POST['input'];
                    $sql = "SELECT employee_details.*, designation_for_employee.*, employee_designation.* FROM employee_details 
                    INNER JOIN designation_for_employee ON designation_for_employee.Emp_id=employee_details.Emp_id 
                    INNER JOIN employee_designation ON  employee_designation.Desc_id=designation_for_employee.Desc_id
                    WHERE Emp_status!=2 AND designation_for_employee.Desc_status='1' AND employee_details.Emp_id  NOT LIKE 'U%' AND employee_details.Emp_id  NOT LIKE 'P%' AND (Emp_name LIKE '$search%' OR employee_details.Emp_id LIKE '$search%' OR Desc_name LIKE '$search%') ORDER BY CAST(SUBSTRING(employee_details.Emp_id, 2) AS SIGNED)  ;";
                    $query = $con->query($sql);
                    if($query->num_rows)
                    {
                      $i=1;
                    while($row = $query->fetch_assoc()){
                      ?>
<tr>
    <td><?php echo $i; $i++; ?></td>
    <td><?php echo $row['Emp_id']; ?></td>
    <td><img style="border-radius: 50%; object-fit: cover; width:45px; height:45px;"
            src="<?php echo (!empty($row['Emp_Photo']))? '../images/'.$row['Emp_Photo']:'../images/profile.jpg'; ?>"
            width="30px" height="30px"> </td>
    <td><?php echo $row['Emp_name']?></td>
    <td><?php echo $row['Desc_name']; ?></td>
    <td><?php echo $row['Emp_DOJ']; ?></td>
    <td><?php echo $row['Emp_mobileno']; ?></td>
    <td><?php 
                          if($row['Emp_status']==0) 
                          {
                            echo "<p style='color: red; font-weigth:none;'>INACTIVE</p>";
                          }
                          elseif($row['Emp_status']==1)
                          {
                            echo "<p style='color: green;'>ACTIVE</p>";
                          }
                          elseif($row['Emp_status']==2)
                          {
                            echo "<p style='color: red;'>EX Emp</p>";
                          }
                          else
                          {
                            echo "<p style='color: blue;'>PENDING</p>";
                          }
                          ?></td>
    <td>
        <?php $data=$row['Emp_id']; echo "<a href='?page=page_controller&id=$data&pageto=1'><button class='thebuttons' style='border-radius:5px; height:30px;width:90px;background-color:slategrey; border: 2px solid white; color:white'>View Details</button></a>" ?>
    </td>
</tr>
<?php
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