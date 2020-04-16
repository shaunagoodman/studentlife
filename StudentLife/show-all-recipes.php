<?php
// Initialize the session
session_start();
require_once 'includes/database/connection.php';
if (isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true) {
    try {
        $userID = $_SESSION['user_ID'];
        $query = "SELECT * FROM recipes WHERE user_ID = $userID";
        $statement2 = $conn->prepare($query);
        $statement2->bindValue(":userID", $userID);
        $statement2->execute();
        $recipes = $statement2->fetchAll();
        $statement2->closeCursor();
    } catch (Exception $ex) {
        $errorMessage = $e->getMessage();
        echo $errorMessage;
        exit();
    }
} else {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>My Recipes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/recipeasy-icons-logos/small-logo.png">
    <?php include_once 'includes/CDNs.php'; ?>
</head>

<body class='site' >
    <?php include_once 'includes/nav-menu.php'; ?>

    <main class='site-content' >
    <div class="container">


        <h1 class="allRecipes-h1"><span class="underline">All Your Recipes</span></h1>

        

            <h5>Can't get enough of creating new recipes? Why not create more of your own unique recipes <a class='add-my-recipe' href = "add-recipe.php"> here </a>?</h5>

            <br>

        <?php
        echo "<div class='row no-gutters' >";
        //get the results from the $products variable(using a loop)
        foreach ($recipes as $recipe) :
            if ($recipe['difficultyID'] == 1) {
                $difficulty = "Easy";
            } else if ($recipe['difficultyID'] == 2) {
                $difficulty = "Medium";
            } else if ($recipe['difficultyID'] == 3) {
                $difficulty = "Hard";
            } else {
                $difficulty = "No difficulty selected.";
            }
            if(empty($recipe['image'])) {
                $recipe['image'] = "images/recipes/placeholder.png";
            }
            if($recipe['isAPI'] == 1) {
                $src = $recipe['image'];
            }
            else {
                $src = 'images/recipes/'.$recipe['image'];
            }
        ?>

            <div class="col-lg-4 col-md-6 bottom-home d-flex align-items-stretch">
                <div class="card home-card recipe-page-card" style="margin-left: 2%; margin-right: 2%;">
                    <img src="<?php echo $src;?>" class="card-img-top" alt='dish image' height='315' width='328'>
                    <div class="card-body d-flex flex-column align-item-center">
                        <h5 class="card-title"><?php echo $recipe['name'];  ?></h5>
                        <p class="card-text" class='recipe-difficulty'> Difficulty: <?php echo $difficulty; ?> </p>
                        <p class="card-text" class='recipe-time'> <img src='images/recipeasy-icons-logos/clock.png' style='margin-bottom:0.3%' alt='clock icon' height='25' width='25'> Time: <?php echo $recipe['maxTime']; ?>
                        </p>
                        <center><a href="recipe_single.php?recipe_ID=<?php echo $recipe['recipe_ID'] ?>" class="btn btn-light card-button">View Recipe</a> </center>
                    </div>
                </div>
            </div>

        <?php endforeach;
        echo "</div>" ?>
    </div>

    </main>

    <?php include_once 'includes/footer.php'; ?>

</body>

</html>