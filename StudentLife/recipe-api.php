<!-- Still need to add equioment and price -->
<!-- Refresh page when user wants a different recipe-->
<html>
    <?php
include_once 'includes/CDNs.php';
?>

<head>
  <script src="javascript/scripts.js"></script>
</head>

<body>
    <?php include_once 'includes/nav-menu.php'; ?>
<p>Enter ingredients</p>
<input name = 'ingredients' id = 'ingredients' />
        <button onclick="findRecipe()">Submit</button>
        <div id="result"></div>
        <select id="selectIngredients">
    <option>Choose a recipe</option>
</select>
<button onClick = "viewRecipe()"> 
View Recipe
</button>
<div id="selectedRecipe"></div>
  <?php
include_once 'includes/footer.php';
?>
</body>

</html>