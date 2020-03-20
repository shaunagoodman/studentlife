<?php
session_start();
include_once 'includes/database/connection.php'; ?>
<?php
$recipe_ID = filter_input(INPUT_GET, "recipe_ID");
if ($recipe_ID == NULL) {
    header("location:recipes-list.php");
}
$url = "https://api.spoonacular.com/recipes/".$recipe_ID."/information?apiKey=53bea2eb3c79445188bc4d3f00895d15";
$response = json_decode(file_get_contents($url),true);
    $title =  $response["title"];
    $servings =  $response["servings"];
    $image = $response["image"];
    $maxTime = $response['readyInMinutes'];
        $ingredients = [];
        $unit = [];
        $amount = [];
        $method = [];
        $cuisines = [];

        foreach ($response['cuisines'] as $cuisine){
          array_push($cuisines, $cuisine);
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
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <?php include_once 'includes/CDNs.php'; ?>
</head>
<body class='site' >
    <?php include_once 'includes/nav-menu.php'; ?>
    <main class='site-content' >
        <div class='container'>            
            <h2 class="heading allRecipes-h1"><?php echo $title ?> </h2>
            <hr align="left">
            <div class=row>
                <div class='col-md-5 single-recipe-topRow'>
                    <img class='single-recipe-pic' src='<?php echo $image;  ?>' alt='dish image'>
                </div>
                <div class='col-md-7 single-recipe-topRow'>
                    <p> 
                        <img src='images/recipeasy-icons-logos/knife-fork.png' style='margin-right:1.5%' alt='clock icon' height='35' width='35'><strong>Servings:</strong> <?php echo $servings ?>
                        <img src='images/recipeasy-icons-logos/clock.png' style='margin-right:1.5%' alt='clock icon' height='30' width='30'><strong>Cooking Time: </strong><?php echo $maxTime ?> minutes
                    </p>
                    <h5><strong>Cuisine: </strong></h5>
                    <hr align="left" class="single-recipe-line">
                    <?php
                        if ($cuisines != null) {
                            foreach($cuisines as $cuisine) {
                                    echo $cuisine;
                                }
                        }
                        else {
                            echo "No cuisine available.";
                        }
                    ?>

                    <h5> <strong>Ingredients: </strong></h5>
                    <hr align="left" class="single-recipe-line-ingredients">
                    <?php
                        if ($ingredients != null) {
                            $ingLength = sizeof($ingredients);
                            for($x = 0; $x < $ingLength; $x++) {
                                $ingredientName = $ingredients[$x];
                                $ingredientAmount = $amount[$x];
                                $ingredientMeasure = $unit[$x];
                                echo $ingredientName . " " . $ingredientAmount . " " . $ingredientMeasure . "</br>";
                            }
                        } 
                        else {
                            echo "No ingredients available.";
                        }
                    ?>
                    <h5><strong>Method: </strong></h5>
                    <hr align="left" class="single-recipe-line">
                    <?php
                        if ($method != null) {
                            $count = 1;
                            foreach($method as $step) {
                                    echo $count . ". " .$step . "</br>";
                                    $count++;
                                }
                        }
                        else {
                            echo "No method available.";
                        }
                    ?>
                </div>
                <div class='col-lg-5'>
                    <h3>Comments</h3>

                    <div class='fake-comment'>
                        <h5>Really Cool!</h5>
                        <p>
                            Minim sit qui ut dolore reprehenderit velit ipsum.
                            Aute in nulla commodo velit. Voluptate duis minim nisi est enim.
                            Laborum non ipsum laboris ea veniam ut exercitation ea voluptate
                            adipisicing sint ut. Nisi duis reprehenderit irure labore non id cillum.
                        </p>
                    </div>
                    <br>
                    <div class='fake-comment'>
                        <h5> Could Use salt</h5>
                        <p>
                            Voluptate duis minim nisi est enim.
                            Laborum non ipsum laboris ea veniam ut exercitation ea voluptate
                        </p>
                    </div>

                    <form>
                        <div class="form-group">
                            <label>Comment Here</label>
                            <textarea class="form-control fake-textBox" name="message" rows="3" placeholder=""></textarea>
                        </div>
                        <button class='btn btn-light btn-sm' >Send</button>
                    </form>
                    <br>
                </div>
            </div>
            
        </div>
    </main>
    <?php include_once 'includes/footer.php'; ?>
</body>
</html>