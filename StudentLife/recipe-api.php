<?php
// Initialize the session
session_start();
?>




<!-- Still need to add equioment and price -->
<!-- Refresh page when user wants a different recipe-->
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

  <div class="col-md-6 recipe-api" >


    <input class="form-control api-form-control" name='ingredients' id='ingredients'  placeholder="eggs, milk, butter" />

    <button class="btn api-button" onclick="findRecipe()">Submit</button>

    <div id="result" class = "hide">

    <br>
    <select class="form-control api-form-control" id="selectIngredients">
      <option>Choose a recipe</option>
    </select>
    <button class="btn api-button" onClick="viewRecipe()"> View Recipe</button>
    </div>


<!-- recipe displayed below-->

    <div class="col-md-12" >
    <div class="recipe-itself" id="selectedRecipe"></div>
    </div>

<br>


  </div>

  <?php
  include_once 'includes/footer.php';
  ?>

</body>

</html>