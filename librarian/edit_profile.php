<?php
include "navbar.php";
include "connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>

    <style type="text/css">
        .form-control
        {
            width:300px;
            height:35px;
        }
        form
        {
            padding-left: 530px;
        }
        label
        {
            color:white;
        }
    </style>
</head>
<body style="background-color: #5d7466">
    <h2 style="text-align: center; color: white">Edit Profile Information</h2><br>
    <?php
    $sql= "SELECT * FROM librarian WHERE username='$_SESSION[login_user]'";
    $result= mysqli_query($db,$sql) or die (mysql_error());

    while ($row = mysqli_fetch_assoc($result)) {
        $first=$row['first'];
        $last=$row['last'];
        $username=$row['username'];
        $password=$row['password'];
        $confirm_password=$row['confirm_password'];
        $phone_number=$row['phone_number'];
        $email=$row['email'];
    }
    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <label for=""><h4><b>Profile Picture:</b></h4></label>
        <input class="form-control" type="file" name="file">

        <label for=""><h4><b>First Name:</b></h4></label>
        <input class="form-control" type="text" name="first" value= "<?php echo $first; ?>">

        <label for=""><h4><b>Last Name:</b></h4></label>
        <input class="form-control" type="text" name="last" value= "<?php echo $last; ?>">

        <label for=""><h4><b>Username:</b></h4></label>
        <input class="form-control" type="text" name="username" value= "<?php echo $username; ?>">

        <label for=""><h4><b>Password:</b></h4></label>
        <input class="form-control" type="password" name="password" id="passOne" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
        title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" 
        value= "<?php echo $password; ?>">

        <label for=""><h4><b>Confirm Password:</b></h4></label>
        <input class="form-control" type="password" name="confirm_password" id="passTwo" value= "<?php echo $confirm_password; ?>">

        <label for=""><h4><b>Phone Number:</b></h4></label>
        <input class="form-control" type="text" name="phone_number" value= "<?php echo $phone_number; ?>">

        <label for=""><h4><b>Email:</b></h4></label>
        <input class="form-control" type="text" name="email" value= "<?php echo $email; ?>"><br>

        <div style="padding-left: 115px">
            <input class= "btn btn-default" type="submit" name="submit" value="Save" style="color: black; width: auto; height:auto">
        </div><br>
    </form>
    
    <script type="text/javascript">
        var password = document.getElementById("passOne"), confirm_password = document.getElementById("passTwo");
        function validatePassword(){
            if(passOne.value != passTwo.value) {
                passTwo.setCustomValidity("Passwords Don't Match"); 
            } else {
                passTwo.setCustomValidity('');
            }
        }

        passOne.onchange = validatePassword;
        passTwo.onkeyup = validatePassword;
    </script>

    <?php
    if(isset($_POST['submit']))
    {
        move_uploaded_file($_FILES['file']['temp_name'],"images/".$_FILES['file']['name']);
        $first=$_POST['first'];
        $last=$_POST['last'];
        $username=$_POST['username'];
        $password=$_POST['password'];
        $confirm_password=$_POST['confirm_password'];
        $phone_number=$_POST['phone_number'];
        $email=$_POST['email'];
        $pic=$_FILES['file']['name'];

        $sql1="UPDATE librarian SET pic='$pic', first='$first',last='$last',username='$username',password='$password',
        confirm_password='$confirm_password',phone_number='$phone_number',email='$email' WHERE username='".$_SESSION['login_user']."';";
        if(mysqli_query($db,$sql1))
        {
            ?>
            <script type="text/javascript">
                alert("Saved successfully :)");
                window.location="edit_profile.php";
            </script>
            <?php
        }
    }
    ?>

    
</body>
</html>