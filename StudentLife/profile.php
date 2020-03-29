<?php
// Initialize the session
session_start();
include_once 'includes/database/connection.php';
// Check if the user is logged in, if not then redirect him to login page
if (isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true) {
    try {
        $userID = $_SESSION['user_ID'];
        $query = "SELECT * FROM recipes WHERE user_ID = $userID AND isAPI = 0 ORDER BY 'date-created'";
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
} else {
    header("location: login.php");
    exit;
}
if (isset($_POST['removeFav'])) {
    include_once 'includes/database/removeFromFavs.php';
}
?>
<!DOCTYPE html>
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
                            <br>
                            <h5 class="h5-profile">Options:</h5>
                            <form action = "" method = "post">
                            <a href="edit_details.php" class="btn sortBy ">
                                <p style="margin-bottom: 0;">Edit Profile</p>
                            </a>

                            <a href="reset_password.php" class="btn sortBy ">
                                <p style="margin-bottom: 0;">Reset Password</p>
                            </a>
                
                            <input type="submit" class="btn sortBy " name="deactivateAccount" value="Deactivate Account" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>
        <?php
        ?>


        <div class="profile-body mobile-profile">

            <div class="container mobile-profile">

                <div class="row">

                    <div class="col-md-12 ">

                        <div class="user-info profile-user-info">

                            <h2 class="user-name"><span class="underline"><?php echo $_SESSION["fname"] . " " . $_SESSION["lname"]; ?></span></h2>

                            <center class="mobile-profile-info">

                                <h5 class="h5-profile">Email:</h5>
                                <p><?php echo htmlspecialchars($_SESSION["u_email"]); ?></p>

                                <br>
                                <h5 class="h5-profile">Options:</h5>
                                <form action = "" method = "post">
                                <a href="edit_details.php" class="btn sortBy ">
                                    <p style="margin-bottom: 0;">Edit Profile</p>
                                </a>

                                <a href="reset_password.php" class="btn sortBy ">
                                    <p style="margin-bottom: 0;">Reset Password</p>
                                </a>
                                <input type="submit" class="btn sortBy " name="deactivateAccount" value="Deactivate Account" />
                                </form>
                                <?php
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    $userID = $_SESSION['user_ID'];
                                    if (isset($_POST['deactivateAccount'])) {
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
                            </center>
                        </div>
                    </div>

                </div>
            </div>
        </div>



        <?php 
        $query = "SELECT * from recipes WHERE user_ID = $userID UNION SELECT r.* FROM recipes r INNER JOIN favourites f on f.recipe_ID = r.recipe_ID WHERE f.user_ID = $userID ORDER BY 'date_created'";
        $statement = $conn->prepare($query);
        $statement->execute();
        $recipeandfavs = $statement->fetchAll();
        $statement->closeCursor();
        $count = count($recipeandfavs);
        ?>

        <div class="container-fluid " <?php if ($count < 3) echo ' style="display:none;"'; ?>>
            <br>
            <div class="container">
                <h1><span class="underline">Your Recipes and Favourites</span></h1>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-12 desktop-profile">
                    <div id="inam" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">



                            <?php
                            $count = 1;



                            //get the results from the $recipes variable(using a loop)

                            echo "<div class='carousel-item active'>";
                            echo "<div class='container'>";
                            echo "<div class='row' >";

                            foreach ($recipeandfavs as $recipe) :
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

                                if($recipe['isAPI'] == 1) {
                                    $src = $recipe['image'];
                                }
                                else {
                                    if (empty($recipe['image'])) {
                                       $src = "images/recipes/placeholder.png";
                                    }
                                    $src = "images/recipes/".$recipe['image'];
                                }

                            ?>

                                <!-- DISPLAY SECTION ONE -->

                                <div class="col-sm-12 col-lg-4">
                                    <div class="card home-card recipe-page-card">
                                        <img src="<?php echo $src ?>" class="card-img-top" alt='dish image' height='315' width='328'>
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
                        <a href="#inam" class="carousel-control-prev" data-slide="prev" <?php if ($count < 3) echo ' style="display:none;"'; ?>>
                            <span class="carousel-control-prev-icon"></span>
                        </a>

                        <a href="#inam" class="carousel-control-next" data-slide="next" <?php if ($count < 3) echo ' style="display:none;"'; ?>>
                            <span class="carousel-control-next-icon"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- **********************TABBED RECIPES AND FAVOURITES******************************** -->

        <div class="container div-button ">

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

                        <h5>Can't get enough of creating new recipes? Why not create more of your own unique recipes <a class='add-my-recipe' href="add-recipe.php"> here </a>?</h5>
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
                                $recipe['image'] = "placeholder.png";
                            }
                        ?>

                            <div class="col-lg-4 col-md-6 bottom-home ">
                                <div class="card home-card recipe-page-card">
                                    <img src="images/recipes/<?php echo $recipe['image']; ?>" class="card-img-top" alt='dish image' height='315' width='328'>
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $recipe['name'];  ?></h5>
                                        <p class="card-text" class='recipe-difficulty'> Difficulty: <?php echo $difficulty; ?> </p>
                                        <p class="card-text" class='recipe-time'> <img src='images/recipeasy-icons-logos/clock.png' style='margin-bottom:0.3%' alt='clock icon' height='25' width='25'> Time: <?php echo $recipe['maxTime']; ?>
                                        </p>
                                        <center><a href="recipe_single.php?recipe_ID=<?php echo $recipe['recipe_ID'] ?>"><button type="button" class="btn btn-light">View Recipe</button></a> </center>
                                        <form action="delete-recipe.php" method="post" id="delete_recipe_form">
                                            <a href="delete_recipe.php?recipe_ID=<?php echo $recipe['recipe_ID'] ?>" class="sortBy add-my-recipe">
                                                <p>Delete</p>
                                            </a>
                                        </form>
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
                            $sql = "SELECT * FROM recipes r INNER JOIN favourites f ON f.recipe_ID = r.recipe_ID WHERE f.user_ID = $userID";
                            $statement = $conn->prepare($sql);
                            $statement->execute();
                            $favourites = $statement->fetchAll();
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
                        if ($favourites != null) {
                            foreach ($favourites as $favourite) :
                                if ($favourite['difficultyID'] == 1) {
                                    $difficulty = "Easy";
                                } else if ($favourite['difficultyID'] == 2) {
                                    $difficulty = "Medium";
                                } else if ($favourite['difficultyID'] == 3) {
                                    $difficulty = "Hard";
                                } else {
                                    $difficulty = "No difficulty selected.";
                                }
                                if (empty($favourite['image'])) {
                                    $favourite['image'] = "images/recipes/placeholder.png";
                                }
                                if ($favourite['isAPI'] == 1) {
                                    $src = $favourite['image'];
                                } else {
                                    $src = 'images/recipes/' . $favourite['image'];
                                }
                        ?>

                                <div class="col-lg-4 col-md-6 bottom-home ">
                                    <div class="card home-card recipe-page-card">
                                        <img src="<?php echo $src; ?>" class="card-img-top" alt='dish image' height='315' width='328'>
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $favourite['name'];  ?></h5>
                                            <p class="card-text" class='recipe-difficulty'> Difficulty: <?php echo $difficulty; ?> </p>
                                            <p class="card-text" class='recipe-time'> <img src='images/recipeasy-icons-logos/clock.png' style='margin-bottom:0.3%' alt='clock icon' height='25' width='25'> Time: <?php echo $favourite['maxTime']; ?>
                                            </p>
                                            <center><a href="recipe_single.php?recipe_ID=<?php echo $favourite['recipe_ID'] ?>"><button type="button" class="btn btn-light">View Recipe</button></a> </center>
                                            <form action="delete-recipe.php" method="post" id="delete_recipe_form">
                                            <a href="remove_from_fav.php?recipe_ID=<?php echo $favourite['recipe_ID'] ?>" class="sortBy add-my-recipe">
                                                <p>Remove</p>
                                            </a>
                                        </form>
                                        </div>
                                    </div>
                                </div>

                        <?php endforeach;
                        } else {
                            echo "<h5>You have not fvourited any recipes yet.</h5>";
                        }

                        echo "</div>" ?>


                    </div>


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