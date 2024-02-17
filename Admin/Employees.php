<?php
//page to view all employees details
include 'session_check.php';
  include '../common/connection.php';
  ?>
<div class="Employees">
    <div class="head" style="z-index:1;">
        <a href="?page=addemp"><button>ADD</button></a>
        <h2>Employees Details</h2>
        <form method="post">
            <input style="border-radius:20px;" id="search" type="text" placeholder="Search" name="sevalue">
        </form>
        <script type="text/javascript">
          $(document).ready(function()
          {
            $('#search').keyup(function()
            {
              
              var input =$(this).val();
                $.ajax({
                  url:"Edit_code/emp_sea.php",
                  method: "POST",
                  data:{input:input},
                  success:function(data)
                  {
                    $("#tabledata").html(data);
                  }
                })
            })
          })
        </script>
    </div>
    <div class="data2">
        <div class="employee_detail">
            <table >
                <thead>
                  <th>SI</th>
                  <th>Employee ID</th>
                  <th>Photo</th>
                  <th>Name</th>
                  <th>Designation</th>
                  <th>Date of Join</th>
                  <th>Mobile No</th>
                  <th>Status</th>
                  <th>Tools</th>
                </thead>
                <tbody id="tabledata">
                  <?php
                  
                    $sql = "SELECT employee_details.*, designation_for_employee.*, employee_designation.*
                    FROM employee_details
                    INNER JOIN designation_for_employee ON employee_details.Emp_id = designation_for_employee.Emp_id
                    INNER JOIN employee_designation ON designation_for_employee.Desc_id = employee_designation.Desc_id
                    WHERE employee_details.Emp_id LIKE 'E%' AND designation_for_employee.Desc_status='1'
                    ORDER BY CAST(SUBSTRING(employee_details.Emp_id, 2) AS SIGNED);";
                    $query = $con->query($sql);
                    if($query->num_rows)
                    {
                      $i=1;
                      $ji=1;
                      $count=$query->num_rows;
                    while($row = $query->fetch_assoc()){
                      ?>
                        <tr style="opacity: 0; z-index:0;" id="<?php echo $i; ?>">
                          <td><?php echo $i; $i++; ?></td>
                          <td><?php echo $row['Emp_id']; ?></td>
                          <td><img style="border-radius: 50%; object-fit: cover; width:45px; height:45px;" src="<?php echo (!empty($row['Emp_Photo']))? '../images/'.$row['Emp_Photo']:'../images/profile.jpg'; ?>" width="30px" height="30px"> </td>
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
                </tbody>
              </table>
              <script>
                trans();
                function trans() {
                    for (var i = 1; i <= <?php echo $count; ?>; i++) {
                        var row = document.getElementById(i);
                        row.style.transform= "rotateX(90deg)";
                    }
                    for (var i = 1; i <= <?php echo $count; ?>; i++) {
                        setTimeout(function(i) {
                            var row = document.getElementById(i);
                            if (row) {
                                row.style.opacity = "1";
                                for (var p = 90; p >= 0; p--) {
                                    setTimeout(function(p) {
                                        if (row) {
                                            row.style.transform = 'rotateX(' + p + 'deg)';
                                        }
                                    }, (90 - p) * 1.5, p);
                                }
                            }
                        }, i * 100, i);
                    }

                }
                </script>
        </div>

    </div>
</div>
