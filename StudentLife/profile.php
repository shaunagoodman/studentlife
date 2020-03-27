<?php
// Initialize the session
session_start();
include_once 'includes/database/connection.php';
// Check if the user is logged in, if not then redirect him to login page
if (isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true) {
    try {
        $userID = $_SESSION['user_ID'];
        $sql = "SELECT * FROM recipes WHERE isAPI = 0";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $recipes = $statement->fetchAll();
    } catch (Exception $ex) {
        $errorMessage = $e->getMessage();
        echo $errorMessage;
        exit();
    }
} else {
    header("location: login.php");
    exit;
}

try {
    $userID = $_SESSION['user_ID'];
    $query = "SELECT * FROM recipes WHERE user_ID = $userID";
    $statement2 = $conn->prepare($query);
    $statement2->bindValue(":userID", $userID);
    $statement2->execute();
    $recipes = $statement2->fetchAll();
    $statement2->closeCursor();
} catch (Exception $ex) {
    $errorMessage = $e->getMessage();
    echo $errorMessage;
    exit();
}

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
    <title>Profile</title>

    <?php include_once 'includes/CDNs.php'; ?>
    <script src="javascript/scripts.js"></script>
    <link href="includes/stylesheet.css" rel="stylesheet" type="text/css" />
</head>

