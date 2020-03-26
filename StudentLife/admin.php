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
    <title>Profile</title>

    <?php include_once 'includes/CDNs.php'; ?>
    <script src="javascript/scripts.js"></script>
    <script src="javascript/slider.js"></script>
    <script src="javascript/rating.js"></script>
    <style>
    .rating {
    float:left;
}
.rating:not(:checked) > input {
    position:absolute;
    top:-9999px;
    clip:rect(0,0,0,0);
}

.rating:not(:checked) > label {
    float:right;
    width:1em;
    padding:0 .1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:200%;
    line-height:1.2;
    color:#ddd;
}

.rating:not(:checked) > label:before {
    content: '★ ';
}

.rating > input:checked ~ label {
    color: #f70;
}

.rating:not(:checked) > label:hover,
.rating:not(:checked) > label:hover ~ label {
    color: gold;
}

.rating > input:checked + label:hover,
.rating > input:checked + label:hover ~ label,
.rating > input:checked ~ label:hover,
.rating > input:checked ~ label:hover ~ label,
.rating > label:hover ~ input:checked ~ label {
    color: #ea0;
}

.rating > label:active {
    position:relative;
    top:2px;
    left:2px;
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

                            <hr>
                            <h5 class="h5-profile">Email:</h5>

                            <p><?php echo htmlspecialchars($_SESSION["u_email"]); ?></p>

                            <a href="edit_details.php" class="btn btn-light btn-sm">Edit Profile</a>

                            <a href="reset_password.php" class="btn btn-light btn-sm">Reset Password</a>


                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>

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

        <div class='row' > 
            <div class="form-group col-md-6 <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                <label>Name</label>
                <input type="text" name="recipeName" class="form-control">
                <span class="help-block"><?php echo $name_err; ?></span>
            </div>

            <div class="form-group col-md-6">
                <label>Video Name</label>
                <input class="form-control" type="text" name="video_name" />
                <span class="help-block"></span>
            </div>
        </div>
        <div class='row' >
            <div id="addedIngredient" class="col-md-6 form-group <?php echo (!empty($ingredient_err)) ? 'has-error' : ''; ?>">
                <label> Ingredients </label>
                <label> Metric </label>
                <input type="radio" onclick = "displayIng()" value = "Metric"  name = "ingredients" id = "metric" />
                <label> Imperial </label>
                <input type="radio" onclick = "displayIng()" value = "Metric" name = "ingredients" id = "imperial" />
                <div id = "ingArea">
                    <div id = "metricIng" class = "unitHide">
                        <p> Name </p>
                        <input class="form-control" type="text" name="ingName" />
                        <p> Measure </p>
                        <input class="form-control" type="text" name="ingMeasure" />
                        <p> Unit </p>
                        <select name="units" id="units">
                            <option value="grams">Gram(s)</option>
                            <option value="kg">Kg</option>
                            <option value="ml">Ml</option>
                            <option value="litre(s)">Litre(s)</option>
                            <option value="pinch">Pinch</option>
                            <option value="whole">Whole</option>
                            <option value="teaspoon(s)">Teaspoon(s)</option>
                            <option value="tablespoon(s)">Tablespoon(s)</option>
                        </select>
                        <input id = "ingbtn" type = "button" class="btn btn-sm add-recipe-button" value = "Add Ingredient" onclick = "addMetricIngredient()" />
                    </div>
                    <div id = "imperialIng" class = "unitHide">
                        <p> Name </p>
                        <input class="form-control" type="text" name="ingName" />
                        <p> Measure </p>
                        <input class="form-control" type="text" name="ingMeasure" />
                        <p> Unit </p>
                        <select name="units" id="units">
                            <option value="ounce">Ounce(s)</option>
                            <option value="pound">Pound(s)</option>
                            <option value="cup">Cup(s)</option>
                            <option value="pinch">Pinch</option>
                            <option value="whole">Whole</option>
                            <option value="teaspoon(s)">Teaspoon(s)</option>
                            <option value="tablespoon(s)">Tablespoon(s)</option>
                        </select>
                        <input type = "submit" class="btn btn-sm add-recipe-button" value = "Add Ingredient" onclick = "addImperialIngredient()" />
                    </div>
                </div>
            </div>
            <br>
            <div id="addedStep" class="col-md-6 form-group <?php echo (!empty($step_err)) ? 'has-error' : ''; ?>">
                <label> Method </label>
            <button id="addBtn" type="button" class="btn btn-sm add-recipe-button"  onClick="addStep()" > Add Step</button>
            </div>
            
        </div>
        <div class=row >
            <div class="form-group col-md-6 <?php echo (!empty($servings_err)) ? 'has-error' : ''; ?>">
                <label>Servings</label>
                <input type="text" name="servings" class="form-control" value="<?php echo $servings; ?>">
                <span class="help-block"><?php echo $servings_err; ?></span>
            </div>

            <div class="form-group col-md-6 <?php echo (!empty($maxTime_err)) ? 'has-error' : ''; ?>">
                <label>Max Time</label>
                <input onchange="displayTime()"type = "range" min = "1" max = "60" value = "10" id = "maxTime" name = "maxTime"/>
                <span id = "timeArea"> <?= isset($_POST['maxTime']) ? $_POST['maxTime'] : '' ?>"</span>
            </div>

        </div>
        <div class='row' >
            <div class="form-group col-md-4 <?php echo (!empty($difficultyID_err)) ? 'has-error' : ''; ?>">
                <label>Difficulty</label>
                <select id="difficulty" name="difficulty">
                    <option value="1">Easy </option>
                    <option value="2">Medium</option>
                    <option value="3">Hard</option>
                </select>
                <span class="help-block"><?php echo $difficultyID_err; ?></span>
            </div>

            <div class="form-group col-md-4 <?php echo (!empty($rating_err)) ? 'has-error' : ''; ?>">
                <label>Rating</label>
                <fieldset class="rating">
                    <input type="radio" id="star5" name="rating" value="5" /><label for="star5" >5 stars</label>
                    <input type="radio" id="star4" name="rating" value="4" /><label for="star4"> 4 stars</label>
                    <input type="radio" id="star3" name="rating" value="3" /><label for="star3" >3 stars</label>
                    <input type="radio" id="star2" name="rating" value="2" /><label for="star2" >2 stars</label>
                    <input type="radio" id="star1" name="rating" value="1" /><label for="star1" >1 star</label>
                </fieldset>
  
            </div>

            <div class="form-group col-md-4 ">
                <label>Image</label>
                <input class="input-group " type="file" name="image" accept="image/*" />

            </div>

        </div>


        <input type="hidden" name="recipe_ID" value="<?php echo $id; ?>" />
        <input type='submit' class="btn btn-light"  name = 'submit' value="Submit the form"/>
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

                <!-- **********************FAVOURITES TAB******************************** -->
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">


                    <div id="myFaves" class="container">


                        <?php

                        try {
                            $userID = $_SESSION['user_ID'];
                            $sql = "SELECT * FROM recipes WHERE isFavourite = 1 AND favourited_by = $userID";
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


                        <div class='container' >
        <div class='col-lg-12 mobile-profile'>

            <div class='row surround-filter-div'>
                <div class='col-sm-12 col-lg-12'>

                    <div class="addBlogTitle">
                        <h4><i class="fa4 fa fa-chevron-right" aria-hidden="true"></i>
                            <span class='addBlogSpan'> Add Blog </span></h4>

                    </div>

                    <div class="addBlogDiv fade show">

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

                <!-- CREATE A RECIPE -->

                <br>
                <div class='col-sm-12 col-lg-12'>
                    <div class="addRecipesTitle">
                        <h4><i class=" fa5 fa fa-chevron-right" aria-hidden="true"></i>
                            <span class='addRecipesSpan'> Create a Recipe </span></h4>
                    </div>



                    <div class='addRecipesDiv'>


                        <h2 class='allRecipes-h1'><span class="underline">Create Recipe</span></h2>
                        <form class=" create-recipe-form" enctype="multipart/form-data" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

                            <div class='row'>
                                <div class="form-group col-md-6 <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                                    <label>Name</label>
                                    <input type="text" name="recipeName" class="form-control">
                                    <span class="help-block"><?php echo $name_err; ?></span>
                                </div>



                                <div class="form-group col-md-6">
                                    <label>Video Name</label>
                                    <input class="form-control" type="text" name="video_name" />
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <!-- ---------------------------- -->
                            <div class='row'>
                                <div id="addedIngredient" class="col-md-6 form-group <?php echo (!empty($ingredient_err)) ? 'has-error' : ''; ?>">
                                    <label> Ingredients </label>
                                    <button id="addBtn" type="button" class="btn btn-sm add-recipe-button" onClick="addIngredient()"> Add Ingredient</button>
                                </div>


                                <br>
                                <div id="addedStep" class="col-md-6 form-group <?php echo (!empty($step_err)) ? 'has-error' : ''; ?>">
                                    <label> Method </label>
                                    <button id="addBtn" type="button" class="btn btn-sm add-recipe-button" onClick="addStep()"> Add Step</button>
                                </div>

                            </div>
                            <!-- ---------------------------- -->

                            <div class=row>

                                <div class="form-group col-md-6 <?php echo (!empty($servings_err)) ? 'has-error' : ''; ?>">
                                    <label>Servings</label>
                                    <input type="text" name="servings" class="form-control" value="<?php echo $servings; ?>">
                                    <span class="help-block"><?php echo $servings_err; ?></span>
                                </div>

                                <div class="form-group col-md-6 <?php echo (!empty($maxTime_err)) ? 'has-error' : ''; ?>">
                                    <label>Max Time</label>
                                    <input type="text" name="maxTime" class="form-control" value="<?php echo $time; ?>">
                                    <span class="help-block"><?php echo $maxTime_err; ?></span>
                                </div>

                            </div>
                            <!-- ---------------------------- -->
                            <div class='row'>

                                <div class="form-group col-md-4 <?php echo (!empty($difficultyID_err)) ? 'has-error' : ''; ?>">
                                    <label>Difficulty</label>
                                    <select id="difficulty" name="difficulty">
                                        <option value="1">Easy </option>
                                        <option value="2">Medium</option>
                                        <option value="3">Hard</option>
                                    </select>
                                    <span class="help-block"><?php echo $difficultyID_err; ?></span>
                                </div>

                                <div class="form-group col-md-4 <?php echo (!empty($rating_err)) ? 'has-error' : ''; ?>">
                                    <label>Rating</label>
                                    <select id="rating" name="rating">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    <span class="help-block"><?php echo $rating_err; ?></span>
                                </div>

                                <div class="form-group col-md-4 ">
                                    <label>Image</label>
                                    <input class="input-group " type="file" name="image" accept="image/*" />
                                </div>
                            </div>


                            <input type="hidden" name="recipe_ID" value="<?php echo $id; ?>" />
                            <input type="submit" class="btn btn-light" value="Submit">
                            <a href="show-all-recipes.php" class="btn btn-light">Cancel</a>
                        </form>

                    </div>

                </div>


                <!-- SHOW RECIPE -->

                <br>
                <div class='col-sm-12 col-lg-12'>
                    <div class="showRecipesTitle">
                        <h4><i class=" fa6 fa fa-chevron-right" aria-hidden="true"></i>
                            <span class='showRecipesSpan'> Show All Recipe </span></h4>
                    </div>

                    <div class='showRecipesDiv'>


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

                </div>


                <!-- SHOW USERS -->

                <br>
                <div class='col-sm-12 col-lg-12'>
                    <div class="showUsersTitle">
                        <h4><i class=" fa7 fa fa-chevron-right" aria-hidden="true"></i>
                            <span class='showUsersSpan'> Show All Users </span></h4>
                    </div>

                    <div class='showUsersDiv'>

                        <h2 class='allRecipes-h1'><span class="underline">View All Users</span></h2>


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


                <!-- SHOW MY RECIPES -->

                <br>
                <div class='col-sm-12 col-lg-12'>
                    <div class="myRecipesTitle">
                        <h4><i class=" fa8 fa fa-chevron-right" aria-hidden="true"></i>
                            <span class='myRecipesSpan'> Show All My Recipes </span></h4>
                    </div>

                    <div class='myRecipesDiv'>

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


                <!-- SHOW faves -->

                <br>
                <div class='col-sm-12 col-lg-12'>
                    <div class="myFavesTitle">
                        <h4><i class=" fa9 fa fa-chevron-right" aria-hidden="true"></i>
                            <span class='myFavesSpan'> Show All My Favourites </span></h4>
                    </div>

                    <div class='myFavesDiv'>

                        <br>
                        <?php



try {
    $userID = $_SESSION['user_ID'];
    $sql = "SELECT * FROM recipes WHERE isFavourite = 1 AND favourited_by = $userID";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $recipes = $statement->fetchAll();
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