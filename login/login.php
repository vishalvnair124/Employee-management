<html>

<head>
    <title>
        Sign in
    </title>
    <meta name="viewport" content="width=device-width initial-scale=0.6">
    <link rel="icon" href="unavailable">
    <link rel="stylesheet" href="login.css?v=<?php echo time()?>">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    

</head>
<?php setcookie("theempid", "", time() - 3600, "/");
setcookie("theemppass", "", time() - 3600, "/"); ?>
<body class="body">
    <div class="Main">
        <div class="page">
            <div class="pbox">
                <h2>Login</h2>
                <form id="login" onsubmit="return validation();" method="post" action="validation.php">
                    <div id="theuserdiv" class="box">
                        <div class="tx">
                            <label for="Username">Username</label><br>
                        </div>
                        <div class="i">
                            <span class="icon">
                                <ion-icon name="person-outline"></ion-icon>
                            </span>
                        </div>
                        <div class="inbox">
                            <input type="text" name="username" id="username" placeholder="Type your username" >
                        </div>
                    </div>
                    <div style="width:100%; margin-bottom:-15px;margin-top:-13px;">
                    <label id="usernameinvalid" style="color: red;visibility: hidden;">Invalid Username</label>
                    </div>
                    <div id="thepassdiv" class="box">
                        <label>Password</label>
                        <br>
                        <div class="i">
                            <span class="icon">
                                <ion-icon name="lock-closed-outline"></ion-icon>
                            </span>
                        </div>
                        <div  class="inbox">
                            <input name="password" id="password" type="password" placeholder="Type your password">
                            <span class="show_pass_first" onclick="show_first();">
                                <ion-icon name="eye-outline"></ion-icon>
                            </span>
                            <span class="hide_pass_first" onclick="show_first();">
                                <ion-icon name="eye-off-outline"></ion-icon>
                            </span>
                            <div class="forgot-div"><a onclick="forgot();">Forgot Password</a></div>
                        </div>
                        <?php
                            if (isset($_GET["wrongpassword"]) && $_GET["wrongpassword"] === "true") {
                                echo '<div id="wrongpassword" style="color:red; margin-top:25px;margin-left:10px;font-family:sans-serif; position:fixed; font-size:13px;">Wrong Password or Username. Please try again.</div>';
                            }
                        ?>
                    </div>
                    <div style="width:20%; top:440px;position:fixed;">
                        <label id="passwordinvalid" style="width:100%;color: red; font-size:11px;"></label>
                    </div>
                    <button type="submit" class="button1">
                        <h6>Login</h6>
                    </button>
                </form>
            </div>
        </div>
    </div>
            <script src="login.js?v=<?php echo time()?>"></script>
</body>

</html>