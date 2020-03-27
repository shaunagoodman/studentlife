<?php
session_start();
include_once 'includes/database/connection.php'; ?>
<?php
$recipe_ID = filter_input(INPUT_GET, "recipe_ID");
if ($recipe_ID == NULL) {
    header("location:recipes-list.php");
}
$url = "https://api.spoonacular.com/recipes/" . $recipe_ID . "/information?apiKey=53bea2eb3c79445188bc4d3f00895d15";
$response = json_decode(file_get_contents($url), true);
$title =  $response["title"];
$servings =  $response["servings"];
$image = $response["image"];
$maxTime = $response['readyInMinutes'];
$ingredients = [];
$unit = [];
$amount = [];
$method = [];
$cuisines = [];

foreach ($response['cuisines'] as $cuisine) {
    array_push($cuisines, $cuisine);
}
foreach ($response['extendedIngredients'] as $ingredient) {
    // check if ingredient is in array
    if (!in_array($ingredient['name'], $ingredients)) {
        $ingredients[] = $ingredient['name'];
        $measure = $ingredient['measures'];
        $unit[] = $measure['metric']['unitShort'];
        $amount[] = $measure['metric']['amount'];
    }
}
foreach ($response['analyzedInstructions'] as $instruction) {
    foreach ($instruction['steps'] as $step) {
        array_push($method, $step['step']);
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>A Recipe</title>
    <?php include_once 'includes/CDNs.php'; ?>
</head>

<body class='site'>
    <?php include_once 'includes/nav-menu.php'; ?>
    <main class='site-content'>
        <div class='container'>
            <h2 class="heading allRecipes-h1"><span class="underline"><?php echo $title ?> </span></h2>

            <div class=row>
                <div class='col-md-7 single-recipe-topRow'>
                    <img class='single-recipe-pic' src='<?php echo $image;  ?>' alt='dish image'>
                    <form class="faveForm" action="" method="POST">
                        <!-- <input class="btn api-button random-button" type="submit" name="btnFav" value="Favourite" /> -->
                        <button id="myFave" class="myLink btn" type="submit" name="btnFav" alt="favourite me!"> </button>
                    </form>
                </div>
                <div class='col-md-5 single-recipe-topRow'>
                    <p>
                        <img src='images/recipeasy-icons-logos/knife-fork.png' style='margin-right:1.5%' alt='clock icon' height='35' width='35'><strong>Servings:</strong> <?php echo $servings ?>
                        <br><br> <img src='images/recipeasy-icons-logos/clock.png' style='margin-right:1.5%' alt='clock icon' height='30' width='30'><strong>Cooking Time: </strong><?php echo $maxTime ?> minutes
                        <br><br><img src='images/recipeasy-icons-logos/clock.png' style='margin-right:1.5%' alt='clock icon' height='30' width='30'><strong>Cuisine </strong>
                        <?php
                        if ($cuisines != null) {
                            foreach ($cuisines as $cuisine) {
                                echo $cuisine;
                            }
                        } else {
                            echo "No cuisine available.";
                        }
                        ?>
                    </p>






                </div>

                <div class='row ingredientMethod'>

                    <div class='col-lg-4 col-md-5 col-12 '>

                        <!-- DESKTOP -->
                        <div class='ingredientsDeskTitle'>
                            <h5> <strong>Ingredients: </strong></h5>
                        </div>
                        <!-- MOBILE -->
                        <div class='ingredientsTitle'>
                            <h5> <i class=" fa2 fa fa-chevron-right" aria-hidden="true"></i>
                                <span class='ingredientsSpan'><strong>Ingredients: </strong> </span>
                            </h5>
                        </div>

                        <div class='ingredientsDiv'>
                            <?php
                            if ($ingredients != null) {
                                $ingLength = sizeof($ingredients);
                                for ($x = 0; $x < $ingLength; $x++) {
                                    $ingredientName = $ingredients[$x];
                                    $ingredientAmount = $amount[$x];
                                    $ingredientMeasure = $unit[$x];
                                    echo $ingredientName . " " . $ingredientAmount . " " . $ingredientMeasure . "</br>";
                                }
                            } else {
                                echo "No ingredients available.";
                            }
                            ?>
                        </div>
                        <br><br>
                    </div>


                    <div class='col-lg-8 col-md-7 col-12'>

                        <!-- DESKTOP -->
                        <div class='methodDeskTitle'>
                            <h5> <strong>Method: </strong></h5>
                        </div>
                        <!-- MOBILE -->
                        <div class='methodTitle'>
                            <h5> <i class="fa3 fa fa-chevron-right" aria-hidden="true"></i>
                                <span class='methodSpan'><strong>Method: </strong> </span>
                            </h5>
                        </div>


                        <div class='methodDiv'><?php
                                                if ($method != null) {
                                                    $count = 1;
                                                    foreach ($method as $step) {
                                                        echo $count . ". " . $step . "</br>";
                                                        $count++;
                                                    }
                                                } else {
                                                    echo "No method available.";
                                                }
                                                ?></div>

                    </div>

                </div>

            </div>

        </div>
    </main>
    <?php include_once 'includes/footer.php'; ?>
</body>

</html>