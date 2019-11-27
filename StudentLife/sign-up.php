<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Home</title>

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
</br>
<form action="" method="post">

Name: <input type="text" name="fname" /><br><br>
Surname:<input type="text" name="lname" /><br><br>
Email: <input type="text" name="email" /><br><br>
Password: <input type="text" name="password" /><br><br>
 <button type="submit" name="submit" >Submit</button>
</form>

<?php
include_once 'includes/footer.php';
$conn->close();
?>
</body>
</html>