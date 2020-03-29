<?php
// Check existence of id parameter before processing further
if(isset($_GET["recipe_ID"]) && !empty(trim($_GET["recipe_ID"]))){
    // Include config file
    require_once "includes/database/connection.php";
    
    // Prepare a select statement
    $query = "SELECT * FROM recipes WHERE recipe_ID, user_ID, name, image, video_name, rating, servings, 
    difficulty_text, maxTime, difficultyID, date_created = :recipe_ID  ";
    
    if($stmt = $conn->prepare($query)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":recipe_ID", $param_recipe_ID);
        $stmt->bindParam(":user_ID", $param_user_ID);
        $stmt->bindParam(":name", $param_name);
        $stmt->bindParam(":image", $param_image);
        $stmt->bindParam(":video_name", $param_video_name);
        $stmt->bindParam(":rating", $param_rating);
        $stmt->bindParam(":servings", $param_servings);
        $stmt->bindParam(":difficulty_text", $param_difficulty_text);
        $stmt->bindParam(":maxTime", $param_maxTime);
        $stmt->bindParam(":difficultyID", $param_DifficultyID);
        $stmt->bindParam(":date_created", $param_date_created);
        
        // Set parameters
        $param_recipe_ID = trim($_GET["recipe_ID"]);
        $param_user_ID = trim($_GET["ruser_ID"]);
        $param_name = trim($_GET["name"]);
        $param_image = trim($_GET["image"]);
        $param_video_name = trim($_GET["video_name"]);
        $param_rating = trim($_GET["rating"]);
        $param_servings = trim($_GET["servings"]);
        $param_difficulty_text = trim($_GET["difficulty_text"]);
        $param_maxTime = trim($_GET["maxTIme"]);
        $param_difficultyID = trim($_GET["difficultyID"]);
        $param_date_created = trim($_GET["date_created"]);

     

        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                // Retrieve individual field value
                
                $recipe_ID = $row["recipe_ID"];
                $user_ID = $row["user_ID"];
                $name = $row["name"];
                $image = $row["image"];
                $vide_name = $row["video_name"];  
                $rating = $row["rating"];
                $servings = $row["servings"];
                $difficulty_text = $row["difficulty_text"];
                $maxTime = $row["maxTime"];
                $difficultyID = $row["difficultyID"];
                $date_created = $row["date_created"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
               // header("location: error.php");
              //  exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    unset($stmt);
    
    // Close connection
    unset($pdo);
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
    <link rel="icon" href="images/recipeasy-icons-logos/small-logo.png">
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
                        <h1>View Record</h1>
                    </div>
                    <div class="form-group">
                        <label>Recipe ID</label>
                        <p class="form-control-static"><?php echo $row["recipe_ID"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>User ID</label>
                        <p class="form-control-static"><?php echo $row["user_ID"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Recipe Name</label>
                        <p class="form-control-static"><?php echo $row["name"]; ?></p>
                    </div>

                    <div class="form-group">
                        <label>Recipe Image</label>
                        <p class="form-control-static"><?php echo $row["image"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Recipe Video</label>
                        <p class="form-control-static"><?php echo $row["video_name"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Recipe Rating</label>
                        <p class="form-control-static"><?php echo $row["rating"]; ?></p>
                    </div>

                    <div class="form-group">
                        <label>Recipe Servings</label>
                        <p class="form-control-static"><?php echo $row["serving"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Difficulty Text</label>
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
                 
             
                    </div>
                    <p><a href="my-recipes.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>