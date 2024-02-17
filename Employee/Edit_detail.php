<html>

<head>
    <title>Register</title>
</head>
<style>
body {
    margin: 0;
    padding: 0;
    height: 100vh;
    background: linear-gradient(130deg, #e334f6, #3852e2);
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: 'Source Sans Pro', sans-serif;
}

.register {
    background-color: rgb(255, 255, 255);
    width: 30%;
    display: flex;
    justify-content: center;
    align-items: center;
    height: fit-content;
    text-align: center;
    border-radius: 20px;
}

.main_form {
    height: 100%;
    width: 100%;
}

.emp_detailsre {
    height: 100%;
    width: 100%;
    float: left;
    transform: translateX(0px);
    transition: all .3s ease-in;
}

.emp_detailsre>.form_div {
    margin-top: 20px;
    display: flex;
}

.emp_detailsre>.form_div label {
    color: rgb(0, 0, 0);
    margin-left: 70px;
    width: 100px;
    float: left;
    text-align: start;
}

.emp_detailsre>.form_div input {
    box-sizing: border-box;
    font: inherit;
    font-family: inherit;
    display: block;
    width: 50%;
    float: left;
    height: 25px;
    font-size: 14px;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 0;
    box-shadow: none;
    color: #333;
    border-color: #d2d6de;
    text-align: center;
}

.emp_detailsre>.form_div input[type="radio"] {

    margin-left: 36%;
}

.emp_detailsre .add_footer {
    height: 10%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-left: 50px;
    padding-right: 50px;
    padding-top: 10px;
}

.emp_detailsre .add_footer>button,
.emp_detailsre .add_footer>a>button {
    height: 30px;
    width: 70px;
    border-radius: 10px;
    background-color: #3c8dbc;
    border: none;
    color: white;
    letter-spacing: 1px;
    cursor: pointer;
}
</style>

<body>
    <div class="register">
        <?php
        //Register page
    include 'session_check.php';
    include '../common/connection.php';
    $id=$_SESSION['Emp_id'];
    $check="SELECT * FROM employee_details WHERE Emp_id='$id';";
    $data=$con->query($check);
    $empdata=$data->fetch_assoc();
    if($empdata["Emp_status"] == 1)//checking the status of the employee
    {
      echo "<script>window.location.href = 'index.php';</script>";
    }
    else if($empdata["Emp_status"] == 4)
    {
        echo "<script>window.location.href = 'Pending.php';</script>";
    }
    ?>
        <form method="POST" id="register" action="savedata.php" enctype="multipart/form-data">
            <div class="main_form">
                <div class="emp_detailsre">
                    <h1 style="text-align:center;">Employee Register</h1>
                    <div class="form_div">
                        <label for="username">Username</label>
                        <input type="text" id="user" value="<?php echo $empdata['Emp_id']; ?>" name="Username" readonly
                            required>
                    </div>
                    <div class="form_div">
                        <label for="fullname">Full name</label>
                        <input type="text" id="name" name="fullname" value="<?php echo $empdata['Emp_name']; ?>" required>
                    </div>
                    <div class="form_div">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" required>
                    </div>
                    <div class="form_div">
                        <label for="DOB">Date of Birth</label>
                        <input type="date" id="dob" name="DOB" required>
                    </div>
                    <div class="form_div">
                        <label for="moblieno">Mobile no</label>
                        <input type="text" id="mobile" name="mobile" required>
                    </div>
                    <div>
                        <label style=" margin-left:115px; margin-top:5px; color: red; width:51%; text-align:center;"
                            id="notnumber"></label>
                    </div>
                    <div class="form_div" style="width: 25%; align-items:center;">
                        <label for="gender" id="gender">Gender</label>
                        <input id="radiodatamale" type="radio" value="Male" name="gender" >Male
                        <input id="radiodatafemale" type="radio" value="Female" name="gender" >Female
                    </div>
                    <div class="form_div">
                        <label for="photo">Photo</label>
                        <input type="file" name="photo" id="photo">
                    </div>
                    <div class="add_footer">
                        <?php echo "<a href='logout.php'><button type='button' class='cancel_insert'>Log Out</button></a>"; ?>
                        <button onclick="checkdataMOBILE()" type="button" class="next"> Next</button>
                        <script src="javascript/Functions.js?v=<?php echo time()?>"></script>
                    </div>
                </div>
        </form>
    </div>
</body>
</html>