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
    <title>
        User Registration
    </title>
    <link rel="stylesheet" href="style.css">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style type="text/css">
        section
        {
            margin-top: -21px;
            width: auto;
        }
        .box2
        {
            height: 550px;
            width: 420px;
            background-color: #fff;
            margin: 0px auto; 
            opacity: .8;
            color: 212529;
            padding:0px;
        }
        .user_reg_img
        {
            height: 650px;
            background-repeat: no-repeat;
        }
        
    </style>

</head>
<body>
    <section>
        <div class="user_reg_img">
            <br><br>
            <div class="box2">
                <h1 style="text-align: center; font-size: medium; font-family:'Times New Roman', Times, serif">
                Web-based Library Management System</h1>
                <h1 style="text-align: center; font-size: medium;">User Registration Form</h1>
                <form action="" name="Registration" method="post"> 
                    <br>

                    <div class="sign-up" style="width:300px; margin-left:50px;">
                        <input class="form-control" type="text" name="first" placeholder="First Name" autocomplete="first" required=""> <br>
                        <input class="form-control" type="text" name="last" placeholder="Last Name" autocomplete="last" required=""> 
                        <br>
                        <input class="form-control" type="text" name="username" placeholder="Username" autocomplete="username" required=""> <br>
                        <input class="form-control" type="password" id="passOne" name="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                        title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required=""> <br> 
                        <input class="form-control" type="password" id="passTwo" name="confirm_password" placeholder="Confirm Password" required=""> <br>
                        <input class="form-control" type="tel" name="phone_number" id="phone_number" placeholder="Phone Number" required> <br>
                        <input class="form-control" type="email" name="email" placeholder="Email" required=""> <br>
                        <input class= "btn btn-default" type="submit" name="submit" value="Sign Up" style="color: black; width: auto; height:auto"> </div>     
        
                    </div>     
                </form>
        
            </div>

        </div>
    </section>

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
        $count=0;
        $sql="SELECT username FROM `member`";
        $res=mysqli_query($db,$sql);

        while($row=mysqli_fetch_assoc($res))
        {
            if($row['username']==$_POST['username'])
            {
                $count=$count+1;
            }
        }
        if($count==0)
        {
            mysqli_query($db,"INSERT INTO `MEMBER` VALUES('$_POST[first]', '$_POST[last]', '$_POST[username]', '$_POST[password]', 
            '$_POST[confirm_password]', '$_POST[phone_number]', '$_POST[email]', 'p-pic.png');");
            ?>
            <script type="text/javascript">
                window.location="../login.php";
            </script>
            <?php
        }
        else
        {
            ?>
            <script type="text/javascript">
            alert("Username already exists");
            </script>
            <?php
        }
        }
    
    ?>
</body>