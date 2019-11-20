<html>
    <?php
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
 session_start();
 if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $sql = ("SELECT * FROM user WHERE u_email = '$email' and u_password = '$password'");
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $active = $row['active'];
    $count = mysqli_num_rows($result);
    
    // If result matched $email and $mypassword, table row must be 1 row
    if($count == 1) {
        header("location: index.php");
    }else {
        echo "Login Not Successful";
    }
 }
?>

<body>
<?php include_once 'includes/nav-menu.php'; ?>
    <form method = "post">
    <h2>Sign in</h2>
    <form action = "" method = "post">
    <label>Email  :</label><input type = "text" name = "email" >
    <label>Password  :</label><input type = "password" name = "password" />
    <input type = "submit" value = " Submit "/>
    </form>
<?php
include_once 'includes/footer.php';
$conn->close();
?>
</body>
</html>