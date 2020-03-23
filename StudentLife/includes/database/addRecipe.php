<?php 
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