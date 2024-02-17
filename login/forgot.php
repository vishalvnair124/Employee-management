<html>

<head>
    <title>
        Sign in
    </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width initial-scale=0.6">
    <link rel="icon" href="unavailable">
    <link rel="stylesheet" href="login.css?v=<?php echo time()?>">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</head>

<body class="body">
    <div id="theloadscreen" class="thefulldivsend">
        <div class="loading">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
            <h2>Please wait till <br> OPT is sended</h2>
        </div>
    </div>
    <div class="Main">
        <div class="page2" id="pagefor">
            <div class="pbox1">
                <h2 style="margin-top: 0px; margin-bottom:10px;">Email varify</h2>
                <div id="theuserdiv" class="box2">
                    <div class="tx">
                        <label for="Email">Email</label><br>
                    </div>
                    <div class="i">
                        <span class="icon">
                            <ion-icon name="mail-open-outline"></ion-icon>
                        </span>
                    </div>
                    <div class="inbox">
                        <input onkeyup="check_emailv2();" type="text" name="Email" id="Email"
                            placeholder="Enter your Email">
                        <span id="mark" style="color:green; margin-left:40px;visibility:hidden;"
                            class="show_pass_first">
                            <ion-icon name="checkmark-circle-sharp"></ion-icon>
                        </span>
                    </div>
                </div>
                <div style="width:100%;display:flex; flex-direction: row; justify-content:space-around;">
                    <button onclick="window.location.href = 'login.php';" class="button2">
                        <h6>Back</h6>
                    </button>
                    <button onclick="emailsubmit();" class="button2">
                        <h6>Submit</h6>
                    </button>
                </div>

            </div>
        </div>
    </div>
    <script src="login.js?v=<?php echo time()?>"></script>
</body>

</html>