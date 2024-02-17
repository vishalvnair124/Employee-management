<?php
include 'session_check.php';
                include '../common/connection.php';
            	if(isset($_POST['add'])){
                    $empid = $_POST['Username'];
                    $rf = substr($empid, 1);
                    $fullname = $_POST['fullname'];
                    $email = $_POST['email'];
                    $address = "0";
                    $dob = "0000-00-00";
                    $mobile = '0';
                    $gender = "";
                    $filename ="";
                    $doj = $_POST['DOJ'];
                    $des_id = $_POST['desc_name'];
                    $desfrom =  date('Ym', strtotime($_POST['Des_from']));
                    $desto =  date('Ym', strtotime($_POST['Des_to']));
                    $numbers = '';
                    for($i = 0; $i < 10; $i++){
                        $numbers .= $i;
                    }
                    
                    $letters1 = '';
                    $letters2 = '';
                    $special = [ '@', '#', '$', '%',  '&', '*'];
                    

                    foreach (range('A', 'Z') as $char) {
                        $letters1 .= $char;
                    }
                    foreach (range('a', 'z') as $char) {
                        $letters2 .= $char;
                    }

                    $password = $letters1[rand(0, 25)] . $letters2[rand(0, 25)] . $special[rand(0, count($special) - 1)] . $numbers[rand(0, 9)];//random password generate

                    $remainingCharacters = $letters1 . $letters2 . implode('', $special) . $numbers;
                    $password .= substr(str_shuffle($remainingCharacters), 0, 6);

                    $passwordtmp = str_shuffle($password);
                    $password = password_hash($passwordtmp, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO employee_details(Emp_id, Emp_password, Emp_name, Gender, Desc_id, Emp_address, Emp_DOB, Emp_DOJ, Emp_mobileno, Emp_email, Rf_id, Emp_photo, Emp_status) VALUES ('$empid','$password','$fullname','$gender','$des_id','$address ','$dob','$doj','$mobile','$email','$rf', '$filename',3)";
                    $sql1="INSERT INTO designation_for_employee(Emp_id, Desc_id, Desc_from_date, Desc_to_date, Desc_status) VALUES ('$empid','$des_id','$desfrom','$desto',1)";
                    $con->query($sql);
                    $con->query($sql1);
                    session_start(); // Start the session
                    $_SESSION['email'] = $email;
                    $_SESSION['passwordtmp'] = $passwordtmp;
                    $_SESSION['fullname'] =$fullname;
                    $_SESSION['empid'] = $empid;
                    $_SESSION['subject']="Welcome $fullname";
                    
                    $_SESSION['message'] = "<!DOCTYPE html>
                    <html lang='en'>
                    <head>
                        <meta charset='UTF-8'>
                        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                        <title>Welcome to TRACKMATE</title>
                        <style>
                            body {
                                font-family: Arial, sans-serif;
                                background-color: #f4f4f4;
                                color: #333;
                            }
                            .container {
                                max-width: 600px;
                                margin: 0 auto;
                                padding: 20px;
                                background: #ffffff;
                                border-radius: 10px;
                                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                            }
                            h2 {
                                text-align: center;
                                color: #333;
                            }
                            .content {
                                padding: 20px;
                                margin: 20px 0;
                                background: #f9f9f9;
                                border-radius: 5px;
                            }
                            .footer {
                                text-align: center;
                                margin-top: 30px;
                                color: #666;
                            }
                        </style>
                    </head>
                    <body>
                        <div class='container'>
                            <h2>Welcome $fullname</h2>
                            <div class='content'>
<p>
Dear $fullname,
<br>
A warm welcome to [Company Name]! We're delighted to have you as part of our team. Your skills and talents will undoubtedly enhance our success. If you have any queries, don't hesitate to ask. Here's to a fantastic journey with us!
<br>
Best,
<br>
Sooraj B
<br>
CEO,[Company Name]
</p>
</div>           
<p>Take one minute to set up your profile</p>
<p>
 Employee ID       : $empid<br>
 Employee Name     : $fullname<br>
 Employee Password : $passwordtmp<br>
 </p>
<a href='http://localhost/miniproject/login/login.php' style='text-decoration: none; color: #fff; background-color: #4285f4; padding: 10px 20px; border-radius: 5px; display: inline-block; margin-top: 20px;'>LOGIN</a>
<p align='center'> © 2023 Trackify</p>
</div>                   
</body>
</html>";//sending email
   
                    
                    $_SESSION['goback'] = 'location:../Admin/?page=Employees';
                    echo "<script>window.location.href = '../phpmailer/index.php';</script>";
                }

            