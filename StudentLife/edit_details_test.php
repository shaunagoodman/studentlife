<?php

// Include config file
require_once "includes/database/connection.php";

// Initialize the session
session_start();


 
// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login_test.php");
    exit;
}
 

 
// Define variables and initialize with empty values
$new_fname = $new_lname =  $new_u_email = $new_u_password = $confirm_u_password = "";
$new_fname_err = $new_lname_err = $new_u_email_err = $new_u_password_err = $confirm_u_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

      
 
    // Validate new First Name
    if(empty(trim($_POST["new_fname"]))){
        $new_fname_err = "Please enter the new First Name.";     
    }  else{
        $new_fname = trim($_POST["new_fname"]);
    }

     // Validate new Last Name
     if(empty(trim($_POST["new_lname"]))){
        $new_lname_err = "Please enter the new Last Name.";     
    }  else{
        $new_lname = trim($_POST["new_lname"]);
    }
   
      // Validate new Email
      if(empty(trim($_POST["new_u_email"]))){
        $new_u_email_err = "Please enter the new Email.";     
    }  else{
        $new_u_email = trim($_POST["new_u_email"]);
    }
   
    // Validate new u_password
    if(empty(trim($_POST["new_u_password"]))){
        $new_u_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_u_password"])) < 6){
        $new_u_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_u_password = trim($_POST["new_u_password"]);
    }
    
    // Validate confirm Pasword
    if(empty(trim($_POST["confirm_u_password"]))){
        $confirm_u_password_err = "Please confirm the password.";
    } else{
        $confirm_u_password = trim($_POST["confirm_u_password"]);
        if(empty($new_u_password_err) && ($new_u_password != $confirm_u_password)){
            $confirm_u_password_err = "Password did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_fname_err) && empty($new_lname_err) && empty($new_u_email_err) && empty($new_u_password_err) && empty($confirm_u_password_err)){
        // Prepare an update statement
        $query = "UPDATE user SET fname, lname, u_email, u_password = :fname, :lname, :u_email, :u_password WHERE user_ID = :user_ID";
        
        if($stmt = $conn->prepare($query)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":user_ID", $param_user_ID, PDO::PARAM_INT);
            $stmt->bindParam(":fname", $param_fname, PDO::PARAM_STR);
            $stmt->bindParam(":lname", $param_lname, PDO::PARAM_STR);
            $stmt->bindParam(":u_email", $param_u_email, PDO::PARAM_STR);
            $stmt->bindParam(":u_password", $param_u_password, PDO::PARAM_STR);
          
            
            // Set parameters
            
            $param_fname = $new_fname;
            $param_lname = $new_lname;
            $param_u_email = $new_u_email;
            $param_u_password = password_hash($new_u_password, PASSWORD_DEFAULT);
            $param_user_ID = $_SESSION["user_ID"];
            
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Details were updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: login_test.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($conn);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>

    <?php include_once 'includes/CDNs.php'; ?>

    <link href="includes/stylesheet.css" rel="stylesheet" type="text/css" />


</head>
<body>
<?php include_once 'includes/nav-menu.php'; ?>
    <div class="container">
  <center> <h2>Reset your Personal Information</h2>  </center> 
       


        <form class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
        <div class="form-group col-md-12 <?php echo (!empty($new_fname_err)) ? 'has-error' : ''; ?>">
                <label>New First Name</label>
                <input type="text" name="new_fname" class="form-control" value="<?php echo $new_fname; ?>">
                <span class="help-block"><?php echo $new_fname_err; ?></span>
            </div>
           
            <div class="form-group col-md-12<?php echo (!empty($new_lname_err)) ? 'has-error' : ''; ?>">
                <label>New Last Name</label>
                <input type="text" name="new_lname" class="form-control" value="<?php echo $new_lname; ?>">
                <span class="help-block"><?php echo $new_lname_err; ?></span>
            </div>

            <div class="form-group col-md-12 <?php echo (!empty($new_u_email_err)) ? 'has-error' : ''; ?>">
                <label>New Email</label>
                <input type="text" name="new_u_email" class="form-control" value="<?php echo $new_u_email; ?>">
                <span class="help-block"><?php echo $new_u_email_err; ?></span>
            </div>
           
           
            <div class="form-group col-md-12 <?php echo (!empty($new_u_password_err)) ? 'has-error' : ''; ?>">
                <label>New Password</label>
                <input type="password" name="new_u_password" class="form-control" value="<?php echo $new_u_password; ?>">
                <span class="help-block"><?php echo $new_u_password_err; ?></span>
            </div>
            <div class="form-group col-md-12<?php echo (!empty($confirm_u_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_u_password" class="form-control">
                <span class="help-block"><?php echo $confirm_u_password_err; ?></span>
            </div>
            <div class="form-group col-md-12">
                <input type="submit" class="btn btn-light" value="Submit">
                <a class="here-link" href="profile.php">Cancel</a>
            </div>
        </form>
    </div> 

        <?php include_once 'includes/footer.php'; ?>   
</body>
</html>