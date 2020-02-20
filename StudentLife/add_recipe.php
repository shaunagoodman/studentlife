<?php

session_start();
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
// Include config file
require_once "includes/database/connection.php";
 
// Define variables and initialize with empty values
$name = $image = $video_name = $rating = $servings = $maxTime = $difficultyID = $time =  "";
$ingredient_name = $ingredient_measure = $ingredient_unit = "";
$name_err = $rating_err = $ingredient_err = $servings_err = $maxTime_err = $difficultyID_err = "";
$ingredient_ID = $recipe_ID = "";
$input_step = $steps_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // Validate  Recipe Name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    // Validate image
    $image = trim($_POST["image"]);


    // Validate video_name
    $ingredient_name = trim($_POST["ingredient_name"]);
    $ingredient_measure = trim($_POST["ingredient_measure"]);
    $ingredient_unit = trim($_POST["ingredient_unit"]);

    // Validate images


  // Validate rating
  if(isset($_POST['rating'])){
    $rating = $_POST['rating'];  // Storing Selected Value In Variable
}

// Validate servings
$input_step = trim($_POST["steps"]);
if(empty($input_step)){
    $steps_err = "Please enter a step.";     
} else{
    $steps = "1. " . $input_step;
}


    // Validate servings
    $input_servings = trim($_POST["servings"]);
    if(empty($input_servings)){
        $servings_err = "Please enter a servings amount.";     
    } else{
        $servings = $input_servings;
    }
    
    // Validate Max Time
    $input_maxTime = trim($_POST["maxTime"]);
    if(empty($input_maxTime)){
        $maxTime_err = "Please enter a a Maximum prep time.";     
    } else{
        $maxTime = $input_maxTime;
        if($maxTime < 60) { // less than an hour
            if ($maxTime < 10) {
                $time =  "00:0" . $maxTime . ":00"; // time is less than 10 mins
            }
            else {
                $time =  "00:" . $maxTime . ":00"; // between 10 - 59 mins
            }
        }
        else {
            $hr = floor(($maxTime / 60));
            $mins = $maxTime - ($hr * 60);
            if($hr > 10) {
                if($mins >= 10) {
                    $time =  $hr . ":".$mins.":00";
                }
                else {
                    $time =  $hr . ":0".$mins.":00";
                }
            }
            else {
                if($mins >= 10) {
                    $time =  "0".$hr. ":".$mins.":00";
                }
                else {
                    $time = "0".$hr. ":0".$mins.":00";
                }
            }
        }
    }

    if(isset($_POST['difficulty'])){
        $difficultyID = $_POST['difficulty'];  // Storing Selected Value In Variable
    }




    /******************** Add to ingredients table ************************/
    if(!empty($ingredient_name) && !empty($ingredient_measure) && !empty($ingredient_unit)) {
        $query2 = "INSERT INTO ingredients(ingredient_ID, name, amount, unit) VALUES (null, '$ingredient_name', '$ingredient_measure', '$ingredient_unit')";
        if($stmt = $conn->prepare($query2)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":ingredient_name", $ingredient_name);
            $stmt->bindParam(":ingredient_measure", $ingredient_measure);
            $stmt->bindParam(":ingredient_unit", $ingredient_unit);
            // Set parameters
            $param_ingredient_name = $ingredient_name;
            $param_ingredient_measure = $ingredient_measure;
            $param_ingredient_unit = $ingredient_unit;
            if($stmt->execute()){
                $ingredient_ID = $conn->lastInsertId();
                echo "Added ingredient";
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
    }
    
    /******************** Add to recipes table ************************/
    if(empty($name_err) && empty($rating_err) && empty($servings_err) && empty($maxTime_err)){
        $query = "INSERT INTO recipes (user_ID, name, image, video_name, rating, servings, maxTime, difficultyID) VALUES 
        (:user_ID, :name, :image, :video_name, :rating, :servings, :maxTime, :difficultyID)";
        if($stmt = $conn->prepare($query)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":user_ID", $_SESSION["user_ID"]);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":image", $image);
            $stmt->bindParam(":video_name", $video_name);
            $stmt->bindParam(":rating", $rating);
            $stmt->bindParam(":servings", $servings);
            $stmt->bindParam(":maxTime", $maxTime);
            $stmt->bindParam(":difficultyID", $difficultyID);
            
            // Set parameters
            $param_name = $name;
            $param_image = $image;
            $param_video_name = $video_name;
            $param_rating = $rating;
            $param_servings = $servings;
            $param_maxTime = $maxTime;
            $param_difficultyID = $difficultyID;

            if($stmt->execute()){
                $recipe_ID = $conn->lastInsertId();
               echo "Added recipe";
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
        unset($stmt);
    }
    else {
        echo "Could not do task";
    }

    /******************** Add to recipeIngredient table ************************/
    $query3 = "INSERT INTO recipeingredient (recipe_ID, ingredient_ID) VALUES ('$recipe_ID','$ingredient_ID')";
    $statement = $conn->prepare($query3);
    $statement->execute();
    $recipeIngredient = $statement->fetchAll();
    $statement->closeCursor();

    /******************** Add to steps table ************************/
    if(!empty($input_step)) {
        $query4 = "INSERT INTO steps(steps_ID, description) VALUES (null,'$input_step')";
        if($stmt = $conn->prepare($query4)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":step", $input_step);
            // Set parameters
            $param_step = $input_step;
            if($stmt->execute()){
                $step_ID = $conn->lastInsertId();
                echo "added step";
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
    }

    /******************** Add to recipesteps table ************************/
    $query4 = "INSERT INTO recipesteps(recipe_ID, steps_ID) VALUES ('$recipe_ID', '$step_ID')";
    $statement = $conn->prepare($query4);
    $statement->execute();
    $recipeStep = $statement->fetchAll();
    $statement->closeCursor();
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Recipe</title>
    <?php include_once 'includes/CDNs.php'; ?>
</head>
<body>
    <?php include_once 'includes/nav-menu.php'; 
    ?>
    <h2>Create Recipe</h2>
    <p>Please fill this form and submit recipe to the database.</p>
    <form class = "login-form" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
            <span class="help-block"><?php echo $name_err;?></span>
        </div>
        <div class="form-group">
            <label>Image</label>
            <textarea name="image" class="form-control"><?php echo $image; ?></textarea>
            <span class="help-block"></span>
        </div>
        <div class="form-group">
            <label>Video Name</label>
            <input type="text" name="video_name" class="form-control" value="<?php echo $video_name; ?>">
            <span class="help-block"></span>
        </div>
        <div id = "ingredients" class="form-group <?php echo (!empty($ingredient_err)) ? 'has-error' : ''; ?>"> 
            <label>Name</label>
                <input type="text" name="ingredient_name" class="form-control" value="<?php echo $ingredient_name; ?>">
            <label>Measure</label>
                <input type="text" name="ingredient_measure" class="form-control" value="<?php echo $ingredient_measure; ?>">
            <label>Unit</label>
                <input type="text" name="ingredient_unit" class="form-control" value="<?php echo $ingredient_unit; ?>">
        </div>
        <div class="form-group <?php echo (!empty($step_err)) ? 'has-error' : ''; ?>">
            <label>Steps</label>
            <textarea name="steps" class="form-control"></textarea>
            <span class="help-block"><?php echo $steps_err;?></span>
        </div>
        <div class="form-group <?php echo (!empty($rating_err)) ? 'has-error' : ''; ?>">
            <label>Rating</label>
            <select id = "rating" name = "rating">
                <option value = "1">1</option>
                <option value = "2">2</option>
                <option value = "3">3</option>
                <option value = "4">4</option>
                <option value = "5">5</option>
            </select>
            <span class="help-block"><?php echo $rating_err;?></span>
        </div>
        <div class="form-group <?php echo (!empty($servings_err)) ? 'has-error' : ''; ?>">
            <label>Servings</label>
            <textarea name="servings" class="form-control"><?php echo $servings; ?></textarea>
            <span class="help-block"><?php echo $servings_err;?></span>
        </div>
        <div class="form-group <?php echo (!empty($difficultyID_err)) ? 'has-error' : ''; ?>">
            <label>Difficulty</label>
                <select id = "difficulty" name = "difficulty">
                    <option value = "1">Easy </option>
                    <option value = "2">Medium</option>
                    <option value="3">Hard</option>
                </select>
            <span class="help-block"><?php echo $difficultyID_err;?></span>
        </div>
        <div class="form-group <?php echo (!empty($maxTime_err)) ? 'has-error' : ''; ?>">
            <label>Max Time</label>
            <input type="text" name="maxTime" class="form-control" value="<?php echo $time; ?>">
            <span class="help-block"><?php echo $maxTime_err;?></span>
        </div>
        <input type="hidden" name="recipe_ID" value="<?php echo $id; ?>"/>
        <input type="submit" class="btn btn-primary" value="Submit">
        <a href="show-all-recipes.php" class="btn btn-default">Cancel</a>
    </form>
    <?php include_once 'includes/footer.php'; ?>
</body>
</html>