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
    <title>A Recipe</title>

    <?php include_once 'includes/CDNs.php'; ?>


</head>

<body class='site' >
    <?php include_once 'includes/nav-menu.php'; ?>


    <main class='site-content' >
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
            if($recipe['isAPI'] == 1) {
                $src = $recipe['image'];
            }
            else {
                $src = 'images/recipes/'.$recipe['image'];
            }
            $querysteps = 'SELECT * FROM recipesteps WHERE recipe_ID=:recipe_ID';
            $statement3 = $conn->prepare($querysteps);
            $statement3->bindValue(':recipe_ID', $recipe["recipe_ID"]);
            $statement3->execute();
            $steps = $statement3->fetchAll();
            $statement3->closeCursor();
        ?>



            <h2 class="heading allRecipes-h1"><span class="underline"><?php echo $recipe['name'] ?></span> </h2>
            

            <div class=row>
                <div class='col-md-5 single-recipe-topRow'>
                    <img class='single-recipe-pic' src='<?php echo $src;  ?>' alt='dish image'>
                </div>

                <div class='col-md-7 single-recipe-topRow'>
                    <p><img src='images/recipeasy-icons-logos/gauge.png' style='margin-right:1.5%' alt='clock icon' height='35' width='35'><strong>Difficulty: </strong><?php echo $difficulty ?>
                        <img src='images/recipeasy-icons-logos/knife-fork.png' style='margin-right:1.5%' alt='clock icon' height='35' width='35'><strong>Servings:</strong> <?php echo $recipe['servings'] ?>
                        <img src='images/recipeasy-icons-logos/clock.png' style='margin-right:1.5%' alt='clock icon' height='30' width='30'><strong>Cooking Time: </strong><?php echo $recipe['maxTime'] ?> minutes</p>

                    <h5> <strong>Ingredients: </strong></h5>
                    <hr align="left" class="single-recipe-line-ingredients">
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
                            <h5><strong>Method: </strong></h5>
                            <hr align="left" class="single-recipe-line">
                            <p><?php echo $description['description'] ?></p>
                            <?php endforeach; ?><?php endforeach; ?>
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
                                

                <div class='col-lg-7'>
                    <h3>Video Tutorial</h3>
                    <center>
                        <iframe width="600" height="338" src="https://www.youtube.com/embed/<?php echo $recipe["video_name"] ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                        </video>

                    </center>
                </div>

            </div>








    </div>

    </main>
    </div>
    </div>

<?php endforeach; ?>






<?php include_once 'includes/footer.php'; ?>


</div>



</body>

</html>