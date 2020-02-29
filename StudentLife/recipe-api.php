<?php
session_start();
include_once 'includes/database/connection.php';
$user = 0;
if (isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true) {
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
</head>
<body>
  <?php include_once 'includes/nav-menu.php'; ?>
  <div class="container">
    <br>
    <center><h1>What's in your fridge?</h1></center>
    <hr class="faq-line">
    <p>Can't decide what to make? Just enter below what food you have at home and we'll give you some delicious
      recipes that you can make with them!</p>
    <div class="col-md-6 recipe-api">
      <!--Search Area-->
      <!--Search Ingredients-->
      <div id="ingredientInput">
        <input class="form-control api-form-control" name='ingredients' id='ingredients' placeholder="eggs, milk, butter" /> <br>
        <p> <input class='checkbox-api' type="checkbox" id="addTime" onClick="toggleTime()" />Select if you wish to add a time limit (If you do not set a limit it will defualt to 10 mins).</p>
        
        <!--TIME -->
        <div id="addedTime">
          <p> Enter how many minutes long you want to spend cooking </p>
          <input class="form-control api-form-control" name='time' id='time' />
        </div>
        <br>
         <!--INTOLERANCE -->
        <div class='row'>
          <div class='col-lg-6'>
            <p class='sub-head-api'> <input class='checkbox-api' type="checkbox" id="selectIntolerance" onClick="toggleIntolerances()" />Select if you have an Intolerance</p>
            <hr align="left" class="api-line">
            <div id="intoleranceList">
              <p><strong>Select any of the following intolerances:</strong> </p>
              <p><input class='checkbox-api' type="checkbox" name="intolerance" value="dairy">Dairy<br>
                <input class='checkbox-api' type="checkbox" name="intolerance" value="egg">Egg<br>
                <input class='checkbox-api' type="checkbox" name="intolerance" value="gluten">Gluten<br>
                <input class='checkbox-api' type="checkbox" name="intolerance" value="grain">Grain<br>
                <input class='checkbox-api' type="checkbox" name="intolerance" value="peanut">Peanut<br>
                <input class='checkbox-api' type="checkbox" name="intolerance" value="seafood">Seafood<br>
                <input class='checkbox-api' type="checkbox" name="intolerance" value="sesame">Sesame<br>
                <input class='checkbox-api' type="checkbox" name="intolerance" value="shellfish">Shellfish<br>
                <input class='checkbox-api' type="checkbox" name="intolerance" value="soy">Soy<br>
                <input class='checkbox-api' type="checkbox" name="intolerance" value="sulfite">Sulfite<br>
                <input class='checkbox-api' type="checkbox" name="intolerance" value="tree nut">Tree Nut<br>
                <input class='checkbox-api' type="checkbox" name="intolerance" value="wheat">Wheat</p>
            </div>
          </div>

          <!-- ----------DIET RESTRICTION---------->

          <div class='col-lg-6'>

            <p class='sub-head-api'> <input class='checkbox-api' type="checkbox" id="selectDietRestriction" onClick="toggleDietRestrictions()" />Select if you have a Diet Restriction</p>
            <hr align="left" class="api-line">
            <div id="dietRestrictionsList">
              <p><strong>Select any of the following Diet Restrictions:</strong></p>
              <p> <input class='checkbox-api' type="checkbox" name="dietRestriction" value="gluten free">Gluten Free<br>
                <input class='checkbox-api' type="checkbox" name="dietRestriction" value="ketogenic">Ketogenic<br>
                <input class='checkbox-api' type="checkbox" name="dietRestriction" value="paleo">Paleo<br>
                <input class='checkbox-api' type="checkbox" name="dietRestriction" value="pescetarian">Pescetarian<br>
                <input class='checkbox-api' type="checkbox" name="dietRestriction" value="primal">Primal<br>
                <input class='checkbox-api' type="checkbox" name="dietRestriction" value="vegan">Vegan<br>
                <input class='checkbox-api' type="checkbox" name="dietRestriction" value="vegetarian">Vegetarian<br>
                <input class='checkbox-api' type="checkbox" name="dietRestriction" value="whole30">Whole30</p>
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

          <!-- <div class='col-lg-4 api-recipe'>
            <div id="image"></div>
          </div> -->

          <div class='col-lg-4 api-recipe'>
            <h5 class='resultHeading'> Title </h5> 
            <div id="recipeName"></div>
          </div>

          <div class='col-lg-4 api-recipe'>
            <h5 class='resultHeading'> Serves </h5>
            <div id="servings"></div>
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
                  swal({  title: 'Not Logged In!',
                   text: 'You must be logged in to favourite a recipe.',  
                  type: 'success',    
                  showCancelButton: false,   
                  closeOnConfirm: false,   
                  confirmButtonText: 'Aceptar', 
                  showLoaderOnConfirm: true, }).then(function() {
                      window.location = 'login.php';
                  });;
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
  <?php
  include_once 'includes/footer.php';
  ?>

</body>

</html>