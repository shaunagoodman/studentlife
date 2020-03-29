<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
} elseif (!isset($_SESSION["u_type"]) || $_SESSION["u_type"] != 1) {
    header("location: profile.php");
    exit;
}


require_once 'includes/database/connection.php';

try {
    $userID = $_SESSION['user_ID'];
    $query = "SELECT * FROM recipes ORDER BY 'date-created'";
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

$query = "SELECT * FROM blog";
$statement = $conn->prepare($query);
$statement->execute();
$blog = $statement->fetchAll();
$statement->closeCursor();


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
    <title>Admin Profile</title>
    <link rel="icon" href="images/recipeasy-icons-logos/small-logo.png">
    <?php include_once 'includes/CDNs.php'; ?>
    <script src="javascript/scripts.js"></script>
    <script src="javascript/slider.js"></script>
    <script src="javascript/rating.js"></script>
    <style>
        .rating {
            float: left;
        }

        .rating:not(:checked)>input {
            position: absolute;
            top: -9999px;
            clip: rect(0, 0, 0, 0);
        }

        .rating:not(:checked)>label {
            float: right;
            width: 1em;
            padding: 0 .1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 200%;
            line-height: 1.2;
            color: #ddd;
        }

        .rating:not(:checked)>label:before {
            content: '★ ';
        }

        .rating>input:checked~label {
            color: #f70;
        }

        .rating:not(:checked)>label:hover,
        .rating:not(:checked)>label:hover~label {
            color: gold;
        }

        .rating>input:checked+label:hover,
        .rating>input:checked+label:hover~label,
        .rating>input:checked~label:hover,
        .rating>input:checked~label:hover~label,
        .rating>label:hover~input:checked~label {
            color: #ea0;
        }

        .rating>label:active {
            position: relative;
            top: 2px;
            left: 2px;
        }

        .unitHide {
            display: none;
        }
    </style>



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

        <div class="container-fluid desktop-profile">
            <div class="row">
                <div class="col-sm-12">





                </div>
            </div>
        </div>


        <!-- **********************TABBED RECIPES AND FAVOURITES******************************** -->

        <div class="container div-button desktop-profile ">

            <ul class="nav tab-nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="tab-link nav-link tab-item active" style="color:black;" id="addBlog-tab" data-toggle="tab" href="#addBlog" role="tab" aria-controls="addBlog" aria-selected="true">Add Blog Post</a>
                </li>
                <li class="nav-item">
                    <a class=" tab-link nav-link tab-item " style="color:black;" id="addRecipes-tab" data-toggle="tab" href="#addRecipes" role="tab" aria-controls="addRecipes" aria-selected="false">Create a Recipe</a>
                </li>
                <li class="nav-item">
                    <a class=" tab-link nav-link tab-item " style="color:black;" id="showUsers-tab" data-toggle="tab" href="#showUsers" role="tab" aria-controls="showUsers" aria-selected="false">View All Users</a>
                </li>
                <li class="nav-item">
                    <a class=" tab-link nav-link tab-item " style="color:black;" id="showRecipes-tab" data-toggle="tab" href="#showRecipes" role="tab" aria-controls="showRecipes" aria-selected="false">View All Recipes</a>
                </li>
                <li class="nav-item">
                    <a class=" tab-link nav-link tab-item " style="color:black;" id="myRecipes-tab" data-toggle="tab" href="#myRecipes" role="tab" aria-controls="myRecipes" aria-selected="false">All My Recipes</a>
                </li>
                <li class="nav-item">
                    <a class="tab-link nav-link tab-item" style="color:black;" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">All My Favourites</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">

                <!-- **********************ADD BLOG TAB******************************** -->
                <div class="tab-pane fade show active" id="addBlog" role="tabpanel" aria-labelledby="addBlog-tab">

                    <h2 class="allRecipes-h1"><span class="underline">Post New Blog</span></h2>
                    <?php include_once 'includes/database/addBlog.php'; ?>
                    <form class="login-form" enctype="multipart/form-data" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

                        <div class="form-group <?php echo (!empty($title_err)) ? 'has-error' : ''; ?>">
                            <p class='add-blog-title'>Title fo you Blog Post</p>
                            <input class='blog-post-title' type="text" name="blogTitle" class="form-control">
                            <span class="help-block"><?php echo $title_err; ?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($content_err)) ? 'has-error' : ''; ?>">
                            <p class='add-blog-content-title'>Blog Post Content</p>
                            <textarea class='blog-post' type="text" name="blogContent" class="form-control"> </textarea>
                            <span class="help-block"><?php echo $content_err; ?></span>
                        </div>

                        <input type="hidden" name="blogId" value="<?php echo $id; ?>" />
                        <input type="submit" class="btn btn-light btn-sm" name="submit" value="Submit">
                        <a href=".php" class="btn btn-light-invert btn-sm">Cancel</a>
                    </form>

                </div>

                <!-- **********************CREATE A RECIPE TAB******************************** -->
                <div class="tab-pane fade show " id="addRecipes" role="tabpanel" aria-labelledby="addRecipes-tab">


                    <?php include_once 'includes/database/addRecipe.php'; ?>
                    <h2 class='allRecipes-h1'><span class="underline">Create Recipe</span></h2>
                    <form class=" create-recipe-form" enctype="multipart/form-data" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

                        <div class='row'>
                            <div class="form-group col-md-6 <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                                <label>Name</label>
                                <input type="text" name="recipeName" class="form-control">
                                <span class="help-block"><?php echo $name_err; ?></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Video URL</label>
                                <input class="form-control" type="text" name="video_name" />
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class=row>
                            <div class="form-group col-lg-3 col-md-6 <?php echo (!empty($servings_err)) ? 'has-error' : ''; ?>">
                                <label>Servings</label>
                                <input type="text" name="servings" class="form-control" value="<?php echo $servings; ?>">
                                <span class="help-block"><?php echo $servings_err; ?></span>
                            </div>

                            <div class="form-group col-lg-3 col-md-6 <?php echo (!empty($maxTime_err)) ? 'has-error' : ''; ?>">
                                <label>Max Time</label> <br>
                                <input onchange="displayTime()" type="range" min="1" max="60" value="10" id="maxTime" name="maxTime" />
                                <p><span id="timeArea"> <?= isset($_POST['maxTime']) ? $_POST['maxTime'] : '10 minutes' ?>10 minutes</span></p>
                            </div>

                            <div class="form-group col-lg-2 col-md-6 <?php echo (!empty($difficultyID_err)) ? 'has-error' : ''; ?>">
                                <label>Difficulty</label><br>
                                <select id="difficulty" name="difficulty">
                                    <option value="1">Easy </option>
                                    <option value="2">Medium</option>
                                    <option value="3">Hard</option>
                                </select>
                                <span class="help-block"><?php echo $difficultyID_err; ?></span>
                            </div>

                            <div class="form-group col-lg-3 col-md-6 <?php echo (!empty($rating_err)) ? 'has-error' : ''; ?>">
                                <label>Rating</label><br>
                                <fieldset class="rating">
                                    <input type="radio" id="star5" name="rating" value="5" /><label for="star5">5 stars</label>
                                    <input type="radio" id="star4" name="rating" value="4" /><label for="star4"> 4 stars</label>
                                    <input type="radio" id="star3" name="rating" value="3" /><label for="star3">3 stars</label>
                                    <input type="radio" id="star2" name="rating" value="2" /><label for="star2">2 stars</label>
                                    <input type="radio" id="star1" name="rating" value="1" /><label for="star1">1 star</label>
                                </fieldset>

                            </div>

                        </div>
                        <div class='row'>




                            <div class="form-group col-md-4 ">
                                <label>Image</label>
                                <input class="input-group " type="file" name="image" accept="image/*" />

                            </div>

                        </div>

                        <div class='row'>
                            <div id="addedIngredient" class="col-md-6 form-group <?php echo (!empty($ingredient_err)) ? 'has-error' : ''; ?>">
                                <label> Add Ingredients </label><br>
                                <label style="color:black;"> Metric </label>
                                <input type="radio" onclick="displayIng()" value="Metric" name="ingredients" id="metric" />
                                <label style="color:black;"> Imperial </label>
                                <input type="radio" onclick="displayIng()" value="Metric" name="ingredients" id="imperial" />
                                <div id="ingArea">
                                    <div id="metricIng" class="unitHide">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p> Name </p>
                                                <input class="form-control" type="text" name="metric_ingredient_name[]" />
                                            </div>

                                            <div class="col-md-4">
                                                <p> Measure </p>
                                                <input class="form-control" type="text" name="metric_ingredient_measure[]" />
                                            </div>

                                            <div class="col-md-4">
                                                <p> Unit </p>
                                                <select name="metric_ingredient_unit[]" id="units">
                                                    <option value="grams">Gram(s)</option>
                                                    <option value="kg">Kg</option>
                                                    <option value="ml">Ml</option>
                                                    <option value="litre(s)">Litre(s)</option>
                                                    <option value="pinch">Pinch</option>
                                                    <option value="whole">Whole</option>
                                                    <option value="teaspoon(s)">Teaspoon(s)</option>
                                                    <option value="tablespoon(s)">Tablespoon(s)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- <input id = "ingbtn" type = "button" class="btn btn-sm add-recipe-button" value = "Add Ingredient" onclick = "addMetricIngredient()" /> -->
                                        <button id="ingbtn" class="addBut btn " type="button" value="Add Ingredient" onclick="addMetricIngredient()"> </button>
                                    </div>
                                    <div id="imperialIng" class="unitHide">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p> Name </p>
                                                <input class="form-control" type="text" name="imperial_ingredient_name[]" />
                                            </div>

                                            <div class="col-md-4">
                                                <p> Measure </p>
                                                <input class="form-control" type="text" name="imperial_ingredient_measure[]" />
                                            </div>
                                            <div class="col-md-4">
                                                <p> Unit </p>
                                                <select name="imperial_ingredient_unit[]" id="units">
                                                    <option value="ounce">Ounce(s)</option>
                                                    <option value="pound">Pound(s)</option>
                                                    <option value="cup">Cup(s)</option>
                                                    <option value="pinch">Pinch</option>
                                                    <option value="whole">Whole</option>
                                                    <option value="teaspoon(s)">Teaspoon(s)</option>
                                                    <option value="tablespoon(s)">Tablespoon(s)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- <input type = "submit" class="btn btn-sm add-recipe-button" value = "Add Ingredient" onclick = "addImperialIngredient()" /> -->
                                        <button class="addBut btn " type="submit" value="Add Ingredient" onclick="addImperialIngredient()"> </button>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div id="addedStep" class="col-md-6 form-group <?php echo (!empty($step_err)) ? 'has-error' : ''; ?>">
                                <label> Method </label>
                                <button id="addBtn" type="button" class="btn addBut" onClick="addStep()" alt="Add Step"> </button>
                            </div>

                        </div>


                        <input type="hidden" name="recipe_ID" value="<?php echo $id; ?>" />
                        <input type='submit' class="btn btn-light" name='submitRecipe' value="Submit the form" />
                        <a href="show-all-recipes.php" class="btn btn-light">Cancel</a>
                    </form>

                </div>

                <!-- **********************SHOW ALL USERS TAB******************************** -->
                <div class="tab-pane fade show " id="showUsers" role="tabpanel" aria-labelledby="showUsers-tab">


                    <?php
                    $query = "SELECT * FROM user";
                    $statement = $conn->prepare($query);
                    $statement->execute();
                    $user = $statement->fetchAll();
                    $statement->closeCursor();
                    ?>


                    <h2 class="allRecipes-h1"><span class="underline">View All Users</span></h2>

                    <table class="table1">
                        <tr>
                            <th class="th1">User ID</th>
                            <th class="th1">First Name</th>
                            <th class="th1">Last Name </th>
                            <th class="th1">Email</th>
                            <th class="th1">Delete</th>
                        </tr>
                        <?php foreach ($user as $users) : ?>
                            <tr>
                                <td class="td1">
                                    <p><?php echo $users['user_ID']; ?></p>
                                </td>
                                <td class="td1">
                                    <p><?php echo $users['fname']; ?></p>
                                </td>
                                <td class="td1">
                                    <p><?php echo $users['lname']; ?></p>
                                </td>
                                <td class="td1">
                                    <p><?php echo $users['u_email']; ?></p>
                                </td>
                                <td class="td1">

                                    <form action="delete-user.php" method="post" id="delete_user_form">
                                        <a href="delete-user.php?user_ID=<?php echo $users['user_ID'] ?>" class="add-my-recipe">Delete</a>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>


                </div>

                <!-- ********************** VIEW ALL RECIPE TAB******************************** -->
                <div class="tab-pane fade show " id="showRecipes" role="tabpanel" aria-labelledby="showRecipes-tab">


                    <?php
                    $query = "SELECT * FROM recipes";
                    $statement = $conn->prepare($query);
                    $statement->execute();
                    $recipes = $statement->fetchAll();
                    $statement->closeCursor();
                    ?>

                    <h2 class='allRecipes-h1'><span class="underline">View All Recipe</span></h2>

                    <table class="table1">
                        <tr>
                            <th class="th1">Recipe ID</th>
                            <th class="th1">Recipe Name</th>
                            <th class="th1">Servings </th>
                            <th class="th1">Time</th>
                            <th class="th1">Ratings</th>
                            <th class="th1">Difficulty</th>
                            <th class="th1">Image</th>
                            <th class="th1">Video</th>
                            <th class="th1">Delete</th>
                        </tr>
                        <?php foreach ($recipes as $recipe) : ?>
                            <tr>
                                <td class="td1">
                                    <p><?php echo $recipe['recipe_ID']; ?></p>
                                </td>
                                <td class="td1">
                                    <p><?php echo $recipe['name']; ?></p>
                                </td>
                                <td class="td1">
                                    <p><?php echo $recipe['servings']; ?></p>
                                </td>
                                <td class="td1">
                                    <p><?php echo $recipe['maxTime']; ?></p>
                                </td>
                                <td class="td1">
                                    <p><?php echo $recipe['rating']; ?></p>
                                </td>
                                <td class="td1">
                                    <p><?php echo $recipe['difficultyID']; ?></p>
                                </td>
                                <td class="td1">
                                    <p><?php echo $recipe['image']; ?></p>
                                </td>
                                <td class="td1">
                                    <p><?php echo $recipe['video_name']; ?></p>
                                </td>
                                <td class="td1">

                                    <form action="delete-recipe.php" method="post" id="delete_recipe_form">
                                        <a href="delete_recipe.php?recipe_ID=<?php echo $recipe['recipe_ID'] ?>" class="add-my-recipe">Delete</a>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>





                </div>


                <!-- **********************RECIPE TAB******************************** -->
                <div class="tab-pane fade show" id="myRecipes" role="tabpanel" aria-labelledby="myRecipes-tab">

                    <div id="myRecipes" class="container">

                        <br>

                        <h5>Can't get enough of creating new recipes? Why not create more of your own unique recipes <a class='add-my-recipe' href="add-recipe.php"> here </a>?</h5>
                        <br>
                        <?php

                        try {
                            $userID = $_SESSION['user_ID'];
                            $query = "SELECT * FROM recipes ORDER BY 'date_created'";
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
                            $sql = "SELECT * FROM recipes r INNER JOIN favourites f ON f.recipe_ID = r.recipe_ID WHERE f.user_ID = $userID";
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
                                            <a href="remove_from_fav.php?recipe_ID=<?php echo $recipe['recipe_ID'] ?>&user_ID=<?php echo $userID;?>" class="sortBy add-my-recipe">
                                                <p>Remove</p>
                                            </a>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                        <?php endforeach;
                        } else {
                            echo "<p>You have not added any recipes yet.</p>";
                        }

                        echo "</div>" ?>


                    </div>


                </div>

            </div>



        </div>










        <!--        -------------------    MOBILE VERSION ------------------------ -->
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
                            </center>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- <div class="container mobile-profile">

            <div class='sub-menu'>
                <div style='text-align: right'>
                    <ul class='diff-list' id='ul-difficulty-list'>
                        <li class='li-diff-list'> <a href='add_blog.php'>Add New Post </a></li>
                        <li class='li-diff-list'><a href='recipes-list.php'>View All Recipes </a></li>
                        <li class='li-diff-list'><a href='show-all-recipes.php.php'>All My Recipes </a></li>
                        <li class='li-diff-list'><a href='favourites.php'>View All Favourites </a></li>
                        <li class='li-diff-list'><a href='view-all-users.php'>View All Users </a></li>
                    </ul>
                </div>
            </div>

        </div> -->

        <br>


        <div class='container admin-container'>

            <!-- OLD DROP DOWN GOES HERE -->



            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Add New Blog Post
                            </button>
                        </h5>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">

                            <h2 class="allRecipes-h1"><span class="underline">Post New Blog</span></h2>
                            <form class="login-form" enctype="multipart/form-data" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

                                <div class="form-group <?php echo (!empty($title_err)) ? 'has-error' : ''; ?>">
                                    <p class='add-blog-title'>Title fo you Blog Post</p>
                                    <input class='blog-post-title' type="text" name="blogTitle" class="form-control">
                                    <span class="help-block"><?php echo $title_err; ?></span>
                                </div>

                                <div class="form-group <?php echo (!empty($content_err)) ? 'has-error' : ''; ?>">
                                    <p class='add-blog-content-title'>Blog Post Content</p>
                                    <textarea class='blog-post' type="text" name="blogContent" class="form-control"> </textarea>
                                    <span class="help-block"><?php echo $content_err; ?></span>
                                </div>

                                <input type="hidden" name="blogId" value="<?php echo $id; ?>" />
                                <input type="submit" class="btn btn-light btn-sm" name="submit" value="Submit">
                                <a href=".php" class="btn btn-light-invert btn-sm">Cancel</a>
                            </form>


                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Create a Recipe
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                            <h2 class='allRecipes-h1'><span class="underline">Create Recipe</span></h2>
                            <form class="create-recipe-form" enctype="multipart/form-data" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

                                <div class='row'>
                                    <div class="form-group col-md-6 <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                                        <label>Name</label>
                                        <input type="text" name="recipeName" class="form-control">
                                        <span class="help-block"><?php echo $name_err; ?></span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Video URL</label>
                                        <input class="form-control" type="text" name="video_name" />
                                        <span class="help-block"></span>
                                    </div>
                                </div>

                                <div class=row>
                                    <div class="form-group col-lg-3 col-md-6 <?php echo (!empty($servings_err)) ? 'has-error' : ''; ?>">
                                        <label>Servings</label>
                                        <input type="text" name="servings" class="form-control" value="<?php echo $servings; ?>">
                                        <span class="help-block"><?php echo $servings_err; ?></span>
                                    </div>

                                    <div class="form-group col-lg-3 col-md-6 <?php echo (!empty($maxTime_err)) ? 'has-error' : ''; ?>">
                                        <label>Max Time</label> <br>
                                        <input onchange="displayTime()" type="range" min="1" max="60" value="10" id="maxTime" name="maxTime" />
                                        <p><span id="timeArea"> <?= isset($_POST['maxTime']) ? $_POST['maxTime'] : '10 minutes' ?>10 minutes</span></p>
                                    </div>

                                    <div class="form-group col-lg-2 col-md-6 <?php echo (!empty($difficultyID_err)) ? 'has-error' : ''; ?>">
                                        <label>Difficulty</label><br>
                                        <select id="difficulty" name="difficulty">
                                            <option value="1">Easy </option>
                                            <option value="2">Medium</option>
                                            <option value="3">Hard</option>
                                        </select>
                                        <span class="help-block"><?php echo $difficultyID_err; ?></span>
                                    </div>

                                    <div class="form-group col-lg-3 col-md-6 <?php echo (!empty($rating_err)) ? 'has-error' : ''; ?>">
                                        <label>Rating</label><br>
                                        <fieldset class="rating">
                                            <input type="radio" id="star5" name="rating" value="5" /><label for="star5">5 stars</label>
                                            <input type="radio" id="star4" name="rating" value="4" /><label for="star4"> 4 stars</label>
                                            <input type="radio" id="star3" name="rating" value="3" /><label for="star3">3 stars</label>
                                            <input type="radio" id="star2" name="rating" value="2" /><label for="star2">2 stars</label>
                                            <input type="radio" id="star1" name="rating" value="1" /><label for="star1">1 star</label>
                                        </fieldset>

                                    </div>

                                </div>
                                <div class='row'>
                                    <div class="form-group col-md-4 ">
                                        <label>Image</label>
                                        <input class="input-group " type="file" name="image" accept="image/*" />
                                    </div>
                                </div>
                                <div class='row'>
                                    <div id="addedIngredient" class="col-md-6 form-group <?php echo (!empty($ingredient_err)) ? 'has-error' : ''; ?>">
                                        <label> Add Ingredients </label><br>
                                        <label style="color:black;"> Metric </label>
                                        <input type="radio" onclick="displayMobileIng()" value="Metric" name="ingredients" id="mob-metric" />
                                        <label style="color:black;"> Imperial </label>
                                        <input type="radio" onclick="displayMobileIng()" value="Metric" name="ingredients" id="mob-imperial" />
                                        <div id="mob-ingArea">
                                            <div id="mob-metricIng" class="unitHide">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <p> Name </p>
                                                        <input class="form-control" type="text" name="metric_ingredient_name[]" />
                                                    </div>

                                                    <div class="col-md-4">
                                                        <p> Measure </p>
                                                        <input class="form-control" type="text" name="metric_ingredient_measure[]" />
                                                    </div>
                                                    <div class="col-md-4">
                                                        <p> Unit </p>
                                                        <select name="metric_ingredient_unit[]" id="units">
                                                            <option value="grams">Gram(s)</option>
                                                            <option value="kg">Kg</option>
                                                            <option value="ml">Ml</option>
                                                            <option value="litre(s)">Litre(s)</option>
                                                            <option value="pinch">Pinch</option>
                                                            <option value="whole">Whole</option>
                                                            <option value="teaspoon(s)">Teaspoon(s)</option>
                                                            <option value="tablespoon(s)">Tablespoon(s)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- <input id = "ingbtn" type = "button" class="btn btn-sm add-recipe-button" value = "Add Ingredient" onclick = "addMetricIngredient()" /> -->
                                                <button id="ingbtn" class="addBut btn " type="button" value="Add Ingredient" onclick="addMetricIngredient()"> </button>
                                            </div>
                                            <div id="mob-imperialIng" class="unitHide">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <p> Name </p>
                                                        <input class="form-control" type="text" name="imperial_ingredient_name[]" />
                                                    </div>
                                                    <div class="col-md-4">
                                                        <p> Measure </p>
                                                        <input class="form-control" type="text" name="imperial_ingredient_measure[]" />
                                                    </div>
                                                    <div class="col-md-4">
                                                        <p> Unit </p>
                                                        <select name="imperial_ingredient_unit[]" id="units">
                                                            <option value="ounce">Ounce(s)</option>
                                                            <option value="pound">Pound(s)</option>
                                                            <option value="cup">Cup(s)</option>
                                                            <option value="pinch">Pinch</option>
                                                            <option value="whole">Whole</option>
                                                            <option value="teaspoon(s)">Teaspoon(s)</option>
                                                            <option value="tablespoon(s)">Tablespoon(s)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <button class="addBut btn " type="submit" value="Add Ingredient" onclick="addImperialIngredient()"> </button>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div id="addedStep" class="col-md-6 form-group <?php echo (!empty($step_err)) ? 'has-error' : ''; ?>">
                                        <label> Method </label>
                                        <button id="addBtn" type="button" class="btn addBut" onClick="addStep()" alt="Add Step"> </button>
                                    </div>

                                </div>


                                <input type="hidden" name="recipe_ID" value="<?php echo $id; ?>" />
                                <input type='submit' class="btn btn-light" name='submitRecipe' value="Submit the form" />
                                <a href="show-all-recipes.php" class="btn btn-light">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                All Users
                            </button>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body">
                            <table class="table1">
                                <tr>
                                    <th class="th1">User ID</th>
                                    <th class="th1">First Name</th>
                                    <th class="th1">Last Name </th>
                                    <th class="th1">Email</th>
                                    <th class="th1">Delete</th>
                                </tr>
                                <?php foreach ($user as $users) : ?>
                                    <tr>
                                        <td class="td1">
                                            <p><?php echo $users['user_ID']; ?></p>
                                        </td>
                                        <td class="td1">
                                            <p><?php echo $users['fname']; ?></p>
                                        </td>
                                        <td class="td1">
                                            <p><?php echo $users['lname']; ?></p>
                                        </td>
                                        <td class="td1">
                                            <p><?php echo $users['u_email']; ?></p>
                                        </td>
                                        <td class="td1">

                                            <form action="delete-user.php" method="post" id="delete_user_form">
                                                <a href="delete-user.php?user_ID=<?php echo $users['user_ID'] ?>" class="add-my-recipe">Delete</a>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingFour">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                All Recipes
                            </button>
                        </h5>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                        <div class="card-body">

                            <?php
                            $query = "SELECT * FROM recipes order by 'date_created'";
                            $statement = $conn->prepare($query);
                            $statement->execute();
                            $recipes = $statement->fetchAll();
                            $statement->closeCursor();
                            ?>


                            <h2 class='allRecipes-h1'><span class="underline">View All Recipe</span></h2>

                            <table class="table1" style="background-color: white;">
                                <tr>
                                    <th class="th1">Recipe ID</th>
                                    <th class="th1">Recipe Name</th>
                                    <th class="th1">Servings </th>
                                    <th class="th1">Time</th>
                                    <th class="th1">Ratings</th>
                                    <th class="th1">Difficulty</th>
                                    <th class="th1">Image</th>
                                    <th class="th1">Video</th>
                                    <th class="th1">Delete</th>
                                </tr>
                                <?php foreach ($recipes as $recipe) : ?>
                                    <tr>
                                        <td class="td1">
                                            <p><?php echo $recipe['recipe_ID']; ?></p>
                                        </td>
                                        <td class="td1">
                                            <p><?php echo $recipe['name']; ?></p>
                                        </td>
                                        <td class="td1">
                                            <p><?php echo $recipe['servings']; ?></p>
                                        </td>
                                        <td class="td1">
                                            <p><?php echo $recipe['maxTime']; ?></p>
                                        </td>
                                        <td class="td1">
                                            <p><?php echo $recipe['rating']; ?></p>
                                        </td>
                                        <td class="td1">
                                            <p><?php echo $recipe['difficultyID']; ?></p>
                                        </td>
                                        <td class="td1">
                                            <p><?php echo $recipe['image']; ?></p>
                                        </td>
                                        <td class="td1">
                                            <p><?php echo $recipe['video_name']; ?></p>
                                        </td>
                                        <td class="td1">

                                            <form action="delete-recipe.php" method="post" id="delete_recipe_form">
                                                <a href="delete_recipe.php?recipe_ID=<?php echo $recipe['recipe_ID'] ?>" class="add-my-recipe">Delete</a>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingFive">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                Favourites
                            </button>
                        </h5>
                    </div>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                        <div class="card-body">

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
                                                <center><a href="recipe_single.php?recipe_ID=<?php echo $recipe['recipe_ID'] ?>"><button type="button" class="btn btn-light">View Recipe</button></a> </center>
                                                <a href="remove_from_fav.php?recipe_ID=<?php echo $recipe['recipe_ID'] ?>&user_ID=<?php echo $userID;?>" class="sortBy add-my-recipe">
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

                <div class="card">
                    <div class="card-header" id="headingSix">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                My Recipes
                            </button>
                        </h5>
                    </div>
                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                        <div class="card-body">
                            <h2 class='allRecipes-h1'><span class="underline">View All My Recipes</span></h2>

                            <h5>Can't get enough of creating new recipes? Why not create more of your own unique recipes <a class='add-my-recipe' href="add-recipe.php"> here </a>?</h5>
                            <br>
                            <?php


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
                </div>
            </div>

























        </div>
    </main>



    <?php include_once 'includes/footer.php'; ?>






</body>

</html>