<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <style>
        button{
            border:ridge 2px black;
            border-radius: 30px;
            background:  linear-gradient(70deg, #e334f6 , #3852e2);
            height: 30px;
            color: black;
            font-size: medium;
        }
        .Error-in-con{
            
            text-align: center;
            width: 45%;
            color: rgb(3, 3, 3);
            background:  #fff;
            border: solid 2px red;
            border-radius: 15px;
            margin: 0 auto;
        }
        body {
            background:  linear-gradient(70deg, #3852e2, #e334f6);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="Error-in-con">
        <h1>Connection Lost</h1>
        <br>
        <p>Please try again... <button><a href="../login/login.php">Go to Login</a></button></p>
    </div>
</body>
</html>
