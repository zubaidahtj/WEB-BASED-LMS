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
    <title>Books</title>
    <style type="text/css">
        .srch
        {
            padding-left: 1000px;
        }
        body 
        {
            background-color: #cdc0aa;
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
            height:50px;
            background-color:#b18e75;
        }
        .book
        {
            width: 500px;
            margin: 0px auto;
        }
        .form-control
        {
            background-color:#240606;
            color:white;
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

  <div class="h"><a href="add.php">Add Books</a></div>
  <div class="h"><a href="books.php">Remove Books</a></div>
</div>

<div id="main">
    <!--
  <h2>Sidenav Push Example</h2>
  <p>Click on the element below to open the side navigation menu, and push this content to the right. Notice that we add a black see-through background-color to body when the sidenav is opened.</p>-->
  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>
  <div class="container" style="text-align:center;" >
      <h2 style="color: black; font: Lucida Console; text-align: center">Add New Books</h2>
      <form action="" class="book" method="post">
          <input type="text" name="book_id" class="form-control" placeholder="Book ID" required=""><br>
          <input type="text" name="title" class="form-control" placeholder="Book Title" required=""><br>
          <input type="text" name="author" class="form-control" placeholder="Book Author" required=""><br>
          <input type="text" name="status" class="form-control" placeholder="Book Status" required=""><br>
          <input type="text" name="quantity" class="form-control" placeholder="Book Quantity" required=""><br>
          <input type="text" name="genre" class="form-control" placeholder="Book Genre" required=""><br>
          <button class="btn btn-default" type="submit" name="submit">ADD</button>
      </form>
  </div>

  <?php
  /**if submit button pressed after entering inputs */
  if (isset($_POST['submit'])) 
  {
    if(isset($_SESSION['login_user']))
    {
        mysqli_query($db,"INSERT INTO `books` VALUES ('$_POST[book_id]',
        '$_POST[title]','$_POST[author]','$_POST[status]','$_POST[quantity]','$_POST[genre]','0');");
        ?>
        <script type="text/javascript">
            alert("Book has been added successfully");
        </script>
        <?php
    }
    else
    {
        ?>
        <script type="text/javascript">
            alert("Please login to add book");
        </script>
        <?php
    }
  }
  ?>

</div>
<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
  document.body.style.backgroundColor = "#cdc0aa";
}
</script>
</body>
</html>