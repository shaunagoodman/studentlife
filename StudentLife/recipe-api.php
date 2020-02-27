
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
    <center> <h1>What's in your fridge?</h1> </center>
      <hr class="faq-line" >
      <p>Can't decide what to make? Just enter below what food you have at home and we'll give you some delicious 
        recipes that you can make with them!</p>

    <div class="col-md-6 recipe-api" > <!--Search Area-->
      <!--Search Ingredients-->
      <div id = "ingredientInput">
        <input class="form-control api-form-control" name='ingredients' id='ingredients'  placeholder="eggs, milk, butter" />
        <input type="checkbox" id="addTime" onClick = "toggleTime()" />Select if you wish to add a time limit (If you do not set a limit it will defualt to 10 mins).<br>
        <div id = "addedTime">
       <p> Enter how many minutes long you want to spend cooking </p>
        <input class="form-control api-form-control" name='time' id='time'/>
</div>
        <input type="checkbox" id="selectIntolerance" onClick = "toggleIntolerances()" />Select if you have an Intolerance<br>

        <div id = "intoleranceList" >
          <p>Select any of the following intolerances: </p></br>
          <input type="checkbox" name="intolerance" value="dairy">Dairy<br>
          <input type="checkbox" name="intolerance" value="egg">Egg<br>
          <input type="checkbox" name="intolerance" value="gluten">Gluten<br>
          <input type="checkbox" name="intolerance" value="grain">Grain<br>
          <input type="checkbox" name="intolerance" value="peanut">Peanut<br>
          <input type="checkbox" name="intolerance" value="seafood">Seafood<br>
          <input type="checkbox" name="intolerance" value="sesame">Sesame<br>
          <input type="checkbox" name="intolerance" value="shellfish">Shellfish<br>
          <input type="checkbox" name="intolerance" value="soy">Soy<br>
          <input type="checkbox" name="intolerance" value="sulfite">Sulfite<br>
          <input type="checkbox" name="intolerance" value="tree nut">Tree Nut<br>
          <input type="checkbox" name="intolerance" value="wheat">Wheat<br>
        </div> 
        <input type="checkbox" id="selectDietRestriction" onClick = "toggleDietRestrictions()" />Select if you have a Diet Restriction<br>
        <div id = "dietRestrictionsList" >
        <p>Select any of the following Diet Restrictions:</p>
        <input type="checkbox" name="dietRestriction" value="gluten free">Gluten Free<br>
        <input type="checkbox" name="dietRestriction" value="ketogenic">Ketogenic<br>
        <input type="checkbox" name="dietRestriction" value="paleo">Paleo<br>
        <input type="checkbox" name="dietRestriction" value="pescetarian">Pescetarian<br>
        <input type="checkbox" name="dietRestriction" value="primal">Primal<br>
        <input type="checkbox" name="dietRestriction" value="vegan">Vegan<br>
        <input type="checkbox" name="dietRestriction" value="vegetarian">Vegetarian<br>
        <input type="checkbox" name="dietRestriction" value="whole30">Whole30<br>
      </div>
      <button class="btn api-button" type = "button" onclick="findRecipe()">Submit</button>
      <!--Choose Recipe-->
      <div id="result" class = "hide">
        <select class="form-control api-form-control" name = "selectIngredients" id="selectIngredients">
          <option>Choose a recipe</option>
        </select>
        <button class="btn api-button" onClick="viewRecipe()"> View Recipe</button>
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
    <div id = "displayedRecipe" class = "hide">
      <h3 class = 'resultHeading'> Title </h3> </br>
      <div id = "recipeName"></div>
      <h3 class = 'resultHeading'> Servings </h3> </br>
      <div id = "servings"></div>
      <h3 class = 'resultHeading'> Equipment </h3> </br>
      <div id = "equipment"></div>
      <h3 class = 'resultHeading'> Cuisine </h3> </br>
      <div id = "cuisine"></div>
      <h3 class = 'resultHeading'> Ingredients </h3> </br>
      <div id = "ingredientList"></div>
      <h3 class = 'resultHeading'> Method </h3> </br>
      <ol id = "methodList"></ol>
      <div class="col-md-6 recipe-api" > <!--Search Area-->
    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
    <input type="submit" name="btnFav" value="Submit"/>
    </form>
    <?php include_once 'includes/database/APItoDatabase.php'; ?>
        <!-- <button type = "submit" name = "favouriteButton">Add to Favourites </button> -->
    </div>
    <!--End of recipe display-->
</div>
  </div> <!--End recipe container-->
</div>
<?php
  include_once 'includes/footer.php';
  ?>

</body>

</html>