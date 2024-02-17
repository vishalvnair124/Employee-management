<?php
//page to view notifications such as employee details updation and register details
include 'session_check.php';
include '../common/connection.php';
$no=101;

?><div class="main_noti">
    <div class="noti_sub">
        <div class="noti_body">
            <div class="head" >
                <h2 align='center'>Update Requests</h2>
            </div>
            <table border='1'>
                <thead style="font-size:24px">
                    <th>SI</th>
                    <th>Employee ID</th>
                    <th>Type</th>
                    <th>Changes</th>
                    <th>Tools</th>
                </thead>
                <tbody id="tabledata">
                    <?php
                  
                    $sql = "SELECT * FROM employee_details WHERE Emp_status='$no'";
                    $query = $con->query($sql);
                    if($query->num_rows)
                    {
                      $i=1;
                    while($row = $query->fetch_assoc()){
                        $position = strpos($row['Emp_id'], 'E');
                        if ($position !== false) {
                            $result = substr($row['Emp_id'], $position);
                        }
                        $theoption = substr($row['Emp_id'], 0, 1);
                      ?>
                    <tr style="  border: 3px solid white;">
                        <td style="font-size:200%;"><?php echo $i; $i++; ?></td>
                        <td style="font-size:200%;"><?php echo $result; ?></td>
                        <?php 
                        if($theoption == 'R')
                            { ?>
                            <td style="font-size:170%;">Register</td>
                            <?php 
                            }
                            else
                            {
                                ?>
                                <td style="font-size:170%;">Update</td>
                                <?php
                            }?>
                        <td>

                            <table style="text-align:left; width: 100%; height:100%; border-collapse: collapse;">
                                <?php
                                $sqlt2 = "SELECT * FROM employee_details WHERE Emp_id='$result'";
                                $queryt2 = $con->query($sqlt2);
                                if($queryt2->num_rows)
                                {
                                    $row2=$queryt2->fetch_assoc();
                                    if($theoption == 'R')
                                    {
                                        if($row2['Emp_name']!=$row['Emp_name'])
                                        {
                                            echo "<tr class='newtable'>";
                                            echo "<td>Name:</td>";
                                            if($row2['Emp_name']=='')
                                            {
                                                echo "<td>NONE</td>";
                                            }
                                            else
                                            {
                                                echo "<td>".$row2['Emp_name']."</td>";
                                            }
                                            echo "<td><span><ion-icon name='arrow-forward-outline'></ion-icon></span></td>";
                                            echo "<td>".$row["Emp_name"]."</td>";
                                            echo "</tr>";
                                        }
                                        if($row2['Emp_Address']!=$row['Emp_Address'])
                                        {
                                            
                                            echo "<tr class='newtable'>";
                                            echo "<td>Address:</td>";
                                            if($row2['Emp_Address']=='0')
                                            {
                                                echo "<td>NONE</td>";
                                            }
                                            else
                                            {
                                                echo "<td>".$row2['Emp_Address']."</td>";
                                            }
                                            echo "<td><span><ion-icon name='arrow-forward-outline'></ion-icon></span></td>";
                                            echo "<td>".$row["Emp_Address"]."</td>";
                                            echo "</tr>";
                                        }
                                        if($row2['Emp_DOB']!=$row['Emp_DOB'])
                                        {
                                            echo "<tr class='newtable'>";
                                            echo "<td>Date of birth:</td>";
                                            if($row2['Emp_DOB']=='0000-00-00')
                                            {
                                                echo "<td>NONE</td>";
                                            }
                                            else
                                            {
                                                echo "<td>".$row2['Emp_DOB']."</td>";
                                            }
                                            echo "<td><span><ion-icon name='arrow-forward-outline'></ion-icon></span></td>";
                                            echo "<td>".$row["Emp_DOB"]."</td>";
                                            echo "</tr>";
                                        }
                                        if($row2['Emp_mobileno']!=$row['Emp_mobileno'])
                                        {
                                            echo "<tr class='newtable'>";
                                            echo "<td>Moble no:</td>";
                                            if($row2['Emp_mobileno']=='0')
                                            {
                                                echo "<td>NONE</td>";
                                            }
                                            else
                                            {
                                                echo "<td>".$row2['Emp_mobileno']."</td>";
                                            }
                                            echo "<td><span><ion-icon name='arrow-forward-outline'></ion-icon></span></td>";
                                            echo "<td>".$row["Emp_mobileno"]."</td>";
                                            echo "</tr>";
                                        }
                                        if($row2['gender']!=$row['gender'])
                                        {
                                            echo "<tr class='newtable'>";
                                            echo "<td>Gender:</td>";
                                            if($row2['gender']=='')
                                            {
                                                echo "<td>NONE</td>";
                                            }
                                            else
                                            {
                                                echo "<td>".$row2['gender']."</td>";
                                            }
                                            echo "<td><span><ion-icon name='arrow-forward-outline'></ion-icon></span></td>";
                                            echo "<td>".$row["gender"]."</td>";
                                            echo "</tr>";
                                        }
                                        if($row2['Emp_Photo']!=$row['Emp_Photo'])
                                        {
                                            echo "<tr class='newtable'>";
                                            echo "<td>Photo:</td>";
                                            if($row2['Emp_Photo']=='')
                                            {
                                                ?>
                                <td>
                                    <img style="border-radius: 50%; object-fit: cover; width:45px; height:45px;"
                                        src="../images/profile.jpg" width="30px" height="30px">
                                </td>
                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                <td>
                                    <img style="border-radius: 50%; object-fit: cover; width:45px; height:45px;"
                                        src="../images/<?php echo $row2['Emp_Photo'] ?>" width="30px" height="30px">
                                </td>
                                <?php
                                            }
                                            echo "<td><span><ion-icon name='arrow-forward-outline'></ion-icon></span></td>";
                                            if($row['Emp_Photo']=='')
                                            {
                                                ?>
                                <td>
                                    <img style="border-radius: 50%; object-fit: cover; width:45px; height:45px;"
                                        src="../images/profile.jpg" width="30px" height="30px">
                                </td>
                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                <td>
                                    <img style="border-radius: 50%; object-fit: cover; width:45px; height:45px;"
                                        src="../images/<?php echo $row['Emp_Photo'] ?>" width="30px" height="30px">
                                </td>
                                <?php
                                            }
                                            echo "</tr>";
                                        }
                                    }
                                    else
                                    {
                                        if($row2['Emp_name']!=$row['Emp_name'] && $row['Emp_name']!='')
                                        {
                                            echo "<tr class='newtable'>";
                                            echo "<td>Name:</td>";
                                            if($row2['Emp_name']=='')
                                            {
                                                echo "<td>NONE</td>";
                                            }
                                            else
                                            {
                                                echo "<td>".$row2['Emp_name']."</td>";
                                            }
                                            echo "<td><span><ion-icon name='arrow-forward-outline'></ion-icon></span></td>";
                                            echo "<td>".$row["Emp_name"]."</td>";
                                            echo "</tr>";
                                        }
                                        if($row2['Emp_Address']!=$row['Emp_Address'] && $row['Emp_Address']!='0')
                                        {
                                            
                                            echo "<tr class='newtable'>";
                                            echo "<td>Address:</td>";
                                            if($row2['Emp_Address']=='0')
                                            {
                                                echo "<td>NONE</td>";
                                            }
                                            else
                                            {
                                                echo "<td>".$row2['Emp_Address']."</td>";
                                            }
                                            echo "<td><span><ion-icon name='arrow-forward-outline'></ion-icon></span></td>";
                                            echo "<td>".$row["Emp_Address"]."</td>";
                                            echo "</tr>";
                                        }
                                        if($row2['Emp_Photo']!=$row['Emp_Photo'])
                                        {
                                            echo "<tr class='newtable'>";
                                            echo "<td>Photo:</td>";
                                            if($row2['Emp_Photo']=='')
                                            {
                                                ?>
                                <td>
                                    <img style="border-radius: 50%; object-fit: cover; width:45px; height:45px;"
                                        src="../images/profile.jpg" width="30px" height="30px">
                                </td>
                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                <td>
                                    <img style="border-radius: 50%; object-fit: cover; width:45px; height:45px;"
                                        src="../images/<?php echo $row2['Emp_Photo'] ?>" width="30px" height="30px">
                                </td>
                                <?php
                                            }
                                            echo "<td><span><ion-icon name='arrow-forward-outline'></ion-icon></span></td>";
                                            if($row['Emp_Photo']=='')
                                            {
                                                ?>
                                <td>
                                    <img style="border-radius: 50%; object-fit: cover; width:45px; height:45px;"
                                        src="../images/profile.jpg" width="30px" height="30px">
                                </td>
                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                <td>
                                    <img style="border-radius: 50%; object-fit: cover; width:45px; height:45px;"
                                        src="../images/<?php echo $row['Emp_Photo'] ?>" width="30px" height="30px">
                                </td>
                                <?php
                                            }
                                            echo "</tr>";
                                        }
                                    }
                                        
                                        
                                }
                            ?>
                            </table>
                        </td>
                        <td>
                            <?php $data=$row['Emp_id']; echo "<a href='?page=Approvechange&id=$data&va=1'><button class='thebuttons' style='height:25px;width:65px;background-color:green; border: 2px solid white; color:white' >Approve</button></a>" ?>
                            <?php $data=$row['Emp_id']; echo "<a href='?page=Approvechange&id=$data&va=0'><button class='thebuttons' style='height:25px;width:65px;background-color:red; border: 2px solid white; color:white'>Reject</button></a>" ?>
                        </td>
                    </tr>
                    <?php
                    }
                  }
                  else
                  {
                    ?>
                    <tr>
                        <td colspan="5">
                            NO Requests
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
</div>