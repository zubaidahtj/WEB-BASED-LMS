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
    <title>Paid Fines Status</title>
    <style type="text/css">
        .srch
        {
            padding-left: 420px;
        }
        .form-control
        {
            width: 300px;
            height: auto;
            background-color:white;
            color:black;
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
        .h:hover
        {
            color:white;
            width:300px;
            height:80px;
            background-color:#b18e75;
        }
        /*.container
        {
            height: 500px;
            background-color: black;
            opacity:.8;
            color:white;
        }*/
        
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
  </div> <br><br>
  <div class="h"><a href="res_request.php">Book Reservation Request</a></div>
  <div class="h"><a href="issue_information.php">Issue Information</a></div>
  <div class="h"><a href="expired.php"> Expired Return Dates</a></div>
</div>

<div id="main">
  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>


<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
  document.body.style.backgroundColor = "white";
}
</script>
<div class="container">
    <h3 style="text-align:center;">Change Return Status</h3>
    <div class="srch"><br><br>
        <form action="" method="post">
            <input type="text" name="return_status" class="form-control" placeholder="Enter Return Status" required=""><br>
            <button class="btn btn-default" name="submit" type="submit">Returned</button><br>
        </form>
        <br>
        <p>Please set return status</p>
    </div>
</div>
</div>

<?php
if(isset($_POST['submit']))
{
  mysqli_query($db,"UPDATE  `issue_book` SET  `return_status` =  '$_POST[return_status]' WHERE username='$_SESSION[name]' and book_id='$_SESSION[book_id]';");

  ?>
      <script type="text/javascript">
        alert("Return status updated successfully.");
        window.location="issue_information.php"
      </script>
    <?php
    
}
?>
</body>
</html>
}