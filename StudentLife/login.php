
<html>
<?php


// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: profile.php");
    exit;
}

include_once 'includes/CDNs.php';
$servername = "localhost";
$username = "student_user";
$password = "";
$db_name = "student_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db_name);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
   

    $sql = ("SELECT * FROM user WHERE u_email = '$email' and u_password = '$password'");
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $active = $row['active'];
    $count = mysqli_num_rows($result);

    // If result matched $email and $mypassword, table row must be 1 row
    if ($count == 1) {
        session_start();
    
      
      
        $_SESSION["loggedin"] = true;
        $_SESSION["u_email"] = $email;
        $_SESSION['fname'] = $fname;
        $_SESSION['lname'] = $lname;

       
 
                             
        
        // Redirect user to welcome page
        header("location: profile.php");
    } else {
        echo "Login Not Successful";
    }
}

?>

<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <?php include_once 'includes/CDNs.php'; ?>

    <link href="includes/stylesheet.css" rel="stylesheet" type="text/css" />


</head>



<body>
    <?php include_once 'includes/nav-menu.php'; ?>

    <div class="container">



    <center> <img class="login-logo" src="images/recipeasy-icons-logos/Capture.png" width="18%" alt="..."> </center>


        <form class="login-form" method="post">
           
            <fieldset>
                <div class="form-row">

                    <div class="form-group col-md-12">
                        <label>EMAIL :</label>
                        <input class="form-control" type="text" name="email">
                    </div>

                    <div class="form-group col-md-12">
                        <label>PASSWORD :</label>
                        <input class="form-control" type="password" name="password" />
                    </div>

                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" value=" Submit " class="btn btn-light">
                            Login</button>
                        <br> <br>
                        <p>Don't have an account? Register <a href="sign-up.php" class="here-link">here. </a> </p>

                    </div>

                </div>
            </fieldset>
        </form>




    </div>

    <?php include_once 'includes/footer.php';
    $conn->close(); ?>

</body>

</html>