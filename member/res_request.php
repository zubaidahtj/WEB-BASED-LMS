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
    <title>Book Reservation Request</title>
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
        .h:hover
        {
            color:white;
            width:300px;
            height:80px;
            background-color:#b18e75;
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
   
<?php
if(isset($_SESSION['login_user']))
    {
        $q=mysqli_query($db, "SELECT * FROM issue_book WHERE username='$_SESSION[login_user]' AND approve_status='' ;");

        if (mysqli_num_rows($q)==0) {
            echo "No reservation request";
        }
        else {
            echo "<table class='table table-bordered table-hover'>";
            echo "<tr style= 'background-color: #f1dcdc;'>";
            //table header of books table
            echo "<th>"; echo "Book ID"; echo "</th>";
            echo "<th>"; echo "Approve Status"; echo "</th>";
            echo "<th>"; echo "Issue Date"; echo "</th>";
            echo "<th>"; echo "Return Date"; echo "</th>";
            echo "</tr>";
            
            while($row=mysqli_fetch_assoc($q))
            {
                echo "<tr>";
                echo "<td>"; echo $row['book_id']; echo "</td>";
                echo "<td>"; echo $row['approve_status']; echo "</td>";
                echo "<td>"; echo $row['issue_date']; echo "</td>";
                echo "<td>"; echo $row['return_date']; echo "</td>";
                echo"</tr>";
            }
            echo"</table>";
        }
    }
    else
    {
        echo "</br></br>";
        echo "<h3><b>";
        echo "Please login to view your reservation request information";
        echo "</h3></b>";
    }
?>
</body>
</html>