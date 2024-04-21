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
    <title>Profile</title>
    <style type="text/css">
        .wrapper
        {
            width: 300px;
            margin: 0 auto;
            color: white;
        }
    </style>
</head>
<body style="background-color: #5d7466">
    <div class="container">
        <form action="" method="post">
            <button class="btn btn-default" style="float: right;" name="submit1">Edit</button>
        </form>
        <div class="wrapper">
            <?php
            if(isset($_POST['submit1']))
            {
                ?>
                <script type="text/javascript">
                    window.location="edit_profile.php"
                </script>
                <?php
            }
            $q=mysqli_query($db,"SELECT * FROM member WHERE username='$_SESSION[login_user]';");
            ?>
            <h2 style="text-align:center;">Profile</h2>
            <?php
            $row= mysqli_fetch_assoc($q);
            echo "<div style='text-align: center'>
            <img class='img-circle profile-img' height=100 width=110 src='images/".$_SESSION['pic']."'>
            </div>";
            ?>
            <div style="text-align:center;"><b>Welcome</b>
               <h4>
                   <?php
                   echo $_SESSION['login_user'];
                   ?>
                </h4>
            </div>
            <?php
            echo "<b>";
            echo "<table class='table table-bordered'>";
            echo "<tr>";
            echo "<td>";
            echo "<b> First Name: </b>";
            echo "</td>";

            echo "<td>";
            echo $row['first'];
            echo "</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td>";
            echo "<b> Last Name: </b>";
            echo "</td>";

            echo "<td>";
            echo $row['last'];
            echo "</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td>";
            echo "<b> Username: </b>";
            echo "</td>";

            echo "<td>";
            echo $row['username'];
            echo "</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td>";
            echo "<b> Password: </b>";
            echo "</td>";

            echo "<td>";
            echo $row['password'];
            echo "</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td>";
            echo "<b> Confirm Password: </b>";
            echo "</td>";

            echo "<td>";
            echo $row['confirm_password'];
            echo "</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td>";
            echo "<b> Phone Number: </b>";
            echo "</td>";

            echo "<td>";
            echo $row['phone_number'];
            echo "</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td>";
            echo "<b> Email: </b>";
            echo "</td>";

            echo "<td>";
            echo $row['email'];
            echo "</td>";
            echo "</tr>";
            echo "</table>";
            echo "</b>";
            ?>
            
        </div>
    </div>
</body>
</html>