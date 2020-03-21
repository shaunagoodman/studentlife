<?php
// Process delete operation after confirmation
if(isset($_POST["recipe_ID"]) && !empty($_POST["recipe_ID"])){
    // Include config file
    require_once "includes/database/connection.php";
    
    // Prepare a delete statement
    $query = "DELETE FROM recipes WHERE recipe_ID = :recipe_ID";
    
    if($stmt = $conn->prepare($query)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":recipe_ID", $param_id);
        
        // Set parameters
        $param_id = trim($_POST["recipe_ID"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            // Records deleted successfully. Redirect to landing page
            header("location: view-recipes-admin.php");
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
    if(empty(trim($_GET["recipe_ID"]))){
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
    <title>Delete Recipe</title>
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
                        <div >
                            <input type="hidden" name="recipe_ID" value="<?php echo trim($_GET["recipe_ID"]); ?>"/>
                            <p>Are you sure you want to delete this record?</p><br>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="view-recipes-admin.php" class="btn btn-default">No</a>
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