<body class='site'>

    <?php include_once 'includes/nav-menu.php'; ?>
    <main class='site-content'>
        <div class="profile-body desktop-profile">

            <div class="container desktop-profile">

                <div class="row">

                    <div class="col-lg-12">

                    </div>


                    <div class="col-lg-6 user-col ">

                        <div class="user-info profile-user-info">

                            <h2 class="user-name"><span class="underline"><?php echo $_SESSION["fname"] . " " . $_SESSION["lname"]; ?></span></h2>


                            <h5 class="h5-profile">Email:</h5>

                            <p><?php echo htmlspecialchars($_SESSION["u_email"]); ?></p>
                            <form method="post">
                                <a href="edit_details.php" class="btn btn-light btn-sm">Edit Profile</a>
                                <a href="reset_password.php" class="btn btn-light btn-sm">Reset Password</a>
                                <input type="submit" class="btn btn-light btn-sm" name="submitbutton" value="Deactivate Account" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userID = $_SESSION['user_ID'];
            $submitbutton = $_POST['submitbutton'];
            if ($submitbutton) {
                $query = "UPDATE user SET isActive = 0 WHERE user_ID = $userID";
                $statement = $conn->prepare($query);
                if ($statement->execute()) {
                    echo "<script language = javascript>
               deactivated();
              </script>";
                }
                $recipeIngredient = $statement->fetchAll();
                $statement->closeCursor();
            }
        }
        ?>







        <div class="container-fluid desktop-profile" <?php if (empty($recipes)) echo ' style="display:none;"'; ?>>
        <br>
            <div class="container">
                <h1><span class="underline">Your Recipes and Favourites</span></h1>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-12">
                    <div id="inam" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">



                            <?php
                            $count = 1;



                            //get the results from the $recipes variable(using a loop)

                            echo "<div class='carousel-item active'>";
                            echo "<div class='container'>";
                            echo "<div class='row' >";

                            foreach ($recipes as $recipe) :
                                if ($count % 3 == 1 && $count != 1) {
                                    echo "<div class='carousel-item'>";
                                    echo "<div class='container'>";
                                    echo "<div class='row' >";
                                }
                                if ($recipe['difficultyID'] == 1) {

                                    $difficulty = "Easy";
                                } else if ($recipe['difficultyID'] == 2) {

                                    $difficulty = "Medium";
                                } else if ($recipe['difficultyID'] == 3) {

                                    $difficulty = "Hard";
                                } else {

                                    $difficulty = "No difficulty selected.";
                                }
                                if (empty($recipe['image'])) {

                                    $recipe['image'] = "images/recipes/placeholder.png";
                                }
                                if ($recipe['isAPI'] == 1) {

                                    $src = $recipe['image'];
                                } else {

                                    $src = 'images/recipes/' . $recipe['image'];
                                }
                            ?>

                                <!-- DISPLAY SECTION ONE -->

                                <div class="col-sm-12 col-lg-4">
                                    <div class="card home-card recipe-page-card">
                                        <img src="<?php echo $src; ?>" class="card-img-top" alt='dish image' height='315' width='328'>
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $recipe['name']; ?></h5>
                                            <p class="card-text" class='recipe-difficulty'> Difficulty: <?php echo $difficulty; ?> </p>
                                            <p class="card-text" class='recipe-time'> <img src='images/recipeasy-icons-logos/clock.png' style='margin-bottom:0.3%' alt='clock icon' height='25' width='25'> Time: <?php echo $recipe['maxTime']; ?>
                                            </p>
                                            <center><a href="recipe_single.php?recipe_ID=<?php echo $recipe['recipe_ID'] ?>"><button type="button" class="btn btn-light">View Recipe</button></a> </center>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                // end the divs after every 3rd recipe
                                if ($count % 3 == 0) {

                                    echo "</div>";
                                    echo "</div>";
                                    echo "</div>";
                                }

                                $count++;

                            endforeach;

                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            ?>

                        </div>
                        <a href="#inam" class="carousel-control-prev" data-slide="prev" <?php if (empty($count > 3)) echo ' style="display:none;"'; ?>>
                            <span class="carousel-control-prev-icon"></span>
                        </a>

                        <a href="#inam" class="carousel-control-next" data-slide="next" <?php if (empty($count > 3)) echo ' style="display:none;"'; ?>>
                            <span class="carousel-control-next-icon"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- **********************TABBED RECIPES AND FAVOURITES******************************** -->

        <div class="container div-button desktop-profile">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class=" tab-link nav-link active" style="color:black;" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">All My Recipes</a>
                </li>
                <li class="nav-item">
                    <a class="tab-link nav-link" style="color:black;" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">All My Favourites</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">

                <!-- **********************RECIPE TAB******************************** -->
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                    <div id="myRecipes" class="container">

                        <br>

                        <h5>Can't get enough of creating new recipes? Why not create more of your own unique recipes <a class='add-my-recipe' href = "add-recipe.php"> here </a>?</h5>
                        <br>
                        <?php
                        echo "<div class='row' >";
                        foreach ($recipes as $recipe) :
                            if ($recipe['difficultyID'] == 1) {
                                $difficulty = "Easy";
                            } else if ($recipe['difficultyID'] == 2) {
                                $difficulty = "Medium";
                            } else if ($recipe['difficultyID'] == 3) {
                                $difficulty = "Hard";
                            } else {
                                $difficulty = "No difficulty selected.";
                            }
                            if (empty($recipe['image'])) {
                                $recipe['image'] = "images/recipes/placeholder.png";
                            }
                            if ($recipe['isAPI'] == 1) {
                                $src = $recipe['image'];
                            } else {
                                $src = 'images/recipes/' . $recipe['image'];
                            }
                        ?>

                            <div class="col-lg-4 bottom-home ">
                                <div class="card home-card recipe-page-card">
                                    <img src="<?php echo $src; ?>" class="card-img-top" alt='dish image' height='315' width='328'>
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $recipe['name'];  ?></h5>
                                        <p class="card-text" class='recipe-difficulty'> Difficulty: <?php echo $difficulty; ?> </p>
                                        <p class="card-text" class='recipe-time'> <img src='images/recipeasy-icons-logos/clock.png' style='margin-bottom:0.3%' alt='clock icon' height='25' width='25'> Time: <?php echo $recipe['maxTime']; ?>
                                        </p>
                                        <center><a href="recipe_single.php?recipe_ID=<?php echo $recipe['recipe_ID'] ?>"><button type="button" class="btn btn-light">View Recipe</button></a> </center>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach;
                        echo "</div>" ?>
                    </div>


                </div>

                <!-- **********************FAVOURITES TAB******************************** -->
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">


                    <div id="myFaves" class="container">


                        <?php

                        try {
                            $userID = $_SESSION['user_ID'];
                            $sql = "SELECT * FROM `recipes` r INNER JOIN favourites f ON f.recipe_ID = r.recipe_ID WHERE f.user_ID = $userID";
                            $statement = $conn->prepare($sql);
                            $statement->execute();
                            $recipes = $statement->fetchAll();
                        } catch (Exception $ex) {
                            $errorMessage = $e->getMessage();
                            echo $errorMessage;
                            exit();
                        }
                        ?>






                        <br>

                        <?php
                        echo "<div class='row' >";
                        //get the results from the $products variable(using a loop)
                        if ($recipes != null) {
                            foreach ($recipes as $recipe) :
                                if ($recipe['difficultyID'] == 1) {
                                    $difficulty = "Easy";
                                } else if ($recipe['difficultyID'] == 2) {
                                    $difficulty = "Medium";
                                } else if ($recipe['difficultyID'] == 3) {
                                    $difficulty = "Hard";
                                } else {
                                    $difficulty = "No difficulty selected.";
                                }
                                if (empty($recipe['image'])) {
                                    $recipe['image'] = "images/recipes/placeholder.png";
                                }
                                if ($recipe['isAPI'] == 1) {
                                    $src = $recipe['image'];
                                } else {
                                    $src = 'images/recipes/' . $recipe['image'];
                                }
                        ?>

                                <div class="col-lg-4 bottom-home ">
                                    <div class="card home-card recipe-page-card">
                                        <img src="<?php echo $src; ?>" class="card-img-top" alt='dish image' height='315' width='328'>
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $recipe['name'];  ?></h5>
                                            <p class="card-text" class='recipe-difficulty'> Difficulty: <?php echo $difficulty; ?> </p>
                                            <p class="card-text" class='recipe-time'> <img src='images/recipeasy-icons-logos/clock.png' style='margin-bottom:0.3%' alt='clock icon' height='25' width='25'> Time: <?php echo $recipe['maxTime']; ?>
                                            </p>
                                            <center><a href="recipe_single.php?recipe_ID=<?php echo $recipe['recipe_ID'] ?>"><button type="button" class="btn btn-light">View Recipe</button></a> </center>
                                        </div>
                                    </div>
                                </div>

                        <?php endforeach;
                        } else {
                            echo "<h5>You have not added any recipes yet.</h5>";
                        }

                        echo "</div>" ?>


                    </div>


                </div>

            </div>



        </div>









        <!-- <div class="container div-button desktop-profile">

            <div class="row">

                <div class="col-lg-6 ">
                    
                        <h3>View All Your Favourites<a href="favourites.php" class="recipes"> Here</a> </h3>
                    
                </div>


                <div class="col-lg-6">
                    
                        <h3>View All Your Own Recipes<a href="show-all-recipes.php" class="recipes"> Here</a></h3>
                    
                </div>

            </div>
        </div> -->


        <!-- <div class="container div-button desktop-profile">

            <div class="row">

                <div class="col-lg-6 ">
                    <div class="user-info profile-buttons favourites-button">
                        <h2><a href="favourites.php" class="recipes my-favourites">Favourites</a></h2>
                    </div>
                </div>


                <div class="col-lg-6">
                    <div class="user-info profile-buttons recipe-button">
                        <h2><a href="show-all-recipes.php" class="recipes">Recipes</a></h2>
                    </div>
                </div>

            </div>
        </div> -->



















        </div>


        <!--        -------------------    MOBILE VERSION ------------------------ -->
        <div class="profile-body mobile-profile">

            <div class="container mobile-profile">

                <div class="row">

                    <div class="col-md-12 ">

                        <div class="user-info profile-user-info">

                            <h2 class="user-name"><?php echo $_SESSION["fname"] . " " . $_SESSION["lname"]; ?></h2>
                            <hr>
                            <center class="mobile-profile-info">

                                <h5 class="h5-profile">Email:</h5>
                                <p><?php echo htmlspecialchars($_SESSION["u_email"]); ?></p>

                                <a href="edit_details.php" class="btn btn-light btn-sm">Edit Profile</a>

                                <a href="reset_password.php" class="btn btn-light btn-sm">Reset Password</a>

                            </center>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="container mobile-profile">

            <div class="row">

                <div class="col-md-12">

                    <div class="user-info profile-buttons favourites-button">
                        <h2><a href="favourites.php" class="recipes my-favourites">Favourites</a></h2>
                    </div>


                    <br>

                    <div class="user-info profile-buttons recipe-button">
                        <h2><a href="show-all-recipes.php" class="recipes">Recipes</a></h2>
                    </div>

                </div>


            </div>


        </div>




        <br>








        </div>

    </main>



    <?php include_once 'includes/footer.php'; ?>






</body>

</html>