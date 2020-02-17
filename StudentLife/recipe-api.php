
<?php
// Initialize the session
session_start();
?>
<html>
<?php
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
          <p> Enter how many minutes long you want to spend cooking </p>
          <input class="form-control api-form-control" name='time' id='time'/>
          <select class="form-control api-form-control" id="selectIntolerance">
            <option>Select an intolerance</option>
            <option>Dairy</option>
            <option>Egg</option>
            <option>Gluten</option>
            <option>Grain</option>
            <option>Peanut</option>
            <option>Seafood</option>
            <option>Sesame</option>
            <option>Shellfish</option>
            <option>Soy</option>
            <option>Sulfite</option>
            <option>Tree Nut</option>
            <option>Wheat</option>
          </select>

          <select class="form-control api-form-control" id="selectDietRestriction">
            <option>Select Diet Restriction</option>
            <option>Gluten Free</option>
            <option>Ketogenic</option>
            <option>Vegetarian</option>
            <option>Vegan</option>
            <option>Pescetarian</option>
            <option>Paleo</option>
            <option>Primal</option>
            <option>Whole30</option>
          </select>
          <button class="btn api-button" onclick="findRecipe()">Submit</button>
      </div>

      <!--Choose Recipe-->
      <div id="result" class = "hide">
        <select class="form-control api-form-control" id="selectIngredients">
          <option>Choose a recipe</option>
        </select>
        <button class="btn api-button" onClick="viewRecipe()"> View Recipe</button>
      </div>
    </div>


    <!-- ################# Recipe Displayed Below ################# -->
    <div id = "recipeName"></div>
    <div id = "ingredientList"></div>
    <ol id = "methodList"></ol>
    <!--End of recipe display-->

  </div> <!--End recipe container-->
  <?php
  include_once 'includes/footer.php';
  ?>

</body>

</html>