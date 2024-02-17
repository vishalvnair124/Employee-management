<?php
include 'session_check.php';
$uid=$_GET['id'];
$option=$_GET['va'];
$position = strpos($uid, 'E');
if ($position !== false) {
    $result = substr($uid, $position);
}
$theoption = substr($uid, 0, 1);
if($theoption == 'R')//adding new employee details
{
    if($option==1)
    {
        $data1="UPDATE employee_details
        SET Emp_name = (SELECT Emp_name FROM employee_details WHERE Emp_id = '$uid'),
            gender = (SELECT gender FROM employee_details WHERE Emp_id = '$uid'),
            Emp_Address = (SELECT Emp_Address FROM employee_details WHERE Emp_id = '$uid'),
            Emp_DOB = (SELECT Emp_DOB FROM employee_details WHERE Emp_id = '$uid'),
            Emp_mobileno = (SELECT Emp_mobileno FROM employee_details WHERE Emp_id = '$uid'),
            Emp_Photo = (SELECT Emp_Photo FROM employee_details WHERE Emp_id = '$uid'),
            Emp_status = '1'
        WHERE Emp_id = '$result'";
        $data2="DELETE FROM employee_details WHERE  Emp_id = '$uid'";
        $con->query($data1);
        $con->query($data2);
    }
    else
    {
        $data1="UPDATE employee_details SET Emp_status='3' WHERE  Emp_id = '$result'";
        $data2="DELETE FROM employee_details WHERE  Emp_id = '$uid'";
        $con->query($data2);
        $con->query($data1);
        
    }
}
else
{
    if($option==1)//updating the employee details
    {
        $newdatacheck="SELECT * FROM employee_details WHERE Emp_id='$uid'";
        $olddatacheck="SELECT * FROM employee_details WHERE Emp_id='$result'";
        $new=$con->query($newdatacheck)->fetch_assoc();
        $old=$con->query($olddatacheck)->fetch_assoc();
        if($old["Emp_name"]!=$new["Emp_name"])
        {
            if($new["Emp_name"]!='')
            {
                $name=$new["Emp_name"];
            }
            else
            {
                $name=$old["Emp_name"];
            }
        }
        else
        {
            $name=$old["Emp_name"];
        }
        if($old["Emp_Address"]!=$new["Emp_Address"])
        {
            if($new["Emp_Address"]!='')
            {
                $address=$new["Emp_Address"];
            }
            else
            {
                $address=$old["Emp_Address"];
            }
        }
        else
        {
            $address=$old["Emp_Address"];
        }
        $photo=$new["Emp_Photo"];
        $dataentery="UPDATE employee_details SET Emp_name='$name',Emp_Address='$address',Emp_Photo='$photo' WHERE  Emp_id = '$result'";
        $data2="DELETE FROM employee_details WHERE  Emp_id = '$uid'";
        $con->query($data2);
        $con->query($dataentery);
    }
    else
    {
        $data2="DELETE FROM employee_details WHERE  Emp_id = '$uid'";
        $con->query($data2);
    }
}

echo "<script>window.location.href = 'index.php?page=Notifications';</script>";
?>