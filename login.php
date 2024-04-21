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
        Login
    </title>
    <link rel="stylesheet" href="style.css">

    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style type="text/css">
        section
        {
            margin-top: -21px;
            width: 1366px;
        }
        .box1
        {
            height: 380px;
            width: 320px;
            background-color: #fff;;
            margin: 0px auto;
            opacity: .8;
            color: 212529;
            padding:0px;
        }
        label
        {
            font-size:15px;
            font-weight:600;
        }
    </style>

</head>
<body>

    
   

<section>
    <div class="mem_lgn_img">
        <br> <br>
        <div class="box1">
            <h1 style="text-align: center; font-size: medium; font-family:'Times New Roman', Times, serif">
                Web-based Library Management System</h1>
            <h1 style="text-align: center; font-size: medium;">User Login Form</h1><br>
        <form action="" name="Login" method="post"> 
            <b><p style="padding-left:40px; font-size:15px; font-weight:620;">
                Login as:
            </p></b>
            <input style="margin-left:50px; width:18px;" type="radio" name="user" id="admin" value="admin">
            <label for="admin">Admin</label>
            <input style="margin-left:50px; width:18px;" type="radio" name="user" id="librarian" value="librarian">
            <label for="librarian">Librarian</label>
            <input style="margin-left:50px; width:18px;" type="radio" name="user" id="member" value="member" checked="">
            <label for="member">Member</label>

            <div class="login">
            <input class= "form-control" type="text" name="username" placeholder="Username" autocomplete="username" required=""> <br>
            <input class= "form-control" type="password" name="password" placeholder="Password" required=""> <br> 
            <input class= "btn btn-default" type="submit" name="submit" value="Login" style="color: black; width: auto; height:auto"> </div>     
       
        <p style="color: black; padding-left: 10px;">
            <br>
            <a style="color: black;" name="forgotpassword" href="update_password.php">Forgot password?</a> &nbsp; &nbsp;
            New to website? <a style="color: black;" href="user_registration.php">Sign Up</a>
        </p>
        </form> 

        </div>
    </div>
</section>

<?php
if (isset($_POST['submit'])) 
{
    if($_POST['user']=='admin')
    {
        $count=0;
        $res=mysqli_query($db,"SELECT * FROM `admin` WHERE username='$_POST[username]' AND password='$_POST[password]' AND status ='yes';");
        $row= mysqli_fetch_assoc($res);
        $count=mysqli_num_rows($res);

        if($count==0)
        {
            ?>
            <script type="text/javascript">
                alert("Username and password not found");
            </script>
            <?php
        }
        else 
        {
            /*----if username & password matches---*/
            $_SESSION['login_user']=$_POST['username'];
            $_SESSION['pic']=$row['pic'];
            ?>
            <script type="text/javascript">
                window.location="admin/index.php";
            </script>
            <?php
        }
    }
    else if($_POST['user']=='librarian')
    {
        $count=0;
        $res=mysqli_query($db,"SELECT * FROM `librarian` WHERE username='$_POST[username]' AND password='$_POST[password]' AND status ='yes';");
        $row= mysqli_fetch_assoc($res);
        $count=mysqli_num_rows($res);

        if($count==0)
        {
            ?>
            <script type="text/javascript">
                alert("Username and password not found");
            </script>
            <?php
        }
        else 
        {
            /*----if username & password matches---*/
            $_SESSION['login_user']=$_POST['username'];
            $_SESSION['pic']=$row['pic'];
            ?>

            <script type="text/javascript">
               window.location="librarian/index.php";
            </script>
            <?php
        }
    }
    else
    {
        $count=0;
        $res=mysqli_query($db,"SELECT * FROM `member` WHERE username='$_POST[username]' AND password='$_POST[password]';");

        $row= mysqli_fetch_assoc($res);
        $count=mysqli_num_rows($res);
        
        if($count==0)
        {
            ?>

            <script type="text/javascript">
                alert("Username and password not found");
            </script>
            <?php

        }
        else 
       {
           /*----if username & password matches---*/
           $_SESSION['login_user']=$_POST['username'];
           $_SESSION['pic']=$row['pic'];
           ?>

            <script type="text/javascript">
                window.location="member/profile.php";
            </script>

            <?php
        }
    }
}

?>

</body>
</html>