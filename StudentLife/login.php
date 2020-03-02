
<html>
<?php
// Initialize the session


session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: profile.php");
    exit;
}
 
// Include config file
require_once "includes/database/connection.php";

 
// Define variables and initialize with empty values
$u_email = $u_password = "";
$u_email_err = $u_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if u_email is empty
    if(empty(trim($_POST["u_email"]))){
        $u_email_err = "Please enter your Email.";
    } else{
        $u_email = trim($_POST["u_email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["u_password"]))){
        $u_password_err = "Please enter your password.";
    } else{
        $u_password = trim($_POST["u_password"]);
    }
    
    // Validate credentials
    if(empty($u_email_err) && empty($u_password_err)){
        // Prepare a select statement
        $query = "SELECT user_ID, u_type, fname, lname, u_email, u_password FROM user WHERE u_email = :u_email";
        
        if($stmt = $conn->prepare($query)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":u_email", $param_u_email, PDO::PARAM_STR);
            
            // Set parameters
            $param_u_email = trim($_POST["u_email"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if u_email exists, if yes then verify Password
                if($stmt->rowCount() == 1){
                    session_start();
                    if($row = $stmt->fetch()){
                        $user_ID = $row["user_ID"];
                        $u_type = $row["u_type"];
                        $fname =$row["fname"];
                        $lname =$row["lname"];
                        $u_email = $row["u_email"];
                       
                       
                        $hashed_password = $row["u_password"];
                        if(password_verify($u_password, $hashed_password)){
                            // Password is correct, so start a new session
                           
                           
                            // Store data in session variables
                            $_SESSION["user_ID"] = $user_ID;
                            $_SESSION["loggedin"] = true;
                            $_SESSION["u_type"]   = $u_type;
                            $_SESSION["u_email"] = $u_email;
                            $_SESSION['fname'] = $fname;
                            $_SESSION['lname'] = $lname;   
                                                   
                            
                            // Redirect user to welcome page
                        }
                        if ($row['u_type'] ==1){
                            header("location: admin.php");
                        }
                        elseif($row['u_type'] ==0){
                            header("location: profile.php");
                        
                        } 
                        else{
                            // Display an error message if u_password is not valid
                            $u_password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if u_email doesn't exist
                    $u_email_err = "No account found with that email.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($pdo);
}
?>

<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <?php include_once 'includes/CDNs.php'; ?>
    <link rel="icon" href="images/recipeasy-icons-logos/Capture.png">
    <link href="includes/stylesheet.css" rel="stylesheet" type="text/css" />


</head>



<body class='site' >
    <?php include_once 'includes/nav-menu.php'; ?>

    <main class='site-content' >

    <div class="container">



    <center> <img class="login-logo" src="images/recipeasy-icons-logos/Capture.png" width="18%" alt="..."> </center>


    <form class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group col-md-12 <?php echo (!empty($u_email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="text" name="u_email" class="form-control" value="<?php echo $u_email; ?>">
                <span class="help-block"><?php echo $u_email_err; ?></span>
            </div>    
            <div class="form-group col-md-12 <?php echo (!empty($u_password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="u_password" class="form-control">
                <span class="help-block"><?php echo $u_password_err; ?></span>
            </div>
            <div class="form-group col-md-12">
                <input type="submit" class="btn btn-light" value="Login">
            </div>
            <p>Don't have an account? Register <a href="sign-up.php" class="here-link">Sign up now</a>.</p>
        </form>




    </div>
    </main>
    <?php include_once 'includes/footer.php';?>
 

</body>

</html>