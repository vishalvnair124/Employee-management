<?php
include 'session_check.php';
include '../common/connection.php';
$id=$_SESSION['Emp_id'];
    $check="SELECT * FROM employee_details WHERE Emp_id='$id';";
    $data=$con->query($check);
    $empdata=$data->fetch_assoc();
    if($empdata["Emp_status"] == 1)//checking the status of the employee
    {
      echo "<script>window.location.href = 'index.php';</script>";
    }
    else if($empdata["Emp_status"] == 3)
    {
        echo "<script>window.location.href = 'Edit_detail.php';</script>";
    }
?>
<html>

<head>
    <title>PENDING</title>
</head>

<body>
    <div style="height:100%; width:100%; display:flex; flex-direction: column;   justify-content: center; align-items: center;">
        <h1 style="font-size:80px; font-family: sans-serif;">PENDING APPROVAL</h1>
        <a href="logout.php">
            <button style="height:100px; width:300px; font-size:40px; border-radius:20px;">LOGOUT</button>
        </a>
    </div>
</body>

</html>