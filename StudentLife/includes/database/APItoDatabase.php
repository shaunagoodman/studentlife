<?php  
include_once 'includes/database/connection.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_SESSION["loggedin"])) {
        $user = $_SESSION['user_ID'];
        $url = "https://api.spoonacular.com/recipes/".$recipe_ID."/information?apiKey=53bea2eb3c79445188bc4d3f00895d15";
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
            )); 
            $response = curl_exec($curl);
            $response = json_decode($response, true);
            $err = curl_error($curl);
            curl_close($curl);
        $title =  $response["title"];
        $servings =  $response["servings"];
        $image = $response["image"];
        $maxTime = $response['readyInMinutes'];
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
        $ingredients = [];
        $unit = [];
        $amount = [];
        $method = [];

        foreach ($response['cuisines'] as $cuisine){
          echo $cuisine ."</br>";
        }

        foreach($response['extendedIngredients'] as $ingredient) {
          // check if ingredient is in array
          if (!in_array($ingredient['name'], $ingredients))
          {
              $ingredients[] = $ingredient['name']; 
              $measure = $ingredient['measures'];
              $unit[] = $measure['metric']['unitShort'];
              $amount[] = $measure['metric']['amount'];
          }
        }
        foreach($response['analyzedInstructions'] as $instruction) {
          foreach($instruction['steps'] as $step) {
            array_push($method, $step['step']);
          }
        }

        //  **************** CHECK IF EXISTS ****************
        $query = "SELECT * FROM recipes WHERE recipe_ID = $recipe_ID";
        $statement = $conn->prepare($query);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if(!$row) {
                //  **************** ADD TO RECIPES TABLE ****************
                $addToRecipe = "INSERT INTO recipes(recipe_ID, user_ID, name, image, video_name, rating, servings, maxTime, difficultyID, date_created, isAPI) VALUES ($recipe_ID,'$user','$title','$image',null,null,'$servings','$time',null,null,1)";
                $statement = $conn->prepare($addToRecipe);
                $recipe = $statement->fetchAll();
                $statement->execute();
                $statement->closeCursor();
                $recipe_ID = $conn->lastInsertId();
//  **************** ADD TO INGREDIENTS TABLE ****************
                $ingLength = sizeof($ingredients);
                for($x = 0; $x < $ingLength; $x++) {
                    $ingredientName = $ingredients[$x];
                    $ingredientAmount = $amount[$x];
                    $ingredientMeasure = $unit[$x];
                    $addToIngredients = "INSERT INTO ingredients (ingredient_ID, name, amount, unit) VALUES (null,'$ingredientName','$ingredientAmount','$ingredientAmount')";
                    $statement = $conn->prepare($addToIngredients);
                    $statement->execute();
                    $ingredient = $statement->fetchAll();
                    $statement->closeCursor();
                    $ingredient_ID = $conn->lastInsertId();
                    //   **************** ADD TO RECIPEINGREDIENTS TABLE ****************
                    $addToRecipeIngredients = "INSERT INTO recipeingredient (recipe_ID, ingredient_ID) VALUES ('$recipe_ID','$ingredient_ID')";
                    $statement = $conn->prepare($addToRecipeIngredients);
                    $statement->execute();
                    $recipeIngredient = $statement->fetchAll();
                    $statement->closeCursor();
                }
//   **************** ADD TO STEPS TABLE ****************
                $methodLength = sizeof($method);
                $input = "";
                $count = 1;
                for($x = 0; $x < $methodLength; $x++) {
                        $input .= $count . ". " . $method[$x] . " ";
                        $count++;
                }
                    $addToSteps = "INSERT INTO steps(steps_ID, description) VALUES (null,'$input')";
                    $statement = $conn->prepare($addToSteps);
                    $statement->execute();
                    $steps = $statement->fetchAll();
                    $statement->closeCursor();
                    $step_ID = $conn->lastInsertId();
//   **************** ADD TO RECIPESTEPS TABLE ****************
                $addToRecipeSteps = "INSERT INTO recipesteps(recipe_ID, steps_ID) VALUES ('$recipe_ID', '$step_ID')";
                $statement = $conn->prepare($addToRecipeSteps);
                $statement->execute();
                $recipeStep = $statement->fetchAll();
                $statement->closeCursor();
            }// end check for recipe
            $statement->closeCursor();

        //   **************** CHECK IF EXISTS IN FAVOURITES ****************
        $query = "SELECT * FROM favourites WHERE recipe_ID = $recipe_ID";
        $statement = $conn->prepare($query);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if(!$row) {
            //   **************** ADD TO FAVOURITES TABLE ****************
            $query = "INSERT INTO favourites(recipe_ID, user_ID) VALUES ($recipe_ID, $user)";
            $statement2 = $conn->prepare($query);
            if($statement2->execute()) {
                echo "<script language = javascript>
                        swal({  title: 'Added to favourites!',  
                        type: 'success',    
                        showCancelButton: false,   
                        closeOnConfirm: false,   
                        confirmButtonText: 'Aceptar', 
                        showLoaderOnConfirm: true, }).then(function() {
                            window.location = 'favourites.php';
                        });;
                    </script>";
            }
            $addToFavs = $statement2->fetchAll();
            $statement2->closeCursor();
        } // end check favs
        else {
            echo "<script language = javascript>
            swal({  title: 'You have already favourited this!',  
            type: 'success',    
            showCancelButton: false,   
            closeOnConfirm: false,   
            confirmButtonText: 'Aceptar', 
            showLoaderOnConfirm: true, }).then(function() {
                window.location = 'recipe-api.php';
            });;
        </script>";
        }
        $statement->closeCursor();
    }
}
?>