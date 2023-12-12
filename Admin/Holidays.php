<?php
include 'session_check.php';
  include '../common/connection.php';
  $monthar=array("","January","February","March","April","May","June","July","August","September","October","November","December");
  $month_data = date('Y-m');
  ?>
<div class="holidays">
    <div class="head">
        <a href="?page=addholi"><button>ADD</button></a>
        <h2>Holidays Details</h2>
        <form method="post">
        <input value="<?php
            if(isset($_POST['month_date']))
            {
                $month_data=$_POST['month_date'];
            }
            list($Year,$month) = explode('-', $month_data);
            $mon_id=$Year.$month;
            echo $month_data;
        ?>" 
        type="month" onchange="this.form.submit()" name="month_date" required>
        </form>
    </div>
    <div class="holi_data">
        <div class="holi_detail">
        <table >
                <thead>
                  <th>SI</th>
                  <th>Year</th>
                  <th>Month</th>
                  <th>Day</th>
                  <th>Tools</th>
                </thead>
                <tbody >
                  <?php
                    $sql = "SELECT * FROM holidays WHERE Month_id='$mon_id' ORDER BY day";
                    $query = $con->query($sql);
                    if($query->num_rows)
                    {
                      $i=1;
                    while($row = $query->fetch_assoc()){
                      ?>
                        <tr style="font-size: 20px;">
                          <td><?php echo $i; $i++;?></td>
                          <td><?php echo $Year; ?></td>
                          <td><?php echo $monthar[intval($month)]; ?></td>
                          <td><?php echo $row['day']; ?></td>
                          <td>
                          <?php $mid=$row['Month_id']; $day=$row['day']; echo "<a href='?page=delete_holi&mid=$mid&day=$day'><button class='view-emp' >Delete</button></a>" ?>                            
                          </td>
                        </tr>
                      <?php
                    }
                  }
                  else
                  {
                    ?>
                    <tr>
                      <td colspan="8">
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