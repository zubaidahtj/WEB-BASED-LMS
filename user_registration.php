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
            height: 250px;
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
            <br><br><br><br><br>
            <div class="box2">
                <h1 style="text-align: center; font-size: medium; font-family:'Times New Roman', Times, serif">
                Web-based Library Management System</h1>
                <h1 style="text-align: center; font-size: medium;">New User Registration</h1>
                <form action="" name="Registration" method="post"> 
                    <br>
                    <b><p style="padding-left:160px; font-size:15px; font-weight:620;">
                        Sign-up as:
                    </p></b>
                    <input style="margin-left:50px; width:18px;" type="radio" name="user" id="admin" value="admin">
                    <label for="admin">Admin</label>
                    <input style="margin-left:50px; width:18px;" type="radio" name="user" id="librarian" value="librarian">
                    <label for="librarian">Librarian</label>
                    <input style="margin-left:50px; width:18px;" type="radio" name="user" id="member" value="member" checked="">
                    <label for="member">Member</label> <br><br>
                    <button class="btn btn-default" type="submit" name="submit1" style="color:black; font-weight:700; width:70px; 
                    height:30px; margin-left: 170px;">Ok</button>
                </form>
        
            </div>

        </div>
        
    </section>
    <?php
        if(isset($_POST['submit1']))
        {
            if($_POST['user']=='admin')
            {
                ?>
                <script type="text/javascript">
                    window.location="admin/user_registration.php";
                </script>
                <?php
            }
            else if($_POST['user']=='librarian')
            {
                ?>
                <script type="text/javascript">
                    window.location="librarian/user_registration.php";
                </script>
                <?php
            }
            else
            {
                ?>
                <script type="text/javascript">
                    window.location="member/user_registration.php";
                </script>
                <?php
            }
        }
    ?>
</body>
</html>