<?php
// Include config file
require_once "includes/database/connection.php";
 
// Define variables and initialize with empty values
$name = $image = $video_name = $rating = $servings = $difficulty_text = $maxTime = "";
$name_err = $image_err = $video_name_err = $rating_err = $servings_err = $difficulty_text_err = $maxTime_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["recipe_ID"]) && !empty($_POST["recipe_ID"])){
    // Get hidden input value
    $id = $_POST["recipe_ID"];
    
    // Validate  Recipe Name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter recipe name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    // Validate image
    $input_image = trim($_POST["image"]);
    if(empty($input_image)){
        $image_err = "Please enter image name.";     
    } else{
        $image = $input_image;
    }

        // Validate video_name
        $input_video_name = trim($_POST["video_name"]);
        if(empty($input_video_name)){
            $video_name_err = "Please enter a video name.";     
        } else{
            $video_name = $input_video_name;
        }

            // Validate Rating
    $input_rating = trim($_POST["rating"]);
    if(empty($input_rating)){
        $rating_err = "Please enter a rating.";     
    } else{
        $rating = $input_rating;
    }


            // Validate servings
    $input_servings = trim($_POST["servings"]);
    if(empty($input_servings)){
        $servings_err = "Please enter a servings amount.";     
    } else{
        $servings = $input_servings;
    }

             // Validate Difficulty Text
             $input_difficulty_text = trim($_POST["difficulty_text"]);
             if(empty($input_difficulty_text)){
                 $difficulty_text_err = "Please enter a a Difficulty (Text).";     
             } else{
                 $difficulty_text = $input_difficulty_text;
             }
    
                   // Validate Difficulty Text
                   $input_maxTime = trim($_POST["maxTime"]);
                   if(empty($input_maxTime)){
                       $maxTime_err = "Please enter a a Maximum prep time.";     
                   } else{
                       $maxTime = $input_maxTime;
                   }

                
 
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($image_err) && empty($video_name_err) && empty($rating_err) && empty($servings_err) && empty($difficulty_text_err) && empty($maxTime_err)){
        // Prepare an update statement
        $query = "UPDATE recipes SET name=:name, image=:image, video_name=:video_name, rating=:rating, servings=:servings, difficulty_text=:difficulty_text, maxTime=:maxTime WHERE recipe_ID=:recipe_ID";
         
        if($stmt = $conn->prepare($query)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":name", $param_name);
            $stmt->bindParam(":image", $param_image);
            $stmt->bindParam(":video_name", $param_video_name);
            $stmt->bindParam(":rating", $param_rating);
            $stmt->bindParam(":servings", $param_servings);
            $stmt->bindParam(":difficulty_text", $param_difficulty_text);
            $stmt->bindParam(":maxTime", $param_maxTime);
            $stmt->bindParam(":recipe_ID", $param_id);
           
            
            // Set parameters
            $param_name = $name;
            $param_image = $image;
            $param_video_name = $video_name;
            $param_rating = $rating;
            $param_servings = $servings;
            $param_difficulty_text = $difficulty_text;
            $param_maxTime = $maxTime;
            $param_id = $id;
            
         // Attempt to execute the prepared statement
         if($stmt->execute()){
            // Records updated successfully. Redirect to landing page
            header("location: show-all-recipes.php");
            exit();
        } else{
            echo "Something went wrong. Please try again laters.";
        }
    }
     
    // Close statement
    unset($stmt);
}

// Close connection
unset($conn);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["recipe_ID"]) && !empty(trim($_GET["recipe_ID"]))){
        // Get URL parameter
        $id =  trim($_GET["recipe_ID"]);
        
        // Prepare a select statement
        $query = "SELECT * FROM recipes WHERE recipe_ID = :recipe_ID";
        if($stmt = $conn->prepare($query)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":recipe_ID", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    // Retrieve individual field value
                    $name = $row["name"];
                    $image = $row["image"];
                    $video_name = $row["video_name"];
                    $rating = $row["rating"];
                    $servings = $row["servings"];
                    $difficulty_text = $row["difficulty_text"];
                    $maxTime = $row["maxTime"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
    // Close statement
    unset($stmt);
        
    // Close connection
    unset($conn);
}  else{
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
    <title>Update Recipe</title>
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
                        <h2>Update Recipe</h2>
                    </div>
                    <p>Please edit the input values and submit to update the recipe.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($image_err)) ? 'has-error' : ''; ?>">
                            <label>Image</label>
                            <textarea name="image" class="form-control"><?php echo $image; ?></textarea>
                            <span class="help-block"><?php echo $image_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($video_name_err)) ? 'has-error' : ''; ?>">
                            <label>Video Name</label>
                            <input type="text" name="video_name" class="form-control" value="<?php echo $video_name; ?>">
                            <span class="help-block"><?php echo $video_name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($rating_err)) ? 'has-error' : ''; ?>">
                            <label>Rating</label>
                            <input type="text" name="rating" class="form-control" value="<?php echo $rating; ?>">
                            <span class="help-block"><?php echo $rating_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($servings_err)) ? 'has-error' : ''; ?>">
                            <label>Servings</label>
                            <textarea name="servings" class="form-control"><?php echo $servings; ?></textarea>
                            <span class="help-block"><?php echo $servings_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($difficulty_text_err)) ? 'has-error' : ''; ?>">
                            <label>Difficulty Text</label>
                            <input type="text" name="difficulty_text" class="form-control" value="<?php echo $difficulty_text; ?>">
                            <span class="help-block"><?php echo $difficulty_text_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($maxTime_err)) ? 'has-error' : ''; ?>">
                            <label>Max Time</label>
                            <input type="text" name="maxTime" class="form-control" value="<?php echo $maxTime; ?>">
                            <span class="help-block"><?php echo $maxTime_err;?></span>
                        </div>
                        <input type="hidden" name="recipe_ID" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="show-all-recipes.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>