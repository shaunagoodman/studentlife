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
            $name = $_POST["name"];
            $college_name =(int) $_POST["college_ID"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $location = $_POST["location"];
        
        $sql = ("INSERT INTO user(college_ID, u_name, u_email, u_password, location) VALUES ('$college_name', '$name', '$email', '$password', '$location')");
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

Name: <input type="text" name="name" /><br><br>

College: <select name = "college_ID">
    <option> ---Select College---</option>
    <option value="1">Athlone Institute of Technology</option>
<option value="2">Blanchardstown</option>
<option value="3">Cork Institute of Technology</option>
<option value="4">Dublin City University</option>
<option value="5">Dundalk Institute of Technology</option>
<option value="6">Dun Laoghaire Institute of Art, Design and Technology</option>
<option value="7">Institute of Technology Carlow</option>
<option value="8">Institute of Technology Galway</option>
<option value="9">Institute of Technology Tallaght</option>
<option value="10">Institute of Technology Tralee</option>
<option value="11">Institute of Technology Sligo</option>
<option value="12">Letterkenny Institute of Technology</option>
<option value="13">Limerick Institute of Technology</option>
<option value="14">Marino Institute of Education, Dublin</option>
<option value="15">Mary Immaculate College, Limerick</option>
<option value="16">National College of Art and Design</option>
<option value="17">National College of Ireland</option>
<option value="18">National University of Ireland Galway</option>
<option value="19">National University of Ireland Maynooth</option>
<option value="20">Pontifical University of Maynooth</option>
<option value="21">Royal Irish Academy of Music</option>
<option value="22">Royal College of Surgeons Ireland</option>
<option value="23">St. Angela’s College Sligo</option>
<option value="24">St Patrick’s College Carlow</option>
<option value="25">Technological University Dublin</option>
<option value="26">The University of Limerick</option>
<option value="27">Trinity College Dublin</option>
<option value="28">University College Cork</option>
<option value="29">University College Dublin</option>
<option value="30">Waterford Institute of Technology</option>
<option value="31">Other</option>
</select><br><br>

Email: <input type="text" name="email" /><br><br>

Password: <input type="text" name="password" /><br><br>
Location: <input type="text" name="location" /><br><br>

 <button type="submit" name="submit" >Submit</button>

</form>

<?php
include_once 'includes/footer.php';
$conn->close();
?>
</body>
</html>