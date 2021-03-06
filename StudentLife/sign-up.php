<?php
// Include config file
require_once "includes/database/connection.php";
 
// Define variables and initialize with empty values
 $fname = $lname = $u_email = $u_password = $confirm_u_password = "";
 $fname_err = $lname_err = $u_email_err = $u_password_err = $confirm_u_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate u_email
    if(empty(trim($_POST["u_email"]))){
        $u_email_err = "Please enter an Email.";
    } else{
        // Prepare a select statement
        $query = "SELECT user_ID FROM user WHERE u_email = :u_email";
        
       
 
 
    // Validate firstname
  if(empty(trim($_POST["fname"]))){
    $fname_err = "Please enter First Name.";     
} else{
    $fname = trim($_POST["fname"]);
}  

// Validate lastname
if(empty(trim($_POST["lname"]))){
    $lname_err = "Please enter a Last Name.";     
}  else{
    $lname = trim($_POST["lname"]);

}
  
if($stmt = $conn->prepare($query)){
    // Bind variables to the prepared statement as parameters
    $stmt->bindParam(":u_email", $param_u_email, PDO::PARAM_STR);
    
    // Set parameters
    $param_u_email = trim($_POST["u_email"]);
    
    // Attempt to execute the prepared statement
    if($stmt->execute()){
        if($stmt->rowCount() == 1){
            $u_email_err = "This Email is already used.";
        } else{
            $u_email = trim($_POST["u_email"]);
        }
    } else{
        echo "Oops! Something went wrong. Please try again later.";
    }
}
 
// Close statement
unset($stmt);
}
    
    // Validate u_password
    if(empty(trim($_POST["u_password"]))){
        $u_password_err = "Please enter a Password.";     
    } elseif(strlen(trim($_POST["u_password"])) < 6){
        $u_password_err = "Password must have atleast 6 characters.";
    } else{
        $u_password = trim($_POST["u_password"]);
    }
    
    // Validate confirm u_password
    if(empty(trim($_POST["confirm_u_password"]))){
        $confirm_u_password_err = "Please confirm Password.";     
    } else{
        $confirm_u_password = trim($_POST["confirm_u_password"]);
        if(empty($u_password_err) && ($u_password != $confirm_u_password)){
            $confirm_u_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($fname_err) && empty($lname_err) && empty($u_email_err) && empty($u_password_err) && empty($confirm_u_password_err)){
        
        // Prepare an insert statement
        $query = "INSERT INTO user (fname, lname, u_email, u_password,isActive) VALUES (:fname, :lname, :u_email, :u_password, 1)";
         
        if($stmt = $conn->prepare($query)){
            // Bind variables to the prepared statement as parameters
           
            $stmt->bindParam(":fname", $param_fname, PDO::PARAM_STR);
            $stmt->bindParam(":lname", $param_lname, PDO::PARAM_STR);
            $stmt->bindParam(":u_email", $param_u_email, PDO::PARAM_STR);
            $stmt->bindParam(":u_password", $param_u_password, PDO::PARAM_STR);
            
            // Set parameters
        
            $param_fname = $fname;
            $param_lname = $lname;
            $param_u_email = $u_email;
            $param_u_password = password_hash($u_password, PASSWORD_DEFAULT); // Creates a u_password hash
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($pdo);
}
?>

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
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="images/recipeasy-icons-logos/small-logo.png">


        <link href="includes/stylesheet.css" rel="stylesheet" type="text/css"/>
    </head>
<body class='site sign-up-body' >
<?php include_once 'includes/nav-menu.php'; ?> 
<main class='site-content' >
<div class="container" >


<center> <img data-aos="fade-in" data-aos-once="true" data-aos-duration="1000" src="images/recipeasy-icons-logos/new-logo-black.png" class="d-inline-block align-top signup-logo" alt="recipeasy-logo" style='width:45%' /> </center>




<form class="register-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            
<fieldset>
        <div class="form-row">
            
            <div data-aos="fade-in" data-aos-once="true" data-aos-delay="50" data-aos-duration="1000" class="form-group col-md-6 <?php echo (!empty($fname_err)) ? 'has-error' : ''; ?>">
                <label>First Name</label>
                <input type="text" name="fname" class="form-control" value="<?php echo $fname; ?>">
                <span class="help-block"><?php echo $fname_err; ?></span>
            </div>
            <div data-aos="fade-in" data-aos-once="true" data-aos-delay="50" data-aos-duration="1000" class="form-group col-md-6 <?php echo (!empty($lname_err)) ? 'has-error' : ''; ?>">
                <label>Last Name</label>
                <input type="text" name="lname" class="form-control" value="<?php echo $lname; ?>">
                <span class="help-block"><?php echo $lname_err; ?></span>
            </div>   
          
            <div data-aos="fade-in" data-aos-once="true" data-aos-delay="100" data-aos-duration="1000" class="form-group col-md-12 <?php echo (!empty($u_email_err)) ? 'has-error' : ''; ?>"> 
            <label>Email</label>
                <input type="text" name="u_email" class="form-control" value="<?php echo $u_email; ?>">
                <span class="help-block"><?php echo $u_email_err; ?></span>
            </div>
            
            <div data-aos="fade-in" data-aos-once="true" data-aos-delay="150" data-aos-duration="1000" class="form-group col-md-6 <?php echo (!empty($u_password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="u_password" class="form-control" value="<?php echo $u_password; ?>">
                <span class="help-block"><?php echo $u_password_err; ?></span>
            </div>
            <div data-aos="fade-in" data-aos-once="true" data-aos-delay="150" data-aos-duration="1000" class="form-group col-md-6 <?php echo (!empty($confirm_u_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm password</label>
                <input type="password" name="confirm_u_password" class="form-control" value="<?php echo $confirm_u_password; ?>">
                <span class="help-block"><?php echo $confirm_u_password_err; ?></span>
            </div>
            <div class="form-group col-md-12">
            <button  type="submit" name="submit" value=" Submit " class="btn btn-light sign-up-btn btn-sm">
                    Register</button>
                <input type="reset" class="btn btn-light sign-up-btn btn-sm" value="Reset">
            </div>
            <br><br>
            <p>Already have an account? <a href="login.php" class="here-link">Login Here</a>.</p>
            </div>
    </fieldset>
        </form>





</div>
</main>
<?php
include_once 'includes/footer.php';

?>
</body>
</html>