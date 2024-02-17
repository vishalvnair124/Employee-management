<html>

<head>
    <link rel="stylesheet" href="Style.css?v=<?php echo time()?>">
    <link rel="icon" href="unavailable">
    <link rel="stylesheet"  href="../common/Common_style.css?v=<?php echo time()?>">
    <title>Biometric attendance system</title>


</head>

<body>
    <?php
    include 'session_check.php';
    include '../common/connection.php';
    $id=$_SESSION['Emp_id'];
    $EMPsql = "SELECT * FROM employee_details WHERE Emp_id='$id';";
    $empquery = $con->query($EMPsql);
    $row = $empquery->fetch_assoc();
    if($row["Emp_status"] == 3)//checking the status of the employee
    {
      echo "<script>window.location.href = 'Edit_detail.php';</script>";
    }
    else if($row["Emp_status"] == 4)
    {
        echo "<script>window.location.href = 'Pending.php';</script>";
    }

    ?>
    <div class="top-bar">
        <img src="../images/logo.png" alt="Logo">
        <h1 style="letter-spacing: 1px;" id="thetitle">TRACKIFY</h1>
        <button onclick="logout()">Logout</button>
        <script>
            function logout() {
                window.location.href = 'logout.php';
            }
        </script>
    </div>
    <div class="main-body">
        <div class="side-menu">
            <ul>
                <li class="head">MENU</li>
                <li class="option"><a href="?page=home">Dashboard</a></li>
                <li class="option"><a href="?page=attendace">Attendace</a></li>
                <li class="option"><a href="?page=profile">Profile</a></li>
                <li class="option"><a href="?page=payroll">Payroll</a></li>
                <li class="option"><a href="?page=Calendar">Calendar</a></li>
                <li class="option"><a href="?page=changepassword">Change Password</a></li>
            </ul>
        </div>
        <div class="main-content">
            <?php
            if (isset($_GET['page'])) {
                $page = $_GET['page'] . '.php';
                if (file_exists($page)) {
                    include($page);
                } else {
                    echo "Page not found!";
                }
            } else {
                include('home.php');
            }
            ?>
        </div>


    </div>

</body>

</html>