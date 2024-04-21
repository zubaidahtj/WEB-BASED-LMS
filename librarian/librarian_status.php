<?php
include "navbar.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>New Requests</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <style type="text/css">
        .srch
        {
            padding-left: 1000px;
        }
        body 
        {
            font-family: "Lato", sans-serif;
            transition: background-color .5s;
        }
        .sidenav 
        {
            height: 100%;
            margin-top:50px;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #222;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }
        .sidenav a 
        {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }
        .sidenav a:hover 
        {
            color: #f1f1f1;
        }
        .sidenav .closebtn 
        {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }
        #main 
        {
            transition: margin-left .5s;
            padding: 16px;
        }
        
        @media screen and (max-height: 450px)
        {
            .sidenav {padding-top: 15px;}
            .sidenav a {font-size: 18px;}
        }
        .img-circle
        {
            margin-left: 30px;
        }
    </style>
</head>
<body>
    
    <!----side navigation--->
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        
        <div style="color: white; margin-left: 60px">
        <?php
        if(isset($_SESSION['login_user']))
        {
          echo "<img class='img-circle profile_img' height=80 width=80 src='images/".$_SESSION['pic']."'>";
          echo "</br></br>";
          echo "Welcome ".$_SESSION['login_user'];
        }
        ?>
       </div>
       <a href="profile.php">Profile</a>
       <a href="books.php">Books</a>
       <a href="#">Book Request</a>
       <a href="#">Issue Information</a>
    </div>
    
    <div id="main">
        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>
        <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
            document.getElementById("main").style.marginLeft = "250px";
            document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
        }
        function closeNav() 
        {
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("main").style.marginLeft= "0";
            document.body.style.backgroundColor = "white";
        }
        </script>

    <!--search bar-->
    <h3>Search one username at a time to approve the registration request</h3>
    <div class="srch">
        <form class= "navbar-form" method="post" name="form1" >
            
                <input class="form-control" type="text" name="search" placeholder="Librarian username" required="">
                <button style="background-color: #f1dcdc" type="submit" name="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search"></span>

                </button>
        </form>
    </div>
    <br><h2 style="font-size: medium; font-family:'Times New Roman', Times, serif">New Requests</h2>
    <?php

    if(isset($_POST['submit']))
    {
        $q=mysqli_query($db,"SELECT first, last, username, phone_number, email FROM librarian  WHERE username LIKE '%$_POST[search]%' 
        AND status=''");

        if (mysqli_num_rows($q)==0) {
            echo "request not found, try again";
        }
        else {
            echo "<table class='table table-bordered table-hover'>";
            echo "<tr style= 'background-color: #f1dcdc;'>";
            //table header of member table
            echo "<th>"; echo "First Name"; echo "</th>";
            echo "<th>"; echo "Last Name"; echo "</th>";
            echo "<th>"; echo "Username"; echo "</th>";
            echo "<th>"; echo "Phone_number"; echo "</th>";
            echo "<th>"; echo "Email"; echo "</th>";
            echo "</tr>";
            
            while($row=mysqli_fetch_assoc($q))
            {
                $_SESSION['test_name']=$row['username'];
                echo "<tr>";
                echo "<td>"; echo $row['first']; echo "</td>";
                echo "<td>"; echo $row['last']; echo "</td>";
                echo "<td>"; echo $row['username']; echo "</td>";
                echo "<td>"; echo $row['phone_number']; echo "</td>";
                echo "<td>"; echo $row['email']; echo "</td>";
                echo"</tr>";
            }
            echo"</table>";
            
            /**?>
            <span style="" class="glyphicon glyphicon-remove-sign"></span>
            <span style="" class="glyphicon glyphicon-ok-sign"></span>
            <?php**/
        }
    }
    /*if button is not pressed*/
    else {
        $res=mysqli_query($db, "SELECT first, last, username, phone_number, email FROM `librarian` WHERE status='';");
        echo "<table class='table table-bordered table-hover'>";
        echo "<tr style= 'background-color: #f1dcdc;'>";
        //table header of member table
        echo "<th>"; echo "First Name"; echo "</th>";
        echo "<th>"; echo "Last Name"; echo "</th>";
        echo "<th>"; echo "Username"; echo "</th>";
        echo "<th>"; echo "Phone_number"; echo "</th>";
        echo "<th>"; echo "Email"; echo "</th>";
        echo "</tr>";

        while($row=mysqli_fetch_assoc($res))
        {
            $_SESSION['test_name']=$row['username'];
            echo "<tr>";
            echo "<td>"; echo $row['first']; echo "</td>";
            echo "<td>"; echo $row['last']; echo "</td>";
            echo "<td>"; echo $row['username']; echo "</td>";
            echo "<td>"; echo $row['phone_number']; echo "</td>";
            echo "<td>"; echo $row['email']; echo "</td>";
            echo"</tr>";
        }
        echo"</table>";
        ?>
        <form method="post"> 
            <button type="submit" name="submit1" style="background-color:white; font-weight:600;" class="btn btn-default">
            <span style="color:red;" class="glyphicon glyphicon-remove-sign"></span>&nbsp Remove</button>
            <button type="submit" name="submit2" style="background-color:white; font-weight:600" class="btn btn-default">
            <span style="color:green;" class="glyphicon glyphicon-ok-sign"></span>&nbsp Approve</button>
        </form>
        <?php
    }
    if(isset($_POST['submit1']))
    {
        mysqli_query($db,"DELETE FROM librarian WHERE username='$_SESSION[test_name]' AND status='';");
        unset($_SESSION['test_name']);
    }
    if (isset($_POST['submit2'])) 
    {
        mysqli_query($db,"UPDATE librarian SET status='yes' WHERE username='$_SESSION[test_name]';");
        unset($_SESSION['test_name']);
    }

    ?>
</body>
</html>