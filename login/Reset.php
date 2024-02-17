<html>

<head>
    <title>
        Sign in
    </title>
    <meta name="viewport" content="width=device-width initial-scale=0.6">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="icon" href="unavailable">
    <link rel="stylesheet" href="login.css?v=<?php echo time()?>">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>

<body class="body">
    <?php if(isset($_COOKIE['theempid']))
    {
        $id=$_COOKIE['theempid'] ;
    }
    else
    {
        echo "<script>alert('Password Time out')</script>";
        echo "<script>window.location.href = 'login.php';</script>";
    }?>
    <div class="Main">
        <div class="page2" id="pagefor">
            <div class="pbox3">
                <h2 style="margin-top: 0px; margin-bottom:10px;">Token Enter</h2>
                <div id="theuserdiv" class="box3">
                    <div class="tx">
                        <label style="font-family:  sans-serif;" for="Token">Token</label><br>
                    </div>
                    <div class="i">
                        <span class="icon">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                        </span>
                    </div>
                    <div class="inbox">
                        <input type="text" name="Token" id="Token" placeholder="Enter your Token">
                        <span id="mark" style="color:green; margin-left:40px;visibility:hidden;"
                            class="show_pass_first">
                            <ion-icon name="checkmark-circle-sharp"></ion-icon>
                        </span>
                    </div>
                </div>
                <div  ><label id="wrongtoken" style="font-family:  sans-serif; color:red; visibility:hidden;"></label></div>
                <div style="width:100%;display:flex;  flex-direction: row; justify-content:space-around;">
                    <button onclick="window.location.href = 'login.php';" class="button3">
                        <h6>Back</h6>
                    </button>
                    <button onclick="optcheck('<?php echo $id;?>');" class="button3">
                        <h6>Submit</h6>
                    </button>
                </div>
            </div>

            <div class="pbox4">
                    <h2 style="margin-top: 0px; margin-bottom:10px;">New Password</h2>
                    <div id="newpassbar" class="box4"  >
                        <div class="tx">
                            <label id="label11" style="font-family:  sans-serif;" for="Password">New Password</label><br>
                        </div>
                        <div class="i">
                            <span class="icon">
                                <ion-icon name="lock-closed-outline"></ion-icon>
                            </span>
                        </div>
                        <div class="inbox">
                            <input type="password" name="Password" id="Password" placeholder="Enter your new password">
                            <span id="mark" style="color:green; margin-left:40px;visibility:hidden;"
                                class="show_pass_first">
                                <ion-icon name="checkmark-circle-sharp"></ion-icon>
                            </span>
                        </div>
                    </div>
                    <div id="pass2div" class="box4">
                        <div class="tx">
                            <label id="label22" style="font-family:  sans-serif;" for="Password">Conform Password</label><br>
                        </div>
                        <div class="i">
                            <span class="icon">
                                <ion-icon name="lock-closed-outline"></ion-icon>
                            </span>
                        </div>
                        <div class="inbox">
                            <input type="password" name="Password1" id="Password2" placeholder="Rewrite your new password">
                            <span id="mark" style="color:green; margin-left:40px;visibility:hidden;"
                                class="show_pass_first">
                                <ion-icon name="checkmark-circle-sharp"></ion-icon>
                            </span>
                        </div>
                    </div>
                    <div id="wrongtoken"><label style="font-family:  sans-serif; color:red; " id="formatwrong"></label>
                    </div>
                    <div style="width:100%;display:flex;  flex-direction: row; justify-content:space-around;">
                        <button onclick="window.location.href = 'login.php';" class="button3">
                            <h6>Back</h6>
                        </button>
                        <button onclick="validatepass2()" name="reset" class="button3">
                            <h6>Submit</h6>
                        </button>

                    </div>
            </div>
        </div>
    </div>
    <script src="login.js?v=<?php echo time()?>"></script>
</body>

</html>