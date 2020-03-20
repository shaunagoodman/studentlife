<?php

session_start();
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
// Include config file
require_once "includes/database/connection.php";
$recipeName = $image = $video_name = $rating = $servings = $maxTime = $difficultyID = $time =  "";
$name_err = $rating_err = $ingredient_err = $servings_err = $maxTime_err = $difficultyID_err = "";
$ingredient_ID = $recipe_ID = $step_ID = "";



// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate  Recipe Name
    $input_name = trim($_POST["recipeName"]);
    if (empty($input_name)) {
    } elseif (!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $name_err = "Please enter a valid name.";
    } else {
        $recipeName = $input_name;
    }
    $recipeName = $input_name;

    // Validate  Video
    $video = trim($_POST["video_name"]);
    $video_name =  substr($video,-11);
    echo $video_name;

    // Validate image
    $image = trim($_FILES["image"]["name"]);
    $imgFile = $_FILES["image"]["name"];
    $tmp_dir = $_FILES["image"]["tmp_name"];
    $imgSize = $_FILES["image"]["size"];
    $upload_dir = "images/recipes/"; // upload directory
    $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension

    // valid image extensions
    $valid_extensions = array("jpeg", "jpg", "png", "gif"); // valid extensions

    // rename uploading image
    if(empty($image)) {
        $image = "placeholder.png";
    }
    else {
        $image = rand(1000, 1000000) . "." . $imgExt;
    }

    // allow valid image file formats
    if (in_array($imgExt, $valid_extensions)) {
        // Check file size "5MB"
        if ($imgSize < 5000000) {
            move_uploaded_file($tmp_dir, $upload_dir . $image);
        } else {
            $error_message = "Sorry, your file is too large.";
        }
    } else {
        $error_message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }


    // Validate rating
    if (isset($_POST["rating"])) {
        $rating = $_POST["rating"];  // Storing Selected Value In Variable
    }


    // Validate servings
    $input_servings = trim($_POST["servings"]);
    if (empty($input_servings)) {
        $servings_err = "Please enter a servings amount.";
    } else {
        $servings = $input_servings;
    }

    // Validate Max Time
    $input_maxTime = trim($_POST["maxTime"]);
    if (empty($input_maxTime)) {
        $maxTime_err = "Please enter a a Maximum prep time.";
    } else {
        $maxTime = $input_maxTime;
        if ($maxTime < 60) { // less than an hour
            if ($maxTime < 10) {
                $time =  "00:0" . $maxTime . ":00"; // time is less than 10 mins
            } else {
                $time =  "00:" . $maxTime . ":00"; // between 10 - 59 mins
            }
        } else {
            $hr = floor(($maxTime / 60));
            $mins = $maxTime - ($hr * 60);
            if ($hr > 10) {
                if ($mins >= 10) {
                    $time =  $hr . ":" . $mins . ":00";
                } else {
                    $time =  $hr . ":0" . $mins . ":00";
                }
            } else {
                if ($mins >= 10) {
                    $time =  "0" . $hr . ":" . $mins . ":00";
                } else {
                    $time = "0" . $hr . ":0" . $mins . ":00";
                }
            }
        }
    }
    if (isset($_POST["difficulty"])) {
        $difficultyID = $_POST["difficulty"];  // Storing Selected Value In Variable
    }

    $names = [];
    $measures = [];
    $units = [];

if (!empty($_POST["ingredient_name"]) && !empty($_POST["ingredient_measure"]) && !empty($_POST["ingredient_unit"])) {

    foreach ($_POST["ingredient_name"] as $key => $name) {
        array_push($names, $name);
    }
    foreach ($_POST["ingredient_measure"] as $key => $measure) {
        array_push($measures, $measure);
    }
    foreach ($_POST["ingredient_unit"] as $key => $unit) {
        array_push($units, $unit);
    }
}

    /******************** Add to recipes table ************************/
    if (empty($name_err) && empty($rating_err) && empty($servings_err) && empty($maxTime_err)) {
        $user_ID = $_SESSION["user_ID"];
        $query = "INSERT INTO recipes (user_ID, name, image, video_name, rating, servings, maxTime, difficultyID) VALUES 
        ('$user_ID', '$recipeName', '$image', '$video_name', '$rating', '$servings', '$time', '$difficultyID')";
        $statement1 = $conn->prepare($query);
        $statement1->execute();
        $recipe_ID = $conn->lastInsertId();
    }
         /******************** Add to ingredients table ************************/
            $count = count($names);
            for ($x = 0; $x < $count; $x++) {
             $sql = "INSERT INTO ingredients (ingredient_ID, name, amount, unit) VALUES (null,'$names[$x]','$measures[$x]','$units[$x]')";
             $statement2 = $conn->prepare($sql);
             if($statement2->execute()) {
                 $ingredient_ID = $conn->lastInsertId();
                 /******************** Add to recipeIngredient table ************************/
                 $query3 = "INSERT INTO recipeingredient (recipe_ID, ingredient_ID) VALUES ('$recipe_ID','$ingredient_ID')";
                 $statement3 = $conn->prepare($query3);
                 $statement3->execute();
             }
         }
         // /******************** Add to steps table ************************/
        if (!empty($_POST["steps"])) {
            $input = "";
            $count = 1;
            foreach ($_POST["steps"] as $key => $step) {
                $input .= $count . ". " . $step . " ";
                $count++;
            }
            $sql2 = "INSERT INTO steps(steps_ID, description) VALUES (null,'$input')";
            $statement4 = $conn->prepare($sql2);
        if ($statement4->execute()) {
            $step_ID = $conn->lastInsertId();
            /******************** Add to recipesteps table ************************/
            $query4 = "INSERT INTO recipesteps(recipe_ID, steps_ID) VALUES ('$recipe_ID', '$step_ID')";
            $statement5 = $conn->prepare($query4);
            $statement5->execute();
            $statement5->closeCursor();
            unset($stmt);
        } else {
            echo "Something went wrong. Please try again later.";
        }

        }
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

