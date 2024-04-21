<?php
include "navbar.php";
include "connection.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>

    <link rel="stylesheet" href="style.css">

    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style type="text/css">
        body
        {
            background-image: url("images/we\ want\ \(1\).png");
        }
        .wrapper
        {
            padding: 10px;
            margin: -20px auto;
            width: 900px;
            height: 600px;
            background-color: #f6f6e9;
            opacity: .8
            /*--color: white;-*/
        }
        .form-control
        {
            height: 100px;
            width: 60%;
        }
        .scroll
        {
            height:300px;
            width:100%;
            overflow: auto;
        }
    </style>

</head>
<body>
    <div class="wrapper">
        <h4>
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; please provide us with feedback and suggestions below.
        </h4>
        <form style="" action="" method="post">
            <input class="form-control" type="text" name="comment" placeholder="Please write your feedback/suggestions here"> <br>
            <input class="btn btn-default" type="submit" name="submit" value="Enter" style="width: 100px; height: auto">
        </form>
    

    <br><br>    
    <div class= "scroll">
    <?php
			if(isset($_POST['submit']))
			{
				$sql="INSERT INTO `feedback` VALUES('','admin','$_POST[comment]');";
				if(mysqli_query($db,$sql))
				{
					$q="SELECT * FROM `feedback` ORDER BY `feedback`.`id` DESC";
					$res=mysqli_query($db,$q);

					echo "<table class='table table-bordered'>";
					while ($row=mysqli_fetch_assoc($res)) 
					{
						echo "<tr>";
                            echo "<td>"; echo $row['username']; echo "</td>";
							echo "<td>"; echo $row['feedback']; echo "</td>";
						echo "</tr>";
					}
				}

			}

            else
            {
                $q="SELECT * FROM `feedback` ORDER BY `feedback`.`id` DESC";
					$res=mysqli_query($db,$q);

					echo "<table class='table table-bordered'>";
					while ($row=mysqli_fetch_assoc($res)) 
					{
						echo "<tr>";
                            echo "<td>"; echo $row['username']; echo "</td>";
							echo "<td>"; echo $row['feedback']; echo "</td>";
						echo "</tr>";
					}
            }
        ?>
    </div>

    </div>
</body>
</html>