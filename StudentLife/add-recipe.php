<?php

session_start();
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
// Include config file
require_once "includes/database/connection.php";
include_once 'includes/database/addRecipe.php'; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Recipe</title>
    <script src="javascript/scripts.js"></script>
    <script src="javascript/slider.js"></script>
    <script src="javascript/rating.js"></script>

    <?php include_once 'includes/CDNs.php'; ?>
</head>

<body onload = "slider()" class='site' >
    <?php include_once 'includes/nav-menu.php';
    ?>
<main class='site-content' >

    <div class='container' >
    <h2 class='allRecipes-h1'><span class="underline">Create Recipe</span></h2>
    <p>Please fill this form and submit recipe to the database.</p>

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
                   <!-- ---------------------------- -->
                  <div class='row' >
        <div id="addedIngredient" class="col-md-6 form-group <?php echo (!empty($ingredient_err)) ? 'has-error' : ''; ?>">
            <label> Ingredients </label>
            <button id="addBtn" type="button" class="btn btn-sm add-recipe-button"  onClick="addIngredient()"> Add Ingredient</button>
        </div>
        

        <br>
        <div id="addedStep" class="col-md-6 form-group <?php echo (!empty($step_err)) ? 'has-error' : ''; ?>">
            <label> Method </label>
           <button id="addBtn" type="button" class="btn btn-sm add-recipe-button"  onClick="addStep()" > Add Step</button>
        </div>
        
                  </div>
        <!-- ---------------------------- -->

        <div class=row >

        <div class="form-group col-md-6 <?php echo (!empty($servings_err)) ? 'has-error' : ''; ?>">
            <label>Servings</label>
            <input type="text" name="servings" class="form-control" value="<?php echo $servings; ?>">
            <span class="help-block"><?php echo $servings_err; ?></span>
        </div>

        <div class="form-group col-md-6 <?php echo (!empty($maxTime_err)) ? 'has-error' : ''; ?>">
            <label>Max Time</label>
            <input type = "range" min = "1" max = "60" value = "10" id = "myRange"/>
            <span id = "demo"> </span>
        </div>

        </div>
        <!-- ---------------------------- -->
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
            <!-- <div class='rating-stars text-center'>
                <ul id='stars'>
                    <li class='star' title='Poor' data-value='1'>
                        <i class='fa fa-star fa-fw'></i>
                    </li>
                    <li class='star' title='Fair' data-value='2'>
                        <i class='fa fa-star fa-fw'></i>
                    </li>
                    <li class='star' title='Good' data-value='3'>
                        <i class='fa fa-star fa-fw'></i>
                    </li>
                    <li class='star' title='Excellent' data-value='4'>
                        <i class='fa fa-star fa-fw'></i>
                    </li>
                    <li class='star' title='WOW!!!' data-value='5'>
                        <i class='fa fa-star fa-fw'></i>
                    </li>
                </ul>
            </div> -->
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
</main>
    <?php include_once 'includes/footer.php'; ?>
</body>

</html>