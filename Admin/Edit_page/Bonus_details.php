<?php
//page to view allowances available
include 'session_check.php';
include '../common/connection.php';
$monthar=array("","January","February","March","April","May","June","July","August","September","October","November","December");
$m_id=$_GET['mid'];
$_SESSION['m_id']=$m_id;
$sql1 = "SELECT  DISTINCT(Bonus_category) FROM bonus_salary WHERE Month_id='$m_id' ORDER BY Bonus_category";
$query1T = $con->query($sql1);
$query1 = $con->query($sql1);
$catgoassoc=$query1T->fetch_assoc();
if($query1T->num_rows>0)
{
    if(isset($_SESSION['cat']))
    {
        $catgo=$_SESSION['cat'];
    }
    else
    {
        $catgo=$catgoassoc['Bonus_category'];
    }
}

else
if($query1T->num_rows>0)
{
    $catgo=$catgoassoc['Bonus_category'];
}
?>
<div style="width:100%;height:92%; display:flex; align-items: center; justify-content: center;">
    <div class="bonus">
        <div class="head">
            <h1 style="margin-left:10px;">
                <?php echo "<a style='text-decoration: none; color:black;'  href='?page=Payrolls'>X</a>" ?></h1>
            <h1>Allowance Details</h1>
            <div style="margin-right: 15px; margin-left: -100px; ">
                <?php echo "<a  href='?page=Createbonus&mid=$m_id''><button style='width:100px;'>Create</button></a>" ?>
            </div>
        </div>
        <?php if($query1T->num_rows>0) { ?>
        <div class="subhead">
            <form style="order:2;" method="post">
                <select onchange="this.form.submit()"
                    style="float:right; height: 30px;color: #333; width: 130px; border-radius:10px; text-align: center;"
                    name="categorys" id="">
                    <?php
                        if(isset($_POST["categorys"])){
                            $catgo=$_POST["categorys"];
                            $_SESSION['cat']=$catgo;
                        }
                        while($catvalues=$query1->fetch_assoc())
                        {
                            if($catvalues['Bonus_category']==$catgo)
                            {
                                echo "<option selected value='".$catvalues['Bonus_category']."'>".$catvalues['Bonus_category']."</option>";
                            }
                            else
                            {
                                echo "<option value='".$catvalues['Bonus_category']."'>".$catvalues['Bonus_category']."</option>";
                            }
                        }
                        ?>
                </select>
            </form>
            <?php 
                $sql = "SELECT  bonus_salary.*,employee_details.Emp_name FROM bonus_salary
                INNER JOIN employee_details ON employee_details.Emp_id=bonus_salary.Emp_id
                WHERE Bonus_category='$catgo' AND Month_id='$m_id' ORDER BY Bonus_category";
                $query = $con->query($sql);
                $count=$query->num_rows;
                ?>
            <div style="order:1;"><b>Bonuses : <?php echo $count ?></b></div>
        </div>
        <div class="newbody">
            <table>
                <thead>
                    <th>SI</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Month</th>
                    <th>Category</th>
                    <th>Salary</th>
                    <th>Tool</th>
                </thead>
                <tbody id="desctabledata">
                    <?php
                    if($query->num_rows)
                    {
                      $i=1;
                    while($row = $query->fetch_assoc()){
                        $Year = substr($row['Month_id'], 0, 4);
                        $month=substr($row['Month_id'], 4, 6);
                      ?>
                    <tr>
                        <td><?php echo $i; $i++; ?></td>
                        <td><?php echo $row['Emp_id']; ?></td>
                        <td><?php echo $row['Emp_name']; ?></td>
                        <td><?php echo $monthar[intval($month)]." ".$Year; ?></td>
                        <td><?php echo $row['Bonus_category']; ?></td>
                        <td><?php echo "₹".number_format($row['Bonus_salary']); ?></td>
                        <td>
                            <?php $data=$row['Bonus_id']; echo "<a href='?page=delete_bonus&bid=$data'><button class='thebuttons' style='height:25px;width:70px;background-color:red; color:white'>Remove</button></a>" ?>
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
        <?php } else{?>
        <div style=" height:98%; width:100%;display:flex; align-items: center; justify-content: center;">
            <h1 style="font-size:90px">NO DATA</h1>
        </div>
        <?php }  ?>
    </div>
</div>