<?php
session_start();
include_once 'includes/database/connection.php'; ?>

<?php
// Initialize the session



$recipe_ID = filter_input(INPUT_GET, "recipe_ID");
if ($recipe_ID == NULL) {
    header("location:recipes-list.php");
}
// Get recipes
$query = 'SELECT * FROM recipes WHERE recipe_ID=:recipe_ID';
$statement2 = $conn->prepare($query);
$statement2->bindValue(":recipe_ID", $recipe_ID);
$statement2->execute();
$recipes = $statement2->fetchAll();
$statement2->closeCursor();
?>


<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>
    <meta charset="UTF-8">
    <title>Home</title>

    <?php include_once 'includes/CDNs.php'; ?>


</head>

<body>
    <?php include_once 'includes/nav-menu.php'; ?>



    <div class='container'>


        <?php foreach ($recipes as $recipe) :
            if ($recipe['difficultyID'] == 1) {
                $difficulty = "Easy";
            } else if ($recipe['difficultyID'] == 2) {
                $difficulty = "Medium";
            } else if ($recipe['difficultyID'] == 3) {
                $difficulty = "Hard";
            } else {
                $difficulty = "No difficulty selected.";
            }
            $querysteps = 'SELECT * FROM recipesteps WHERE recipe_ID=:recipe_ID';
            $statement3 = $conn->prepare($querysteps);
            $statement3->bindValue(':recipe_ID', $recipe["recipe_ID"]);
            $statement3->execute();
            $steps = $statement3->fetchAll();
            $statement3->closeCursor();
        ?>



            <h2 class="heading"><?php echo $recipe['name'] ?> </h2>

            <div class=row>
                <div class='col-md-4'>
                    <img src='images/recipes/<?php echo $recipe['image'];  ?>' alt='dish image' height='250' width='270'>
                </div>

                <div class='col-md-8'>
                    <iframe width="600" height="338" src="https://www.youtube.com/embed/<?php echo $recipe["video_name"] ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                    </video>
                </div>

            </div>







            <p><strong>Difficulty: </strong><?php echo $difficulty ?></p>
            <p><strong>Servings:</strong> <?php echo $recipe['servings'] ?></p>

            <p><strong>Cooking Time: </strong><?php echo $recipe['maxTime'] ?></p>

            <p> <strong>Ingredients: </strong></p>

            <?php foreach ($recipes as $recipe) :
                $queryrecipeings = 'SELECT * FROM recipeingredient WHERE recipe_ID=:recipe_ID';
                $statement4 = $conn->prepare($queryrecipeings);
                $statement4->bindValue(':recipe_ID', $recipe["recipe_ID"]);
                $statement4->execute();
                $recipeings = $statement4->fetchAll();
                $statement4->closeCursor();
            ?>

                <?php foreach ($recipeings as $recipeing) :
                    $querydesc = 'SELECT * FROM ingredients WHERE ingredient_ID=:ingredient_ID';
                    $statement6 = $conn->prepare($querydesc);
                    $statement6->bindValue(':ingredient_ID', $recipeing["ingredient_ID"]);
                    $statement6->execute();
                    $ingredients = $statement6->fetchAll();
                    $statement6->closeCursor();
                ?>


                    <?php foreach ($ingredients as $ingredient) : ?>
                        <p><?php echo $ingredient['name'] ?> <?php echo $ingredient['amount'] ?> <?php echo $ingredient['unit'] ?></p><?php endforeach; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>

            <?php foreach ($steps as $step) :

                $querydesc = 'SELECT * FROM steps WHERE steps_ID=:steps_ID';
                $statement5 = $conn->prepare($querydesc);
                $statement5->bindValue(':steps_ID', $step["steps_ID"]);
                $statement5->execute();
                $descriptions = $statement5->fetchAll();
                $statement5->closeCursor();
            ?>
                <?php foreach ($descriptions as $description) : ?>

                    <p><strong>Method: </strong><?php echo $description['description'] ?></p><?php endforeach; ?><?php endforeach; ?>
    </div>


    </div>
    </div>

<?php endforeach; ?>






<?php include_once 'includes/footer.php'; ?>


</div>



</body>

</html>