<html>

<head>
    <title>Biometric attendance system</title>

</head>

<body>
    <div class="header">
        <div style="letter-spacing: 1px;" class="titlename">
            TRACKIFY
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
    width: 47%;
    height: 47%;
    background: #cdd3d4;
    color: black;
    border-radius: 25px;
    border: 3px solid;
    border-color: white;
    box-shadow: 7px 7px 5px black;
}

body {
    margin: 0;
    font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;
}

.header {
    width: 100%;
    height: 12%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: rgb(54, 54, 54);
}

.mainbody {
    height: 88%;
    width: 100%;
    background: linear-gradient(315deg, #3852e2, #e334f6);
    overflow-y: auto;
}

.image {
    height: 60px;
    width: 60px;
    border-radius: 10%;
    border: 3px solid aqua;
}

.titlename {
    height: 100%;
    text-align: center;
    justify-content: center;
    display: flex;
    align-items: center;
    color: aqua;
    font-size: 50px;
    float: left;
    width: 100%;
    animation: color-change 5s infinite;
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