<?php   include 'session_check.php';
?>
<div class="changepassword">
    <script src="changepassword/scriptforchange.js?v=<?php echo time()?>"></script>
    <div class="change-container">
        <h2 style="text-align:center; font-size:35px; margin-top: 0;">Change Password</h2>
        <form onsubmit="return validation();" action="./changepassword/change.php" method="post">
            <div class="passchange">
                <label for="cur-password">Current Password : </label>
                <input type="password" id="cur-password" placeholder="Password" name="cur-password" required>
                <input onclick="typechange('cur-password')" type="checkbox" name="" id="">
            </div>
            <label id="cur-passwordinvalid" style="color: red;visibility: hidden; margin: botton 20px;">Not same</label>
            <div class="passchange">
                <label for="new-password">New Password&ensp;&ensp;&ensp; : </label>
                <input type="password" id="new-password" placeholder="Password" name="new-password" required>
                <input onclick="typechange('new-password')" type="checkbox" name="" id="">
            </div>
            <label id="new-passwordinvalid" style="color: red;visibility: hidden;">Not same</label>
            <div class="passchange">
                <label for="con-password">Confirm Password : </label>
                <input type="password" id="con-password" placeholder="Password" name="password" required>
                <input onclick="typechange('con-password')" type="checkbox" name="" id="">
            </div>
            <label id="con-passwordinvalid" style="color: red;visibility: hidden;">Not same</label>
            <div class="passchange">
                <label id="same-password" style="color: red; width:auto;visibility: hidden;">Two password should be
                    same</label>
            </div>
            <div class="passchange">
                <div></div>
                <input type="submit" value="Change" class="submit-button">
                <div></div>
            </div>
            <div class="change_footer">
                <?php
            if (isset($_GET["wrongpassword"]) && $_GET["wrongpassword"] === "true") {
                echo '<div id="passwordresult" style="color:red;">Wrong Password Please try again....</div>';//checking the password
            }
            if (isset($_GET["passwordchanged"]) && $_GET["passwordchanged"] === "true") {
                echo '<div id="passwordresult" style="color: #00ff7b;">Passsword changed successfully.</div>';
            }
            ?>
            </div>
        </form>

    </div>


</div>