<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Web-based Library Management System
    </title>
    <link rel="stylesheet" href="style.css">

    <style type="text/css">
        nav
        {
            float: right;
            word-spacing: 15px;
            padding: 15px;
        }
        
        nav li
        {
            display: inline-block;
            line-height: 90px;
        }
    </style>
</head>
    
    <body>
        <div class="wrapper">

            <header>
                <div class="logo">
                   <img src="images/pic1.png" alt="logo">
                </div>

                <?php
                if (isset($_SESSION['login_user'])) 
                {?>
                    <nav>
                        <ul>
                            <li><a href="index.php">HOME</a></li>
                            <li><a href="books.php">BOOKS</a></li>
                            <li><a href="logout.php">LOGOUT</a></li>
                            <li><a href="feedback.php">FEEDBACK</a></li>
                        </ul>
                    </nav>
                    <?php
                }
                else 
                {?>
                    <nav>
                        <ul>
                            <li><a href="index.php">HOME</a></li>
                            <li><a href="books.php">BOOKS</a></li>
                            <li><a href="login.php">LOGIN</a></li>
                            <li><a href="feedback.php">FEEDBACK</a></li>
                        </ul>
                     </nav>
                     <?php
                }
                ?>
                

            </header>
            <section>
            <div class="section_image">
               
                <div>
                    

                </div>
            </div>
            </section>
           <!-- <footer>
                <p style="color: white; text-align: justify;">
                    <br>
                    Email: 180136SD@aou.edu.sd
                </p>
            </footer>-->

        </div>
        <?php
        include "footer.php";
        ?>
    </body>
</html>