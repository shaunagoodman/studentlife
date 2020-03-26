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














        <!-- <div class='col-lg-4 api-recipe'>
          <div id="image"></div>
        </div>
        <div class='row random-row'>
          <div class='col-lg-8 random-recipe-list'>
            <div class='col-lg-12 random-recipe title-div'>
              <h4 class='randomResultHeading title'> Title </h4>
              <hr class='title-random-line'>
              <h5 id="recipeName"></h5>
              <br>
            </div>

            <div class='row'>
              <div class='col-lg-5 random-recipe ingredients-div'>
                <h4 class='randomResultHeading'> Ingredients </h4>
                <hr class='ingredient-random-line'>
                <ol id="ingredientList" style='padding-left: 4.5%;'></ol>
              </div>


              <div class='col-lg-3 random-recipe other-recipe-div'>
                <h4 class='randomResultHeading'> Serves </h4>
                <hr class='serves-random-line'>
                <div id="servings"></div>

                <h4 class='randomResultHeading'> Time </h4>
                <hr class='time-random-line'>
                <div id="time"></div>

                <h4 class='randomResultHeading'> Equipment </h4>
                <hr class='equipment-random-line'>
                <div id="equipment"></div>

                <h4 class='randomResultHeading'> Cuisine </h4>
                <hr class='cuisine-random-line'>
                <div id="cuisine"></div>

              </div>
            </div>

            <div class='col-lg-12 random-recipe'>
              <h4 class='randomResultHeading'> Method </h4>
              <hr class='method-random-line'>
              <ol id="methodList" style='padding-left: 4.5%;'></ol>
            </div> 
          </div>
        </div> -->




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