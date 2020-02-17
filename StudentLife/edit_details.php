<?php


// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Include config file
require_once "includes/database/connection.php";

 
// Define variables and initialize with empty values
$new_fname = $new_lname =  $new_u_email =  "";
$new_fname_err = $new_lname_err = $new_u_email_err =  "";


 
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


        
    // Check input errors before updating the database
    if(empty($new_fname_err) && empty($new_lname_err) && empty($new_u_email_err)){
        // Prepare an update statement
        $query = "UPDATE user SET fname =:fname, lname =:lname, u_email = :u_email WHERE user_ID = :user_ID";
        
        if($stmt = $conn->prepare($query)){
            // Bind variables to the prepared statement as parameters
           
            $stmt->bindParam(":fname", $param_fname, PDO::PARAM_STR);
            $stmt->bindParam(":lname", $param_lname, PDO::PARAM_STR);
            $stmt->bindParam(":u_email", $param_u_email, PDO::PARAM_STR);     
            $stmt->bindParam(":user_ID", $param_user_ID, PDO::PARAM_INT);
            
            // Set parameters
            
            $param_fname = $new_fname;
            $param_lname = $new_lname;
            $param_u_email = $new_u_email;
            $param_user_ID = $_SESSION["user_ID"];
            
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Details were updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: login.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
      
        
        // Close statement
        unset($stmt);
        }
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
           
           
           
            <div class="form-group col-md-12">
                <input type="submit" class="btn btn-light" value="Submit">
                <a class="here-link" href="profile.php">Cancel</a>
            </div>
        </form>
    </div> 

        <?php include_once 'includes/footer.php'; ?>   
</body>
</html>