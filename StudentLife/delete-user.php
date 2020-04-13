<?php
// Process delete operation after confirmation
if(isset($_POST["user_ID"]) && !empty($_POST["user_ID"])){
    // Include config file
    require_once "includes/database/connection.php";
    
    // Prepare a delete statement
    $query = "DELETE FROM user WHERE user_ID = :user_ID";
    
    if($stmt = $conn->prepare($query)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":user_ID", $param_id);
        
        // Set parameters
        $param_id = trim($_POST["user_ID"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            // Records deleted successfully. Redirect to landing page
            header("location: view-all-users.php");
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    unset($stmt);
    
    // Close connection
    unset($conn);
} else{
    // Check existence of id parameter
    if(empty(trim($_GET["user_ID"]))){
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/recipeasy-icons-logos/small-logo.png">
    <?php include_once 'includes/CDNs.php'; ?> 

</head>
<body class='site' >
<?php include_once 'includes/nav-menu.php'; ?>
<main class='site-content' >
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    
                        <h1>Delete Record</h1>
                  
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div>
                            <input type="hidden" name="user_ID" value="<?php echo trim($_GET["user_ID"]); ?>"/>
                            <p>Are you sure you want to delete this record?</p><br>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="view-all-users.php" class="btn btn-default">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
</main>
<?php include_once 'includes/footer.php';?>
</body>
</html>