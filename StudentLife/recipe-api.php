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
  <title>Recipe API</title>
  <script src="javascript/scripts.js"></script>
  <script src="javascript/api.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.10.4/typeahead.bundle.min.js"></script>
	<script src="javascript/typeahead.tagging.js"></script>
</head>
<body ng-app="BlankApp" ng-controller="ChipCtrl as ctrl" ng-cloak onload = "chippy()" class='site' >
  <?php include_once 'includes/nav-menu.php'; ?>

  <main class='site-content' >

  <div class="container">
    <br>
    <h1><span class="underline">What's in your fridge?</span></h1>
    
    <p>Can't decide what to make? Just enter below what food you have at home and we'll give you some delicious
      recipes that you can make with them!</p>
    <div class="col-md-6 recipe-api">
      <div id = "ingredientsList">
        <ul id="list1"></ul>
        <input type="text" id="ingredients" placeholder="egg, milk, butter...">
        <div id = "hidden1"> </div>
      </div>
        <!-- <input data-role="tagsinput" class="form-control api-form-control" name='ingredients' id='ingredients' type="text" placeholder="eggs, milk, butter"> -->
        <p> <input class='checkbox-api' type="checkbox" id="addTime" onClick="toggleTime()" />Add Time Limit (If you do not set a limit it will defualt to 10 mins).</p>
        
        <!--TIME -->
        <div id="addedTime">
          <input class="form-control api-form-control" name='time' id='time' />
        </div>
        <br>
         <!--INTOLERANCE -->
        <div class='row'>
          <div class='col-lg-6'>
            <p class='sub-head-api'> <input class='checkbox-api' type="checkbox" id="selectIntolerance" onClick="toggleIntolerances()" />Have an Intolerance?</p>
            <hr align="left" class="api-line">
            <div id="intoleranceList">
                <ul id="list2"></ul>
                <input id="intolerances" class="tags-input" value="">
                <div id = "hidden2"> </div>
          </div>
        </div>

          <!-- ----------DIET RESTRICTION---------->

          <div class='col-lg-6'>

            <p class='sub-head-api'> <input class='checkbox-api' type="checkbox" id="selectDietRestriction" onClick="toggleDietRestrictions()" />Have a Diet Restriction?</p>
            <hr align="left" class="api-line">
            <div id="dietRestrictionsList">
              <ul id="list3"></ul>
              <input id="dietRestrictions" class="tags-input" value="">
              <div id = "hidden3"> </div>

            </div>
          </div>
</div>
        <!-- -------------------------------------------- -->

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
      <?php
      $title = $servings = "";
      $ingredients = [];
      $unit = [];
      $amount = [];
      $method = [];


      ?>
      <!-- ################# Recipe Displayed Below ################# -->
      <div id="displayedRecipe" class="hide row">
        <!-- <div class='row'> -->

          <div class='col-lg-4 api-recipe'>
            <div id="image"></div>
          </div>

          <div class='col-lg-4 api-recipe'>
            <h5 class='resultHeading'> Title </h5> 
            <div id="recipeName"></div>
          </div>

          <div class='col-lg-4 api-recipe'>
            <h5 class='resultHeading'> Serves </h5>
            <div id="servings"></div>
          </div>

          <div class='col-lg-4 api-recipe'>
            <h5 class='resultHeading'> Time </h5>
            <div id="maxTime"></div>
          </div>

          <div class='col-lg-4 api-recipe'>
            <h5 class='resultHeading'> Cuisine </h5>
            <div id="cuisine"></div>
          </div>

          <div class='col-lg-7 api-recipe'>
            <h5 class='resultHeading'> Method </h5> 
            <ol id="methodList"style='padding-left: 4.5%;'></ol>
          </div>

          <div class='col-lg-5 api-recipe'>
            <h5 class='resultHeading'> Ingredients </h5> 
           <!-- <ul class='ingredients-list' > <div id="ingredientList"></div></ul> -->
           <ol id="ingredientList" style='padding-left: 4.5%;'></ol>
          </div>

          <div class='col-lg-6 api-recipe'>
            <h5 class='resultHeading'> Equipment </h5> 
            <div id="equipment"></div>
          </div>

          
          <form action="" method="POST">
             <input class="btn api-button" type="submit" name="btnFav" value="Favourite"/>
          </form>
        <!-- </div> -->
        <div class="col-md-6 recipe-api">
          <!--Search Area-->
          <?php 
      $cookie_name = "recipe_ID";
      if(isset($_COOKIE[$cookie_name])) {
        $recipe_ID = $_COOKIE[$cookie_name];
      }
      if (isset($_POST['btnFav'])) {
        if (isset($_SESSION["loggedin"])) {
          $user = $_SESSION['user_ID'];
          include_once 'includes/database/APItoDatabase.php';
      }
        else {
          echo "<script language = javascript>
                  favouritePopUp();
              </script>";
            }
        }
      ?>
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