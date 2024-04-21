<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <link rel="stylesheet" href="style.css">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


</head>
<body>
     <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand active">WEB-BASED LIBRARY MANAGEMENT SYSTEM</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="index.php">HOME</a></li>
                <li><a href="books.php">BOOKS</a></li> 
                <li><a href="feedback.php">FEEDBACK</a></li>
                
            </ul>
            <?php
            if(isset($_SESSION['login_user']))
            {
                ?>
                
                <ul class="nav navbar-nav">
                    <li><a href="profile.php">PROFILE</a></li>
                    <li><a href="fine.php">FINE</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="profile.php">
                        <div style="color: white">
                           <?php
                           echo "<img class='img-circle profile_img' height=25 width=25 src='images/".$_SESSION['pic']."'>";
                           echo " ".$_SESSION['login_user'];
                           ?>
                        </div>
                    </a></li>
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"> LOGOUT</span></a></li>
                </ul>
                <?php
            }
            else 
            {?>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="../login.php"><span class="glyphicon glyphicon-log-in"> LOGIN</span></a></li>
                    <li><a href="user_registration.php"><span class="glyphicon glyphicon-user"> SIGN UP</span></a></li>
                </ul>
                 <?php
            }
            ?>
            
            
        </div>
    </nav>
    <?php
    if(isset($_SESSION['login_user']))
    {
        $day=0;
        $exp='<p style="color:yellow; background-color:red;">EXPIRED</p>';
        $res=mysqli_query($db,"SELECT return_date FROM issue_book WHERE username = '$_SESSION[login_user]'  AND approve_status ='$exp' 
        AND return_status='not returned';");
        while($row=mysqli_fetch_assoc($res))
        {
            $d= strtotime($row['return_date']);
            $c= strtotime(date("Y-m-d"));
            $diff= $c-$d;
                
            if($diff>=0)
            {
                $day= $day+floor($diff/(60*60*24));      
            }//time expired in days    
        }
        $_SESSION['fine'] =$day*500;
    }
    ?>
</body>
</html>