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
    <?php include_once 'includes/CDNs.php'; ?>
</head>

<body class='site' >
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
</main>
    <?php include_once 'includes/footer.php'; ?>
</body>

</html>