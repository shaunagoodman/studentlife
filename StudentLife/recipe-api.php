<?php
session_start();
include_once 'includes/database/connection.php';
$user = 0;
if (isset($_SESSION["loggedin"])) {
  $user = $_SESSION['user_ID'];
}
?>
<html>
<?php
$recipeID = "";
include_once 'includes/CDNs.php';
?>

<head>
  <meta charset="UTF-8">
  <title>What's in My Fridge?</title>
  <link rel="icon" href="images/recipeasy-icons-logos/small-logo.png">
  <script src="javascript/scripts.js"></script>
  <script src="javascript/api.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.10.4/typeahead.bundle.min.js"></script>
  <script src="javascript/typeahead.tagging.js"></script>
</head>

<body ng-app="BlankApp" ng-controller="ChipCtrl as ctrl" ng-cloak onload="chippy()" class='site'>
  <?php include_once 'includes/nav-menu.php'; ?>

  <main class='site-content'>

    <div class="container">
      <br>
      <h1><span class="underline">What's in your fridge?</span></h1>

      <p>Can't decide what to make? Just enter below what food you have at home and we'll give you some delicious
        recipes that you can make with them!</p>
      <div class="col-md-12 recipe-api">
        <div class='api-div1'>
          <div id="ingredientsList">
            <ul id="list1"></ul>
            <input type="text" id="ingredients" placeholder="egg, milk, butter...">
            <div id="hidden1"> </div>
          </div>

          <!-- <input data-role="tagsinput" class="form-control api-form-control" name='ingredients' id='ingredients' type="text" placeholder="eggs, milk, butter"> -->
          <p> <input class='checkbox-api' type="checkbox" id="addTime" onClick="toggleTime()" />Add Time Limit (If you do not set a limit it will default to 10 mins).</p>


          <!--TIME -->
          <div id="addedTime">
          <input onchange="displayTime()"type = "range" min = "1" max = "60" value = "10" id = "maxTime" name = "maxTime"/>
          <span id = "timeArea"> <?= isset($_POST['maxTime']) ? $_POST['maxTime'] : '' ?>"</span>
          </div>
          <br>
          <!--INTOLERANCE -->
          <div class='row'>
            <div class='col-lg-12'>
              <p class='sub-head-api'> <input class='checkbox-api' type="checkbox" id="selectIntolerance" onClick="toggleIntolerances()" />Have an Intolerance?</p>
              <div id="intoleranceList">
                <input id="intolerances" class="tags-input" placeholder="Gluten, Dairy, Nuts..." value="">
                <div id="hidden2"> </div>
              </div>
            </div>

            <!-- ----------DIET RESTRICTION---------->

            <div class='col-lg-12'>
              <p class='sub-head-api'> <input class='checkbox-api' type="checkbox" id="selectDietRestriction" onClick="toggleDietRestrictions()" />Have a Diet Restriction?</p>
              <div id="dietRestrictionsList">
                <input id="dietRestrictions" class="tags-input" placeholder="Paleo, Vegan, Ketogenic..."value="">
                <div id="hidden3"> </div>

              </div>
            </div>
          </div>
          <!-- -------------------------------------------- -->
<br>
          <button class="btn api-button" type="button" onclick="findRecipe()">Submit</button> <br>
          <br>
          <!--Choose Recipe-->
          <div id="result" class="hide">
            <select class="form-control api-form-control" name="selectIngredients" id="selectIngredients">
              <option>Choose a recipe</option>
            </select>
            <button class="btn api-button" onClick="viewRecipe()"> View Recipe</button>
          </div>
          <br>
        </div>
      </div>
      <?php
      $title = $servings = "";
      $ingredients = [];
      $unit = [];
      $amount = [];
      $method = [];


      ?>





      <!-- ################# Recipe Displayed Below ################# -->
   
        <!-- </div> -->
        <div class="col-md-6 recipe-api">
          <!--Search Area-->
          <?php
          $cookie_name = "recipe_ID";
          if (isset($_COOKIE[$cookie_name])) {
            $recipe_ID = $_COOKIE[$cookie_name];
          }
          if (isset($_POST['btnFav'])) {
            if (isset($_SESSION["loggedin"])) {
              $user = $_SESSION['user_ID'];
              include_once 'includes/database/APItoDatabase.php';
            } else {
              echo "<script language = javascript>
                  favouritePopUp();
              </script>";
            }
          }
          ?>
        </div>



      <h5 id="recipeName"></h5>
      <div id="displayedRecipe" class="hide">
        <br>





        <div class=row>
          <div class='col-md-7 single-recipe-topRow'>

            <div id="image"></div>
            <form class="faveForm" action="" method="POST">
              <!-- <input class="btn api-button random-button" type="submit" name="btnFav" value="Favourite" /> -->
              <button id="myImage" class="myLink btn" type="submit" name="btnFav" alt="favourite me!"> </button>
            </form>

          </div>
          <div class='col-md-5 single-recipe-topRow'>
            <div class="row iconList">
              <p class='random-recipe-div'>
                <div class="col-sm-6 col-lg-12"><img src='images/recipeasy-icons-logos/knife-fork.png' style='margin-right:1.5%' alt='clock icon' height='35' width='35'><strong>Servings:</strong>
                  <strong id="servings"></strong></div>
                <br><br>

                <div class="col-sm-6 col-lg-12"><img src='images/recipeasy-icons-logos/clock.png' style='margin-right:1.5%' alt='clock icon' height='30' width='30'><strong>Cooking Time: </strong>
                  <strong id="maxTime"></strong></div>
                <br><br>

                <div class="col-sm-6 col-lg-12"><img src='images/recipeasy-icons-logos/cuisine.png' style='margin-right:1.5%' alt='clock icon' height='30' width='30'><strong>Cuisine: </strong>
                  <strong id="cuisine"></strong></div>
                <br><br>

                <div class="col-sm-6 col-lg-12"><img src='images/recipeasy-icons-logos/utensils.png' style='margin-right:1.5%' alt='clock icon' height='40' width='40'><strong>Equipment: </strong>
                  <strong id="equipment"></strong></div>
                <br><br>

              </p>
            </div>

          </div>

          

          <div class='row ingredientMethod'>

            <div class='col-lg-4 col-md-5 col-12 '>

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

              <div class='ingredientsDiv'>
                <ol id="ingredientList" style='padding-left: 4.5%;'></ol>
              </div>

              <br><br>
            </div>


            <div class='col-lg-8 col-md-7 col-12'>

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
                <ol id="methodList" style='padding-left: 4.5%;'></ol>
              </div>


            </div>

          </div>

        </div>
      </div>















        <!--End of recipe display-->
      </div>
    </div>
    <!--End recipe container-->
    </div>

  </main>
  <?php
  include_once 'includes/footer.php';
  ?>

</body>

</html>