<body class='site' >
    <?php include_once 'includes/nav-menu.php';
    ?>
<main class='site-content' >

    <div class='container' >
    <h2 class='allRecipes-h1'><span class="underline">Create Recipe</span></h2>
    <p>Please fill this form and submit recipe to the database.</p>

    <form class=" create-recipe-form" enctype="multipart/form-data" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

    <div class='row' > 
        <div class="form-group col-md-6 <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
            <label>Name</label>
            <input type="text" name="recipeName" class="form-control">
            <span class="help-block"><?php echo $name_err; ?></span>
        </div>

       
    
        <div class="form-group col-md-6">
            <label>Video Name</label>
            <input class="form-control" type="text" name="video_name" />
            <span class="help-block"></span>
        </div>
    </div>
                   <!-- ---------------------------- -->
                  <div class='row' >
        <div id="addedIngredient" class="col-md-6 form-group <?php echo (!empty($ingredient_err)) ? 'has-error' : ''; ?>">
            <label> Ingredients </label>
            <button id="addBtn" type="button" class="btn btn-sm add-recipe-button"  onClick="addIngredient()"> Add Ingredient</button>
        </div>
        

        <br>
        <div id="addedStep" class="col-md-6 form-group <?php echo (!empty($step_err)) ? 'has-error' : ''; ?>">
            <label> Method </label>
           <button id="addBtn" type="button" class="btn btn-sm add-recipe-button"  onClick="addStep()" > Add Step</button>
        </div>
        
                  </div>
        <!-- ---------------------------- -->

        <div class=row >

        <div class="form-group col-md-6 <?php echo (!empty($servings_err)) ? 'has-error' : ''; ?>">
            <label>Servings</label>
            <input type="text" name="servings" class="form-control" value="<?php echo $servings; ?>">
            <span class="help-block"><?php echo $servings_err; ?></span>
        </div>

        <div class="form-group col-md-6 <?php echo (!empty($maxTime_err)) ? 'has-error' : ''; ?>">
            <label>Max Time</label>
            <input type="text" name="maxTime" class="form-control" value="<?php echo $time; ?>">
            <span class="help-block"><?php echo $maxTime_err; ?></span>
        </div>

        </div>
        <!-- ---------------------------- -->
<div class='row' >

        <div class="form-group col-md-4 <?php echo (!empty($difficultyID_err)) ? 'has-error' : ''; ?>">
            <label>Difficulty</label>
            <select id="difficulty" name="difficulty">
                <option value="1">Easy </option>
                <option value="2">Medium</option>
                <option value="3">Hard</option>
            </select>
            <span class="help-block"><?php echo $difficultyID_err; ?></span>
        </div>

        <div class="form-group col-md-4 <?php echo (!empty($rating_err)) ? 'has-error' : ''; ?>">
            <label>Rating</label>
            <select id="rating" name="rating">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <span class="help-block"><?php echo $rating_err; ?></span>
        </div>

        <div class="form-group col-md-4 ">
            <label>Image</label>
            <input class="input-group " type="file" name="image" accept="image/*" />

        </div>

        </div>


        <input type="hidden" name="recipe_ID" value="<?php echo $id; ?>" />
        <input type="submit" class="btn btn-light" value="Submit">
        <a href="show-all-recipes.php" class="btn btn-light">Cancel</a>
    </form>

    </div>
</main>
    <?php include_once 'includes/footer.php'; ?>
</body>

</html>