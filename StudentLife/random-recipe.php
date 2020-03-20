<?php
session_start();
include_once 'includes/database/connection.php';
include_once 'includes/CDNs.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <script src="javascript/randomRecipe.js"></script>
</head>

<body class='site'>
  <?php include_once 'includes/nav-menu.php'; ?>

  <main class='site-content'>

    <div class="container">
      <h1 class="allRecipes-h1"><span class="underline">Recipe Generator</span></h1>
     

      <button class="btn api-button" type="button" onclick="findRecipe()">Generate Recipe</button>
      <div id="displayedRecipe" class="hide">
        <br>
        <!-- <div class='col-lg-4 api-recipe'>
            <div id="image"></div>
          </div> -->
        <div class='row random-row'>
          <div class='col-lg-8 random-recipe-list'>
            <div class='col-lg-12 random-recipe title-div'>
              <h4 class='randomResultHeading title'> Title </h4>
              <hr class='title-random-line' >
              <h5 id="recipeName"></h5>
              <br>
            </div>

            <div class='row'>
            <div class='col-lg-5 random-recipe ingredients-div'>
              <h4 class='randomResultHeading'> Ingredients </h4>
              <hr class='ingredient-random-line' >
              <ol id="ingredientList" style='padding-left: 4.5%;'></ol>
            </div>

            
            <div class='col-lg-3 random-recipe other-recipe-div'>
              <h4 class='randomResultHeading'> Serves </h4>
              <hr class='serves-random-line' >
              <div id="servings"></div>
            
              <h4 class='randomResultHeading'> Time </h4>
              <hr class='time-random-line' >
              <div id="time"></div>

              <h4 class='randomResultHeading'> Equipment </h4>
              <hr class='equipment-random-line' >
              <div id="equipment"></div>

              <h4 class='randomResultHeading'> Cuisine </h4>
              <hr class='cuisine-random-line' >
              <div id="cuisine"></div>

            </div>
            </div>


            

            <!-- <div class='col-lg-12 random-recipe'>
              <h4 class='randomResultHeading'> Ingredients </h4>
              <ol id="ingredientList" style='padding-left: 4.5%;'></ol>
            </div> -->

            <div class='col-lg-12 random-recipe'>
              <h4 class='randomResultHeading'> Method </h4>
              <hr class='method-random-line' >
              <ol id="methodList" style='padding-left: 4.5%;'></ol>
            </div>




            <form action="" method="POST">
              <input class="btn api-button random-button" type="submit" name="btnFav" value="Favourite" />
              <br>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php
    if (isset($_POST['btnFav'])) {
      if (isset($_SESSION["loggedin"])) {
        $user = $_SESSION['user_ID'];
        include_once 'includes/database/randomToDb.php';
      } else {
        echo "<script language = javascript>
                  favouritePopUp();
              </script>";
      }
    }
    ?>

  </main>


  <?php include_once 'includes/footer.php'; ?>
</body>

</html>