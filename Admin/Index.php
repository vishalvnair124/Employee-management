<html>

<head>
    <title>The Admin Panel</title>
    <link rel="stylesheet" href="CSS/Style.css?v=<?php echo time()?>">
    <link rel="stylesheet" href="../common/Common_style.css?v=<?php echo time()?>">
    <link rel="icon" href="unavailable">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>

    <div id="bodyva">

        <?php
    include 'session_check.php';
    include '../common/connection.php';
    if(isset($_SESSION['init']))
    {
        $val=1;
    }
    else
    {
        $val= 0;
        $_SESSION['init']=1;
    }
    $checkno="SELECT Emp_id FROM employee_details WHERE Emp_status='101'";
    $count=$con->query($checkno)->num_rows;

    ?>
        <script>
        if (0 == <?php echo $val ?>) {
            var body = document.getElementById('bodyva');
            body.style.transform = "scaleX(0)";
        }
        </script>
        <div class="top-bar">
            <img src="../images/logo.png" alt="Logo">
            <h1 style="letter-spacing: 1px;" id="thetitle">TRACKIFY</h1>
            <button onclick="logout()" Style='float:right;'>Logout</button>
            <script>
            function logout() {
                window.location.href = 'logout.php';
            }
            </script>
        </div>
        <div class="main-body">
            <div class="side-menu" id="thesidebar">
                <ul id="theul" style="height:100%;">
                    <li style="order:1;" class="head">PAGES</li>
                    <li style="order:3" class="option"><a href="?page=Dashboard">Dashboard</a></li>
                    <li style="order:4" class="option">
                        <span onclick="opendata()">Attendance <span class="icon">
                                <ion-icon class="down" name="caret-down-outline">
                            </span></span>
                        <ul class="sub_tree">
                            <li class="option"><a href="?page=Attendance">Daily Attendance</a></li>
                            <li class="option"><a href="?page=Monthly_attendance">Monthy Attendance</a></li>
                        </ul>
                    </li>
                    <li style="order:5" class="option"><a href="?page=Employees">Employees </a></li>
                    <li style="order:6" class="option"><a href="?page=Designations">Designations</a></li>
                    <li style="order:7" class="option"><a href="?page=Payrolls">Payroll</a></li>
                    <li style="order:8" class="option"><a href="?page=Calendar">Calendar</a></li>
                    <li style="order:10" class="option"><a href="?page=changepassword">Changepassword</a></li>
                    <?php if($count==0)
                { ?>
                    <li style="order:11" class="option"><a href="?page=Notifications">Notifications</a></li>
                    <?php 
                }
                else
                { ?>
                    <li style="order:2" class="option"><a href="?page=Notifications">Notifications <div
                                style="border-radius:50%;height:20px; width:20px; margin-top:-20px; margin-left:5px; background-color:red; font-size:55%; display:flex; align-items:center; justify-content:center; color:white;">
                                <b><?php echo $count; ?></b>
                            </div> </a></li>
                    <?php
                }
                ?>
                    <li style="order:13; opacity: 0; height:20px;" class="option"><a>Changepassword</a></li>
                </ul>
            </div>
            <script>
            function opendata() {
                const liview = document.querySelector('.icon');
                const liviewicon = document.querySelector('.sub_tree');
                if (liview.classList.contains('active')) {
                    liview.classList.remove('active');
                    liviewicon.classList.remove('active');
                } else {
                    liview.classList.add('active');
                    liviewicon.classList.add('active');
                }
            }
            </script>
            <div class="main-content" id="thefirsthead">
                <?php
            if (isset($_GET['page'])) {
                $page = $_GET['page'] . '.php';
                if (file_exists($page)) {
                    include($page);
                } 
                else 
                {
                    if(file_exists("Edit_page/$page"))
                    {
                        include("Edit_page/$page");
                    }
                    else
                    {
                        if(file_exists("Edit_code/$page"))
                        {
                            include("Edit_code/$page");
                        }
                        else
                        {
                            echo "Page not found!";
                        }
                        
                    }
                }
            } 
            else 
            {
                include('Dashboard.php'); 
            }
            ?>
            </div>
            <script>
            var row2 = document.getElementById('thesidebar');
            window.onload = function() {
                setTimeout(callassemble, 800);
                if (0 == <?php echo $val ?>) {
                    listassamble();
                    setTimeout(thesidebar, 500);
                    setTimeout(trackdata, 80);
                }
                else
                {
                    row2.style.opacity = 1;
                }
            };

            function trackdata() {
                qw=1;
                var title = document.getElementById('thetitle');
                for (var p = 1; p <40; p++) {
                    setTimeout(function(p) {
                        if (row2) {
                            title.style.letterSpacing = ""+qw+"px";
                           if(p<20)
                           {
                            qw++;
                           }
                           else
                           {
                            qw--;
                           }
                        }
                    }, p * 10, p);
                }
            }

            function thesidebar() {
                row2.style.opacity = 1;
                for (var p = 0; p <= 300; p++) {
                    setTimeout(function(p) {
                        if (row2) {
                            row2.style.transform = "translateX(" + -(300 - p) + "px)";
                        }
                    }, p * 1, p);
                }

            }

            function listassamble() {
               
                row2.style.transform = "translateX(-300px)";
                row2.style.opacity = 0;
                for (var p = 0; p <= 10; p++) {
                    (function(p) {
                        setTimeout(function() {
                            if (body) {
                                var r = p / 10;
                                body.style.transform = "scaleX(" + r + ")";
                            }
                        }, p * 11);
                    })(p);
                }
                var row = document.getElementById('theul');
                row.style.overflowY = 'auto';
                var children = row.children;
                var row3 = document.getElementById('thefirsthead');
                row3.style.opacity = "0";
                for (var p = 0; p <= 10; p++) {
                    (function(p) {
                        setTimeout(function() {
                            if (row3) {
                                var r = p / 10;
                                row3.style.opacity = r;
                            }
                        }, p * 80);
                    })(p);
                }
                for (var i = 1; i < children.length; i++) {
                    children[i].style.transform = "rotateX(90deg)";
                    children[i].style.opacity = "0";
                }
                for (var i = 1; i < children.length; i++) {
                    setTimeout(function(i) {
                        var child = children[i];
                        if (child) {
                            for (var p = 0; p <= 100; p++) {
                                setTimeout(function(p) {
                                    if (child) {
                                        child.style.transform = "rotateX(" + (90 - p) + "deg)";
                                        child.style.opacity = p / 100;
                                    }
                                }, p * 5, p);
                            }
                        }
                    }, i * 200, i);
                }
            }
            </script>
        </div>
    </div>
</body>
<script src="javascript/Functions.js?v=<?php echo time()?>"></script>

</html>