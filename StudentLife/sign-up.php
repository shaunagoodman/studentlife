<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Register</title>

        <?php session_start();
        include_once 'includes/CDNs.php'; 
        $servername = "localhost";
        $username = "student_user";
        $password = "";
        $db_name = "Student_db";
        
        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $db_name);
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        if(isset($_POST["submit"])) 
{
            $fname = $_POST["fname"];
            $lname = $_POST["lname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
        
        $sql = ("INSERT INTO user(fname, lname, u_email, u_password) VALUES ('$fname', '$lname', '$email', '$password')");
        if (mysqli_query($conn, $sql)) {
            echo "Success";
        }
        else {
            echo "Login Unsuccessful";
        }
    }
        ?> 
        <link href="includes/stylesheet.css" rel="stylesheet" type="text/css"/>
    </head>
<body>
<?php include_once 'includes/nav-menu.php'; ?> 

<div class="container" >


<center> <img class="login-logo" src="images/recipeasy-icons-logos/Capture.png" width="18%" alt="..."> </center>


<form class="login-form" action="" method="post">
   
    <fieldset>
        <div class="form-row">

            <div class="form-group col-md-12">
                <label>First Name :</label>
                <input class="form-control" type="text" name="fname">
            </div>

            <div class="form-group col-md-12">
                <label>Surname :</label>
                <input class="form-control" type="text" name="lname">
            </div>

            <div class="form-group col-md-12">
                <label>Email :</label>
                <input class="form-control" type="text" name="email">
            </div>

            <div class="form-group col-md-12">
                <label>Password :</label>
                <input class="form-control" type="password" name="password" />
            </div>

            <div class="form-group col-md-12">
                <button type="submit" name="submit" value=" Submit " class="btn btn-light">
                    Register</button>
                <br> <br>
                
            </div>

        </div>
    </fieldset>
</form>







</div>

<?php
include_once 'includes/footer.php';
$conn->close();
?>
</body>
</html>