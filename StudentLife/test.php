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


<script>
$(document).ready(function() {
  $(this).on("click", ".ingredientsTitle", function() {
    $(this).parent().find(".ingredientsDiv").toggle();
    $(this).find(".fa2").toggleClass('active');
  });
});


$(document).ready(function() {
  $(this).on("click", ".ingredientsTitleRand", function() {
    $(this).parent().find(".ingredientsDivRand").toggle();
    $(this).find(".faR").toggleClass('active');
  });
});

$(document).ready(function() {
  $(this).on("click", ".methodTitleRand", function() {
    $(this).parent().find(".methodDivRand").toggle();
    $(this).find(".faR3").toggleClass('active');
  });
});
</script>


  <?php include_once 'includes/nav-menu.php'; ?>
  <main class='site-content'>

    <div class="container">



    <div class='col-lg-4 col-md-5 col-12 '>

<!-- DESKTOP -->
<div class='ingredientsDeskTitle'>
    <h5> <strong>Ingredients: </strong></h5>
</div>
<!-- MOBILE -->
<div class='ingredientsTitle'>
    <h5> <i class=" fa2 fa fa-chevron-right" aria-hidden="true"></i>
        <span class='ingredientsSpan'><strong>Ingredients: </strong> </span>
    </h5>
</div>

<div class='ingredientsDiv'>
    <?php
    if ($ingredients != null) {
        $ingLength = sizeof($ingredients);
        for ($x = 0; $x < $ingLength; $x++) {
            $ingredientName = $ingredients[$x];
            $ingredientAmount = $amount[$x];
            $ingredientMeasure = $unit[$x];
            echo $ingredientName . " " . $ingredientAmount . " " . $ingredientMeasure . "</br>";
        }
    } else {
        echo "No ingredients available.";
    }
    ?>
</div>
<br><br>
</div>










          <div class='row ingredientMethod'>

            <div class='col-lg-4 col-md-5 col-12 '>

              <!-- DESKTOP -->
              <div class='ingredientsDeskTitle'>
                <h5> <strong>Ingredients: </strong></h5>
              </div>
              <!-- MOBILE -->
              <div class='ingredientsTitleRand'>
                <h5> <i class=" faR fa fa-chevron-right" aria-hidden="true"></i>
                  <span class='ingredientsRandSpan'><strong>Ingredients: </strong> </span>
                </h5>
              </div>

              <div class='ingredientsDivRand'>
                INGREDIENTS DIV
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
                <h5> <i class="faR2 fa fa-chevron-right" aria-hidden="true"></i>
                  <span class='methodRandSpan'><strong>Method: </strong> </span>
                </h5>
              </div>

              <div class="methodDivRand">
               METHODS DIV
              </div>


            </div>

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