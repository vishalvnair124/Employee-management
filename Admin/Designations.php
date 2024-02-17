<?php
//page to view the details of the designation
include 'session_check.php';
  include '../common/connection.php';
  ?>
<div class="Designation">
    <div class="head" style="z-index:3;">
        <a href="?page=adddesc"><button>ADD</button></a>
        <h2>Designation Details</h2>
        <form method="post">
            <input style="border-radius:20px;" id="search" type="text" placeholder="Search" name="sevalue">
        </form>
        <script type="text/javascript">
        $(document).ready(function() {
            $('#search').keyup(function() {

                var input = $(this).val();
                $.ajax({
                    url: "Edit_code/desc_sea.php",
                    method: "POST",
                    data: {
                        input: input
                    },
                    success: function(data) {
                        $("#desctabledata").html(data);
                    }
                })
            })
        })
        </script>
    </div>
    <div class="des_data">
        <div class="des_detail">
            <table>
                <thead>
                    <th>SI</th>
                    <th>Designation Name</th>
                    <th>Basic salary</th>
                    <th>Overtime Salary</th>
                    <th>Dearness allowance</th>
                    <th>Medical allowance</th>
                    <th>Provident fund</th>
                    <th>Tools</th>
                </thead>
                <tbody id="desctabledata">
                    <?php
                    $sql = "SELECT * FROM employee_designation WHERE Desc_status=1";
                    $query = $con->query($sql);
                    if($query->num_rows)
                    {
                      $i=1;
                    while($row = $query->fetch_assoc()){
                      ?>
                    <tr>
                        <td><?php echo $i; $i++; ?></td>
                        <td><?php echo $row['Desc_name']?></td>
                        <td><?php echo "₹".number_format($row['Desc_basic']); ?></td>
                        <td><?php echo "₹".number_format($row['Desc_overtimesalary']); ?></td>
                        <td><?php echo "₹".number_format($row['Desc_da']); ?></td>
                        <td><?php echo "₹".number_format($row['Desc_ma']); ?></td>
                        <td><?php echo "₹".number_format($row['Desc_pf']); ?></td>
                        <td>
                            <?php $data=$row['Desc_id']; echo "<a href='?page=update_desc&id=$data'><button class='thebuttons' style='height:25px;width:60px;background-color:green; color:white'>Edit</button></a>" ?>
                            <?php echo "<a href='?page=delete_desc&id=$data'><button class='thebuttons' style='height:25px;width:60px;background-color:red; color:white'>Delete</button></a>" ?>
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
        </div>

    </div>
</div>