<?php
session_start();
include_once 'includes/database/connection.php';
include_once 'includes/CDNs.php';
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
    $name = $_SESSION['fname'];
}
$recipe_ID = filter_input(INPUT_GET, "recipe_ID");
if ($recipe_ID == NULL) {
    header("location:recipes-list.php");
}
if(isset($_POST['btnFav'])) {
    include_once 'includes/database/APItoDatabase.php';
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
    <title>Recipe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/recipeasy-icons-logos/small-logo.png">
    <?php include_once 'includes/CDNs.php'; ?>
</head>

<body class='site'>
    <?php include_once 'includes/nav-menu.php'; ?>
    <main class='site-content'>
        <div class='container'>

                <h2 class="heading allRecipes-h1"><span class="underline"><?php echo $title; ?></span> </h2>

                <div class=row>
                    <div class='col-md-7 single-recipe-topRow'>
                        <img class='single-recipe-pic' src='<?php echo $image;  ?>' alt='dish image'>
                        <form class="faveForm" action="" method="POST">
                            <button id="myFave" class="myLink btn" type="submit" name="btnFav" alt="favourite me!"> </button>
                        </form>
                    </div>

                    <div class='col-md-5 single-recipe-topRow '>
                        <br><br>
                        <h4> <br> <img src='images/recipeasy-icons-logos/knife-fork.png' style='margin-right:1.5%' alt='clock icon' height='35' width='35'><strong>Servings:</strong> <?php echo $servings ?> </h4>
                        <h4> <br> <img src='images/recipeasy-icons-logos/clock.png' style='margin-right:1.5%' alt='clock icon' height='30' width='30'><strong>Cooking Time: </strong><?php echo $maxTime ?> minutes </h4>

                    </div>

                    <div class="col-lg-4 col-md-5 col-12 single-ingredients">


                        <!-- DESKTOP -->
                        <div class='ingredientsDeskTitle'>
                            <h5> <strong>Ingredients: </strong></h5>
                        </div>
                        <!-- MOBILE -->
                        <div class='ingredientsTitle'>
                            <h5> <i class="fa2 fa fa-chevron-right" aria-hidden="true"></i>
                                <span class='ingredientsSpan'><strong>Ingredients: </strong> </span>
                            </h5>
                        </div>



                        <!-- <h5> <strong>Ingredients: </strong></h5> -->

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

                    </div>
                    <div class="col-lg-8 col-md-7 col-12">



                            <!-- <h5><strong>Method: </strong></h5> -->
                            <!-- DESKTOP -->
                            <div class='methodDeskTitle'>
                                <h5> <strong>Method: </strong></h5>
                            </div>
                            <!-- MOBILE -->
                            <div class='methodTitle'>
                                <h5><i class="fa3 fa fa-chevron-right" aria-hidden="true"></i>
                                    <span class='methodSpan'><strong>Method: </strong> </span>
                                </h5>
                            </div>

                            <div class="methodDiv">



                            <?php
                                                if ($method != null) {
                                                    $count = 1;
                                                    foreach ($method as $step) {
                                                        echo $count . ". " . $step . "</br>";
                                                        $count++;
                                                    }
                                                } else {
                                                    echo "No method available.";
                                                }
                                                ?>
                            </div>
                    </div>
                </div>
                <br><br>


                <?php
                if (isset($_POST['btnSubmit'])) {
                    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true) {
                        echo "<script language = javascript>
                                commentFail();
                                        </script>";
                    } else {
                        $comment = $_POST['comment'];
                        $date = date('Y-m-d H:i:s');
                        $sql = "INSERT INTO comments(comment_ID, comment, senderName, date, recipe_ID) VALUES (null,'$comment','$name','$date',$recipe_ID)";
                        $statement = $conn->prepare($sql);
                        if ($statement->execute()) {
                            echo "<script language = javascript>
                            swal({  title: 'Comment Posted',
                                type: 'sucess',    
                                showCancelButton: false,   
                                closeOnConfirm: false,   
                                confirmButtonText: 'Aceptar', 
                                showLoaderOnConfirm: true, }).then(function() {
                                    window.location = 'recipe_single.php?recipe_ID=' + $recipe_ID;
                                });
                               </script>";
                        }
                        $addedComments = $statement->fetchAll();
                        $statement->closeCursor();
                    }
                }
                ?>


                <!--CORRECT VERSION --->
                <div class="row">
                    <div class='col-lg-5 comment-div' <?php if (empty($recipe["video_name"])) echo ' style="margin-left: 30%"'; ?>>
                        <h3>Comments</h3>
                        <div>
                            <?php
                            if (!empty($comments)) {
                                foreach ($comments as $comment) :
                                    $date = $comment['date'];
                                    $newDate = date("d.m.Y H:i:s", strtotime($date));
                            ?>
                                    <h5 style="color: #EF7823;"> <?php echo $comment['senderName']; ?></h5>
                                    <p style="font-size: 85%; color: #727272; margin-top: -2%;"> <?php echo $newDate ?> </p>
                                    <p class="comment"> <?php echo $comment['comment']; ?> </p>
                                    <hr>

                                <?php
                                endforeach;
                            } else { ?>
                            <?php } ?>
                        </div>
                        <br>

                        <form method="post">
                            <div class="form-group">
                                <!-- <label>Comment Here</label><br>

                                    <h2> Comment </h2>
                                    <textarea class="form-control fake-textBox" id="comment" name="comment" rows="3" placeholder=""></textarea> -->

                            </div>
                            <br>

                            <form method="post">
                                <div class="form-group">
                                    <label>Comment Here</label><br>
                                    <textarea class="form-control fake-textBox" id="comment" name="comment" rows="3" placeholder=""></textarea>
                                </div>
                                <input class='btn btn-light btn-sm' type="submit" name="btnSubmit" value="Post Comment" />
                            </form>
                            <br>

                    </div>


                    <div class='col-lg-7 video-container' <?php if (empty($recipe["video_name"])) echo ' style="display:none;"'; ?>>
                        <h3>Video Tutorial</h3>

                        <iframe width="600" height="338" src="https://www.youtube.com/embed/<?php echo $recipe["video_name"] ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                        </video>


                    </div>
                </div>

        </div>
    </main>

<?php include_once 'includes/footer.php'; ?>


</div>



</body>

</html>