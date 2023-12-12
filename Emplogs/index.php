<html>

<head>
    <title>Biometric attendance system</title>

</head>

<body>
    <div class="header">
        <div class="logo">
            <div class="images">
                <img src="./logoimage.jpeg" alt="Oops,NO Internet" class="image">
            </div>
        </div>
        <div class="titlename">
            Biometric attendance system
        </div>

    </div>
    <div id="mainbodys" class="mainbody">
        <div class="home">
            <div class="lastaction" id="last">

                <script>
                    var firstime = true;

                    function lastentri() {
                        var xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                document.getElementById("last").innerHTML = this.responseText;
                            }
                        };
                        xhttp.open("GET", "lastlog.php", true);
                        xhttp.send();

                    }

                    if (firstime) {
                        lastentri();
                        firstime = false;
                    }
                    setInterval(lastentri, 1000);
                </script>

            </div>
        </div>
    </div>

</body>
<style>
    .home {
        width: 100%;
        height: 100%;

        align-items: center;
        display: flex;
        justify-content: center;
    }

    .lastaction {
        width: 65%;
        height: 55%;
        background: #cbd3d4;
        color: black;
        border-radius: 25px;
        border: 3px solid;
        border-color: blue;

    }

    body {
        margin: 0;
    }

    .header {
        width: 100%;
        height: 12%;
    }

    .mainbody {
        height: 88%;
        width: 100%;
        background: linear-gradient(315deg, #3852e2, #e334f6);
        overflow-y: auto;
    }

    .logo {
        height: 100%;
        background-color: rgb(54, 54, 54);
        float: left;
        width: 10%;
    }

    .image {
        height: 60px;
        width: 60px;
        margin: 3.5px;
        border-radius: 10%;
        border: 3px solid aqua;
    }

    .images {
        width: 67px;
        height: 67px;
        margin-left: 13px;
        margin-top: 7px;
        border-radius: 50%;
    }

    .titlename {
        height: 100%;
        text-align: center;
        justify-content: center;
        display: flex;
        align-items: center;
        background-color: rgb(54, 54, 54);
        color: aqua;
        font-size: 50px;
        float: left;
        width: 90%;
        animation: color-change 8s infinite;
    }

    @keyframes color-change {
        0% {
            color: #3852e2;
        }

        20% {
            color: #4a4ae7;
        }

        40% {
            color: #6637f4;
        }

        50% {
            color: #e334f6;
        }

        60% {
            color: #6637f4;
        }

        80% {
            color: #4a4ae7;
        }

        100% {
            color: #3852e2;
        }
    }




    .container {
        float: left;
        width: 50%;
        background-color: rgb(54, 54, 54);
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: end;
    }
</style>

</html>