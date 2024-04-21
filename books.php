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
    <?php
    $b=mysqli_query($db,"SELECT * FROM `books` ORDER BY book_count DESC LIMIT 3;");
    
    ?>
    <div style="width:100%; height:50px; margin-top: -21px">
        <div style="background-color:#4f494b; padding:10px; width:10%; height:50px; float:left">
            <h4 style="color:white; margin-top:0px">TRENDING BOOKS</h4>
        </div>
        <div style="background-color:#f1dcdc; width:90%; height:50px; float:left; padding:10px">
            <table>
                <?php
                while($b1=mysqli_fetch_assoc($b))
                {
                    echo "<tr style='color:black; width:400px; margin-top:0px; float:left;'>";
                        echo "<td>"; echo "[".$b1['book_id']."]&nbsp&nbsp"; echo "</td>";
                        echo "<td>"; echo $b1['title']; echo "</td>";
                    echo "</tr>";
                }
                ?>
                
            </table>
        </div>
    </div>
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
    
        <!--<div class="h"><a href="res_request.php">Book Reservation Request</a></div>
        <div class="h"><a href="issue_information.php">Issue Information</a></div>
        <div class="h"><a href="expired.php">Expired Return Dates</a></div>-->
    </div>
    
    <div id="main">
        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>
        <script>
        function openNav() 
        {
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
        <div class="srch">
            <form class= "navbar-form" method="post" name="form1" >
                <input class="form-control" type="text" name="search" placeholder="search books" required="">
                <button style="background-color: #f1dcdc" type="submit" name="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search"></span>
                </button>
            </form>
        </div>
        
        <!---book reservation request --->
        <div class="srch">
            <form class= "navbar-form" method="post" name="form1" >
                <input class="form-control" type="text" name="book_id" placeholder="Enter book ID" required="">
                <button style="background-color: #f1dcdc" type="submit" name="submit1" class="btn btn-default"> Request
                </button>
            </form>
        </div>
        <h2 style="font-size: medium; font-family:'Times New Roman', Times, serif">List of Books</h2>
        <?php
        
        if(isset($_POST['submit']))
    {
        $q=mysqli_query($db, "SELECT * FROM books WHERE title LIKE '%$_POST[search]%'");

        if (mysqli_num_rows($q)==0) {
            echo "Book not found, try again";
        }
        else {
            echo "<table class='table table-bordered table-hover'>";
            echo "<tr style= 'background-color: #f1dcdc;'>";
            //table header of books table
            echo "<th>"; echo "ID"; echo "</th>";
            echo "<th>"; echo "Title"; echo "</th>";
            echo "<th>"; echo "Author"; echo "</th>";
            echo "<th>"; echo "Status"; echo "</th>";
            echo "<th>"; echo "Quantity"; echo "</th>";
            echo "<th>"; echo "Genre"; echo "</th>";
            echo "</tr>";
            
            while($row=mysqli_fetch_assoc($q))
            {
                echo "<tr>";
                echo "<td>"; echo $row['book_id']; echo "</td>";
                echo "<td>"; echo $row['title']; echo "</td>";
                echo "<td>"; echo $row['author']; echo "</td>";
                echo "<td>"; echo $row['status']; echo "</td>";
                echo "<td>"; echo $row['quantity']; echo "</td>";
                echo "<td>"; echo $row['genre']; echo "</td>";
                echo"</tr>";
            }
            echo"</table>";
        }
    }
    /*if button is not pressed*/
    else {
        $res=mysqli_query($db, "SELECT * FROM `books`;");
        echo "<table class='table table-bordered table-hover'>";
        echo "<tr style= 'background-color: #f1dcdc;'>";
        //table header of books table
        echo "<th>"; echo "ID"; echo "</th>";
        echo "<th>"; echo "Title"; echo "</th>";
        echo "<th>"; echo "Author"; echo "</th>";
        echo "<th>"; echo "Status"; echo "</th>";
        echo "<th>"; echo "Quantity"; echo "</th>";
        echo "<th>"; echo "Genre"; echo "</th>";
        echo "</tr>";

        while($row=mysqli_fetch_assoc($res))
        {
            echo "<tr>";
            echo "<td>"; echo $row['book_id']; echo "</td>";
            echo "<td>"; echo $row['title']; echo "</td>";
            echo "<td>"; echo $row['author']; echo "</td>";
            echo "<td>"; echo $row['status']; echo "</td>";
            echo "<td>"; echo $row['quantity']; echo "</td>";
            echo "<td>"; echo $row['genre']; echo "</td>";
            echo"</tr>";
        }
        echo"</table>";
    }

    if(isset($_POST['submit1']))
    {
        if(isset($_SESSION['login_user']))
        { 
            $sql1=mysqli_query($db,"SELECT * FROM `books` WHERE book_id='$_POST[book_id]';");
            $row1=mysqli_fetch_assoc($sql1);
            $count1=mysqli_num_rows($sql1);
            if($count1!=0)
            {
                mysqli_query($db,"INSERT INTO issue_book VALUES('$_SESSION[login_user]', '$_POST[book_id]', '', 
                '', '');");
                ?>
                <script type="text/javascript">
                    window.location="res_request.php"
                </script>
                <?php
            }
            else
            {
                ?>
                <script type="text/javascript">
                    alert("Book ID not valid");
                </script>
                <?php
            }
        }
        else
        {
            ?>
            <script type="text/javascript">
                alert("Please login to request a book reservation");
            </script>
            <?php
        }
    }

    ?>
    
</body>
</html>