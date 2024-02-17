

<?php 
include '../common/connection.php';
$emailval=$_GET['em'];
$email="SELECT Emp_id,Emp_name FROM employee_details WHERE Emp_email='$emailval'";
$query=$con->query($email);
$data=$query->fetch_array();
$id=$data['Emp_id'];
$fullname=$data['Emp_name'];
$numbers = '';
for($i = 0; $i < 10; $i++){
    $numbers .= $i;
}
                    
$letters1 = '';
$letters2 = '';
foreach (range('A', 'Z') as $char) {
    $letters1 .= $char;
}
foreach (range('a', 'z') as $char) {
    $letters2 .= $char;
}
$password = $letters1[rand(0, 25)] . $letters2[rand(0, 25)]  . $numbers[rand(0, 9)];
$remainingCharacters = $letters1 . $letters2 . $numbers;
$password .= substr(str_shuffle($remainingCharacters), 0, 6);
$passwordtmp = str_shuffle($password);
setcookie("theempid", "", time() - 36000, "/");
setcookie("theemppass", "", time() - 36000, "/");
$password = password_hash($passwordtmp, PASSWORD_DEFAULT);
setcookie("theempid", "$id", time() + (2 * 60), "/");
setcookie("theemppass", "$password", time() + (2 * 60), "/");
if (session_status() == PHP_SESSION_NONE) {
    // If the session is not started, start it
    session_start();
}$_SESSION['email'] = $email=$emailval;
$_SESSION['passwordtmp'] = $passwordtmp;
$_SESSION['fullname'] =$fullname;
$_SESSION['empid'] = $empid=$id;
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
This is a Password reset email, use below OPT to reset the password. Thank you
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
 Employee ID        : $empid<br>
 Employee Name      : $fullname<br>
 OPT for your reset : $passwordtmp<br>
 </p>
<a href='http://localhost/miniproject/login/login.php' style='text-decoration: none; color: #fff; background-color: #4285f4; padding: 10px 20px; border-radius: 5px; display: inline-block; margin-top: 20px;'>LOGIN</a>
<p align='center'> © 2023 Trackify</p>
</div>                                    
</body>
</html>";


$_SESSION['goback'] = 'location:../login/reset.php';
echo "<script>window.location.href = '../../phpmailer/index.php';</script>";
?>