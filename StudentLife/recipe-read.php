<?php
// Check existence of id parameter before processing further
if(isset($_GET["recipe_ID"]) && !empty(trim($_GET["recipe_ID"]))){
    // Include config file
    require_once "includes/database/connection.php";
    
    // Prepare a select statement
    $query = "SELECT * FROM recipes WHERE recipe_ID=:recipe_ID";
    
    if($result = $conn->prepare($query)){
        $result->bindParam(":recipe_ID", $param_id);
        $param_id = trim($_GET["recipe_ID"]);
        if($result->execute()){
            if($result->rowCount() == 1){
                /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                $row = $result->fetch(PDO::FETCH_ASSOC);
                
                // Retrieve individual field value
                $recipe_ID = $row["recipe_ID"];
                $user_ID = $row["user_ID"];
                $name = $row["name"];
                $image = $row["image"];
                $video_name = $row["video_name"];
                $rating = $row["rating"];
                $servings = $row["servings"];
                $difficulty_text = $row["difficulty_text"];
                $maxTime = $row["maxTime"];
                $difficultyID = $row["difficultyID"];
                $date_created = $row["date_created"];
               
            } else{
                 // URL doesn't contain valid id parameter. Redirect to error page
             header("location: error1.php");
              exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close result
    unset($result);
    
    // Close connection
    unset($conn);
} else{
     // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>View Recipe</h1>
                    </div>
                    <div class="form-group">
                        <label>Recipe ID#</label>
                        <p class="form-control-static"><?php echo $row["recipe_ID"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Recipe User ID#</label>
                        <p class="form-control-static"><?php echo $row["user_ID"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Recipe Name</label>
                        <p class="form-control-static"><?php echo $row["name"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <p class="form-control-static"><?php echo $row["image"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Video Name</label>
                        <p class="form-control-static"><?php echo $row["video_name"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Rating</label>
                        <p class="form-control-static"><?php echo $row["rating"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Servings</label>
                        <p class="form-control-static"><?php echo $row["servings"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Difficulty</label>
                        <p class="form-control-static"><?php echo $row["difficulty_text"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Max Time</label>
                        <p class="form-control-static"><?php echo $row["maxTime"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Difficulty ID</label>
                        <p class="form-control-static"><?php echo $row["difficultyID"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Date Created</label>
                        <p class="form-control-static"><?php echo $row["date_created"]; ?></p>
                    </div>
                   
                    <p><a href="show-all-recipes.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>