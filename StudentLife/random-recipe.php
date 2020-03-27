<?php
session_start();
include_once 'includes/database/connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Random</title>
  <script src="javascript/randomRecipe.js"></script>
  <script src="javascript/scripts.js"></script>
</head>

<body class='site' onload="findRecipe()">
  <?php include_once 'includes/nav-menu.php'; ?>

  <main class='site-content'>

    <div class="container">

      <h1 class="allRecipes-h1"><span class="underline">Recipe Generator</span></h1>
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
            <div class="row">
              <p class='random-recipe-div'>
                <div class="col-sm-6 col-lg-12"><img src='images/recipeasy-icons-logos/knife-fork.png' style='margin-right:1.5%' alt='clock icon' height='35' width='35'><strong>Servings:</strong>
                  <strong id="servings"></strong></div>
                <br><br>

                <div class="col-sm-6 col-lg-12"><img src='images/recipeasy-icons-logos/clock.png' style='margin-right:1.5%' alt='clock icon' height='30' width='30'><strong>Cooking Time: </strong>
                  <strong id="time"></strong></div>
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
              <div class='ingredientsTitleRand'>
                <h5><!--  <i class=" faR fa fa-chevron-right" aria-hidden="true"></i> -->
                  <span class='ingredientsRandSpan'><strong>Ingredients: </strong> </span>
                </h5>
              </div>

              <div class='ingredientsDivRand'>
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
              <div class='methodTitleRand'>
                 <h5><!-- <i class="faR2 fa fa-chevron-right" aria-hidden="true"></i> -->
                  <span class='methodRandSpan'><strong>Method: </strong> </span>
                </h5>
              </div>

              <div class="methodDivRand">
                <ol id="methodList" style='padding-left: 4.5%;'></ol>
              </div>


            </div>

          </div>

        </div>
      </div>
    </div>
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

  </main>


  <?php include_once 'includes/footer.php'; ?>
</body>

</html>