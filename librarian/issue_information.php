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
            padding-left: 900px;
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
        .scroll
        {
            width:100%;
            height:500px;
            overflow:auto;
        }
        th,td
        {
            width:10%;
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
  <div class="srch">
    <!--enter username and book ID to change return status-->
    <h5>Enter username and book ID to change return status</h5>
        <form action="" method="post" name="form1">
            <input type="text" name="username" class="form-control" placeholder="Username" required=""><br>
            <input type="text" name="book_id" class="form-control" placeholder="Book ID" required=""><br>
            <button class="btn btn-default" name="submit" type="submit">Submit</button><br>
        </form>
    </div>
    <h3 style="text-align: center;">Information of Borrowed Books</h3><br>
    <?php
    $c=0;

      if(isset($_SESSION['login_user']))
      {
        $sql="SELECT member.username,books.book_id,title,author,issue_date,return_date,return_status FROM member inner join issue_book 
        ON member.username=issue_book.username inner join books ON issue_book.book_id=books.book_id WHERE issue_book.approve_status ='Approved' 
        ORDER BY `issue_book`.`return_date` ASC";
        $res=mysqli_query($db,$sql);
        
        
        echo "<table class='table table-bordered' style='width:100%;' >";
        //Table header
        
        echo "<tr style='background-color:  #f1dcdc;'>";
        echo "<th>"; echo "Member Username";  echo "</th>";
        echo "<th>"; echo "Book ID";  echo "</th>";
        echo "<th>"; echo "Book Title";  echo "</th>";
        echo "<th>"; echo "Author Name";  echo "</th>";
        echo "<th>"; echo "Issue Date";  echo "</th>";
        echo "<th>"; echo "Return Date";  echo "</th>";
        echo "<th>"; echo "Return Status";  echo "</th>";

      echo "</tr>"; 
      echo "</table>";

       echo "<div class='scroll'>";
        echo "<table class='table table-bordered' >";
      while($row=mysqli_fetch_assoc($res))
      {
        $d=date("Y-m-d");
        if($d > $row['return_date'])
        {
          $c=$c+1;
          /*might remove this $var and achange it back to expired*/
          $var='<p style="color:yellow; background-color:red;">EXPIRED</p>';

          mysqli_query($db,"UPDATE issue_book SET approve_status='$var' where `return_date`='$row[return_date]' and approve_status='Approved'
          and return_status='$row[return_status]' limit $c;");
          echo $d."</br>";
        }

        echo "<tr>";
          echo "<td>"; echo $row['username']; echo "</td>";
          echo "<td>"; echo $row['book_id']; echo "</td>";
          echo "<td>"; echo $row['title']; echo "</td>";
          echo "<td>"; echo $row['author']; echo "</td>";
          echo "<td>"; echo $row['issue_date']; echo "</td>";
          echo "<td>"; echo $row['return_date']; echo "</td>";
          echo "<td>"; echo $row['return_status']; echo "</td>";
        echo "</tr>";
      }
    echo "</table>";
        echo "</div>";
       
      }
      else
      {
        ?>
          <h3 style="text-align: center;">Please login to view information of Borrowed Books</h3>
        <?php
      }
      if(isset($_POST['submit']))
{
    $_SESSION['name']=$_POST['username'];
    $_SESSION['book_id']=$_POST['book_id'];

    ?>
    <script type="text/javascript">
        window.location="return_status.php"
    </script>
    <?php
}
    ?>
  </div>
</div>
</body>
</html>