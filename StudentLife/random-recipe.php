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
    <body>
    <?php include_once 'includes/nav-menu.php'; ?>

  <div class="container">
        <button class="btn api-button" type="button" onclick="findRecipe()">Generate Recipe</button> 
      <div id="displayedRecipe" class = "hide">
      <br>
    <center><h1>Recipe Generator</h1></center>
    <hr class="faq-line">
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
            <h5 class='resultHeading'> Time </h5>
            <div id="time"></div>
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
           <ol id="ingredientList" style='padding-left: 4.5%;'></ol>
          </div>

          <div class='col-lg-6 api-recipe'>
            <h5 class='resultHeading'> Equipment </h5> 
            <div id="equipment"></div>
          </div>
     
      <form action="" method="POST">
             <input class="btn api-button" type="submit" name="btnFav" value="Favourite"/>
      </form>
    </div>
     </div>
    <?php 
      if (isset($_POST['btnFav'])) {
        if (isset($_SESSION["loggedin"])) {
          $user = $_SESSION['user_ID'];
          include_once 'includes/database/randomToDb.php';
      }
        else {
          echo "<script language = javascript>
                  favouritePopUp();
              </script>";
            }
        }
      ?>

    
    <?php include_once 'includes/footer.php'; ?>
    </body>
    </html>