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
$recipeName = $image = $video_name = $rating = $servings = $maxTime = $difficultyID = $time =  "";
$name_err = $rating_err = $ingredient_err = $servings_err = $maxTime_err = $difficultyID_err = "";
$ingredient_ID = $recipe_ID = $step_ID = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // Validate  Recipe Name
    $input_name = trim($_POST["recipeName"]);
    if(empty($input_name)){
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $recipeName = $input_name;
    }
    
    // Validate image
    $image = trim($_POST["image"]);


  // Validate rating
  if(isset($_POST['rating'])){
    $rating = $_POST['rating'];  // Storing Selected Value In Variable
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




    // /******************** Add to ingredients table ************************/
    // if(!empty($_POST["ingredient_name"]) && !empty($_POST["ingredient_measure"]) && !empty($_POST["ingredient_unit"])) {
    //     $names = [];
    //     $measures = [];
    //     $units = [];


    //     foreach($_POST["ingredient_name"] as $key => $name){
    //         array_push($names, $name);
    //     }
    //     foreach($_POST["ingredient_measure"] as $key => $measure){
    //         array_push($measures, $measure);
    //     }
    //     foreach($_POST["ingredient_unit"] as $key => $unit){
    //         array_push($units, $unit);
    //     }

    //     $count = count($names);
    //     for($x = 0; $x < $count; $x++){
    //         $sql = "INSERT INTO ingredients (ingredient_ID, name, amount, unit) VALUES (null,'$names[$x]','$measures[$x]','$units[$x]')";
    //         $statement = $conn->prepare($sql);
    //         $statement->execute();
    //         $recipes = $statement->fetchAll();
    //         $ingredient_ID = $conn->lastInsertId();
    //     }
    // }

    
    // /******************** Add to recipes table ************************/
    // if(empty($name_err) && empty($rating_err) && empty($servings_err) && empty($maxTime_err)){
    //     $query = "INSERT INTO recipes (user_ID, name, image, video_name, rating, servings, maxTime, difficultyID) VALUES 
    //     (:user_ID, :recipeName, :image, :video_name, :rating, :servings, :maxTime, :difficultyID)";
    //     if($stmt = $conn->prepare($query)){
    //         // Bind variables to the prepared statement as parameters
    //         $stmt->bindParam(":user_ID", $_SESSION["user_ID"]);
    //         $stmt->bindParam(":recipeName", $recipeName);
    //         $stmt->bindParam(":image", $image);
    //         $stmt->bindParam(":video_name", $video_name);
    //         $stmt->bindParam(":rating", $rating);
    //         $stmt->bindParam(":servings", $servings);
    //         $stmt->bindParam(":maxTime", $maxTime);
    //         $stmt->bindParam(":difficultyID", $difficultyID);
            
    //         // Set parameters
    //         $param_name = $recipeName;
    //         $param_image = $image;
    //         $param_video_name = $video_name;
    //         $param_rating = $rating;
    //         $param_servings = $servings;
    //         $param_maxTime = $maxTime;
    //         $param_difficultyID = $difficultyID;

    //         if($stmt->execute()){
    //             $recipe_ID = $conn->lastInsertId();
    //            echo "Added recipe";
    //         } else{
    //             echo "Something went wrong. Please try again later.";
    //         }
    //     }
    //     unset($stmt);
    // }
    // else {
    //     echo "Could not do task";
    // }

    // /******************** Add to recipeIngredient table ************************/
    // $query3 = "INSERT INTO recipeingredient (recipe_ID, ingredient_ID) VALUES ('$recipe_ID','$ingredient_ID')";
    // $statement = $conn->prepare($query3);
    // $statement->execute();
    // $recipeIngredient = $statement->fetchAll();
    // $statement->closeCursor();



    // /******************** Add to steps table ************************/
    if(!empty($_POST["steps"])) {
        $input = "";
        $count = 1;
	    foreach($_POST["steps"] as $key => $step){
            $input .= $count . ". " . $step . " ";
            $count++;
        }
        $sql = "INSERT INTO steps(steps_ID, description) VALUES (null,'$input')";
        echo $sql;
        $statement = $conn->prepare($sql);
        if($statement->execute()) {
        }
        else {
            echo "Something went wrong. Please try again later.";
        }
        $recipes = $statement->fetchAll();
        $step_ID = $conn->lastInsertId();
    }
    else {
        echo "Enter steps";
    }

    // /******************** Add to recipesteps table ************************/
    // $query4 = "INSERT INTO recipesteps(recipe_ID, steps_ID) VALUES ('$recipe_ID', '$step_ID')";
    // $statement = $conn->prepare($query4);
    // $statement->execute();
    // $recipeStep = $statement->fetchAll();
    // $statement->closeCursor();
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Recipe</title>
    <script src="javascript/scripts.js"></script>
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
            <input type="text" name="recipeName" class="form-control">
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
        
        <div id = "addedIngredient" class="form-group <?php echo (!empty($ingredient_err)) ? 'has-error' : ''; ?>"> 
        <label> Ingredients </label>
        </div>
        <button id = "addBtn" type = "button" class="btn api-button" onClick="addIngredient()"> +</button>
        <div id = "addedStep" class="form-group <?php echo (!empty($step_err)) ? 'has-error' : ''; ?>">
        <label> Method </label>
        
        </div>
        <button id = "addBtn" type = "button" class="btn api-button" onClick="addStep()"> +</button>
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