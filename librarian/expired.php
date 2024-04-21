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
            padding-left: 72%;
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
            padding-left: 0px;
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
            height:400px;
            overflow:auto;
        }
        th,td
        {
            width:10%;
        }
        .container
        {
            height: 900px;
            width:85%;
            background-color: white;
            opacity:.8;
            color:black;
            margin-top:-63px;
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
	
  <div class="container">
      
    <?php
    if(isset($_SESSION['login_user']))
    {
        ?>
        <div style="float:left; padding:25px;">
            <form method="post" action="" >
                <button name="submit2" type="submit" class="btn btn-default">RETURNED</button> &nbsp &nbsp
                <button name="submit3" type="submit" class="btn btn-default">EXPIRED</button>
            </form>
        </div>
            
            <h4 style="text-align: right; font-size:medium;">Change the status of expired return dates:</h4><br>
            <!--to change status from expired to return-->
            <div class="srch">
                <form method="post" action="" name="form1">
                    <input type="text" name="username" class="form-control" style="width: auto; height: auto" placeholder="Username"
                     required=""><br>
                    <input type="text" name="book_id" class="form-control" style="width: auto; height: auto" placeholder="Book ID" 
                    required=""><br>
                    <button class="btn btn-default" name="submit" type="submit">Submit</button><br>
                </form>
            </div>
            <?php
            
            if(isset($_POST['submit']))
            {
                $res=mysqli_query($db,"SELECT * FROM `issue_book` where username='$_POST[username]' and book_id='$_POST[book_id]' ;");
                while($row=mysqli_fetch_assoc($res))
                {
                    $d= strtotime($row['return_date']);
                    $c= strtotime(date("Y-m-d"));
                    $diff= $c-$d;

                    if($diff>=0)
                    {
                        $day= floor($diff/(60*60*24)); 
                        $fine= $day*500;
                    }
                }
                $x= date("Y-m-d");
                
                mysqli_query($db,"INSERT INTO `fine` VALUES ('$_POST[username]', '$_POST[book_id]', '$x', '$day', '$fine','not paid') ;");
                $var1='<p style="color:white; background-color:green;">RETURNED</p>';
                mysqli_query($db,"UPDATE issue_book SET approve_status='$var1' where `username`='$_POST[username]' and book_id='$_POST[book_id]'");
                mysqli_query($db,"UPDATE books SET quantity=quantity+1 where book_id='$_POST[book_id]'");
            }
    }
    ?>
    <!--<h3 style="text-align: center;">List of Expired Return Dates</h3>--><br>
    <?php
    $c=0;
    
        /**$var='<p style="color:yellow; background-color:red;">EXPIRED</p>';**/
        $ret='<p style="color:white; background-color:green;">RETURNED</p>';
        $exp='<p style="color:yellow; background-color:red;">EXPIRED</p>';
        
        if (isset($_POST['submit2'])) 
        {
            $sql="SELECT member.username,books.book_id,title,author,approve_status,issue_date,return_date FROM member inner join issue_book 
            ON member.username=issue_book.username inner join books ON issue_book.book_id=books.book_id WHERE issue_book.approve_status ='$ret' 
            ORDER BY `issue_book`.`return_date` DESC";
            $res=mysqli_query($db,$sql);
        }
        else if (isset($_POST['submit3']))
        {
            $sql="SELECT member.username,books.book_id,title,author,approve_status,issue_date,return_date FROM member inner join issue_book 
            ON member.username=issue_book.username inner join books ON issue_book.book_id=books.book_id WHERE issue_book.approve_status ='$exp' 
            ORDER BY `issue_book`.`return_date` DESC";
            $res=mysqli_query($db,$sql);
        }
        else 
        {
            $sql="SELECT member.username,books.book_id,title,author,approve_status,issue_date,return_date FROM member inner join issue_book 
            ON member.username=issue_book.username inner join books ON issue_book.book_id=books.book_id WHERE issue_book.approve_status !=' ' 
            AND issue_book.approve_status !='Approved' ORDER BY `issue_book`.`return_date` DESC";
            $res=mysqli_query($db,$sql);
        }
        
        
        echo "<table class='table table-bordered' style='width:100%;' >";
        //Table header
        
        echo "<tr style='background-color:  #f1dcdc;'>";
        echo "<th>"; echo "Member Username";  echo "</th>";
        echo "<th>"; echo "Book ID";  echo "</th>";
        echo "<th>"; echo "Book Title";  echo "</th>";
        echo "<th>"; echo "Author Name";  echo "</th>";
        echo "<th>"; echo "Approve Status";  echo "</th>";
        echo "<th>"; echo "Issue Date";  echo "</th>";
        echo "<th>"; echo "Return Date";  echo "</th>";

        echo "</tr>"; 
        echo "</table>";

        echo "<div class='scroll'>";
        echo "<table class='table table-bordered' >";
        while($row=mysqli_fetch_assoc($res))
        {
            
            echo "<tr>";
            echo "<td>"; echo $row['username']; echo "</td>";
            echo "<td>"; echo $row['book_id']; echo "</td>";
            echo "<td>"; echo $row['title']; echo "</td>";
            echo "<td>"; echo $row['author']; echo "</td>";
            echo "<td>"; echo $row['approve_status']; echo "</td>";
            echo "<td>"; echo $row['issue_date']; echo "</td>";
            echo "<td>"; echo $row['return_date']; echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
       /*else
       {
           ?>
          <h3 style="text-align: center;">Please login to view information of Borrowed Books</h3>
          <?php
       }*/
    ?>
  </div>
</div>
</body>
</html>