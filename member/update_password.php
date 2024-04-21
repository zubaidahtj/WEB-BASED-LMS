<?php
include "connection.php";
include "navbar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>

    <style type="text/css">
        body
        {
            height:650px;
            background-color: #f6f6e9;
        }
        .wrapper
        {
            width: 350px;
            height: 400px;
            margin: 50px auto;
            background-color: #dfb160;
            opacity: .8;
            color: black;
            padding: 20px 10px;
        }
        .form-control
        {
            width: 300px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div style="text-align: center;">
            <h1 style="text-align: center; font-size: large; font-family:'Times New Roman', Times, serif">
            Change Your Password
            </h1> 
        </div>
        <div style="padding-left: 15px">
            <form action="" method="post">
                <input type="text" name="username" class="form-control" placeholder="Username" required=""> <br>
                <input type="text" name="email" class="form-control" placeholder="Email" required=""> <br>
                <input type="password" name="password" class="form-control" placeholder="New Password" id="passOne" 
                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"  title="Must contain at least one number and one uppercase and lowercase letter, 
                and at least 8 or more characters"> <br>
                <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" id="passTwo"> <br>
                <button class="btn btn-default" type="submit" name="submit">Update</button>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        var password = document.getElementById("passOne"), confirm_password = document.getElementById("passTwo");
        function validatePassword(){
            if(passOne.value != passTwo.value) {
                passTwo.setCustomValidity("Passwords Don't Match"); 
            } else {
                passTwo.setCustomValidity('');
            }
        }

        passOne.onchange = validatePassword;
        passTwo.onkeyup = validatePassword;
    </script>
    
    <?php
    if(isset($_POST['submit']))
    {
        if(mysqli_query($db, "UPDATE member SET password='$_POST[password]', confirm_password='$_POST[confirm_password]'
        WHERE username='$_POST[username]' AND email='$_POST[email]';"))
        {
            ?>
            <script type="text/javascript">
            alert("Password Updated Successfully");
        </script>
            <?php
        }
    }
    ?>
</body>
</html>