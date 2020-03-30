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
    <link rel="icon" href="images/recipeasy-icons-logos/small-logo.png">
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

<body onload = "displayTime()" class='site' >
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
                <label>Video URL</label>
                <input class="form-control" type="text" name="video_name" />
                <span class="help-block"></span>
            </div>
        </div>
        
        <div class=row >
            <div class="form-group col-lg-3 col-md-6 <?php echo (!empty($servings_err)) ? 'has-error' : ''; ?>">
                <label>Servings</label>
                <input type="text" name="servings" class="form-control" value="<?php echo $servings; ?>">
                <span class="help-block"><?php echo $servings_err; ?></span>
            </div>

            <div class="form-group col-lg-3 col-md-6 <?php echo (!empty($maxTime_err)) ? 'has-error' : ''; ?>">
                <label>Max Time</label> <br>
                <input onchange="displayTime()"type = "range" min = "1" max = "60" value = "10" id = "maxTime" name = "maxTime"/>
                <p><span id = "timeArea"> <?= isset($_POST['maxTime']) ? $_POST['maxTime'] : '10 minutes' ?>10 minutes</span></p>
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
            <div class="form-group col-lg-2 col-md-6">
                <label>Cuisine</label><br>
                <select id="cuisine" name="cuisine">
                    <option value="1">African </option>
                    <option value="2">America</option>
                    <option value="3">British</option>
                    <option value="4">Cajun </option>
                    <option value="5">Caribbean</option>
                    <option value="6">Chinese</option>
                    <option value="7">Eastern European </option>
                    <option value="8">European</option>
                    <option value="9">French</option>
                    <option value="10">German </option>
                    <option value="11">Green</option>
                    <option value="12">Indian</option>
                    <option value="13">Irish</option>
                    <option value="14">Italian</option>
                    <option value="15">Japanese</option>
                    <option value="16">Jewish</option>
                    <option value="17">Korean</option>
                    <option value="18">Latin American</option>
                    <option value="19">Mediterranean</option>
                    <option value="20">Mexican</option>
                    <option value="21">Middle Eastern</option>
                    <option value="22">Nordic</option>
                    <option value="23">Southern</option>
                    <option value="24">Spanish</option>
                    <option value="25">Thai</option>
                </select>
            </div>


        </div>
        <div class='row' >
        

        <div class="form-group col-lg-3 col-md-6 <?php echo (!empty($rating_err)) ? 'has-error' : ''; ?>">
                <label>Rating</label><br>
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

        <div class='row' >
            <div id="addedIngredient" class="col-md-6 form-group <?php echo (!empty($ingredient_err)) ? 'has-error' : ''; ?>">
                <label> Add Ingredients </label><br>
                <label style="color:black;" > Metric </label>
                <input type="radio" onclick = "displayIng()" value = "Metric"  name = "ingredients" id = "metric" />
                <label style="color:black;"> Imperial </label>
                <input type="radio" onclick = "displayIng()" value = "Metric" name = "ingredients" id = "imperial" />
                <div id = "ingArea">
                    <div id = "metricIng" class = "unitHide">
                        <div class="row" >
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
                        <button id = "ingbtn"  class="addBut btn " type="button" value = "Add Ingredient" onclick = "addMetricIngredient()"> </button>
                    </div>
                    <div id = "imperialIng" class = "unitHide">
                    <div class="row" >
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
                        <button   class="addBut btn " type="submit" value = "Add Ingredient" onclick = "addImperialIngredient()"> </button>
                    </div>
                </div>
            </div>
            <br>
            <div id="addedStep" class="col-md-6 form-group <?php echo (!empty($step_err)) ? 'has-error' : ''; ?>">
                <label> Method </label>
            <button id="addBtn" type="button" class="btn addBut"  onClick="addStep()" alt="Add Step" > </button>
            </div>
            
        </div>


        <input type="hidden" name="recipe_ID" value="<?php echo $id; ?>" />
        <input type='submit' class="btn btn-light"  name = 'submitRecipe' value="Submit the form"/>
        <a href="show-all-recipes.php" class="btn btn-light">Cancel</a>
    </form>

    </div>
</main>
    <?php include_once 'includes/footer.php'; ?>
</body>

</html>