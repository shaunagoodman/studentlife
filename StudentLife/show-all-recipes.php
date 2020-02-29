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
}
else {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Recipes</title>
    <?php include_once 'includes/CDNs.php'; ?>
</head>

<body>
    <?php include_once 'includes/nav-menu.php'; ?>

        <div class="container">


    <h1 class="allRecipes-h1" >All Recipes</h1>
    <hr align="left">
    

        <?php
        echo "<div class='row' >";
        //get the results from the $products variable(using a loop)
        foreach ($recipes as $recipe) :  
            if($recipe['difficultyID'] == 1) {
                $difficulty = "Easy";
            }
            else if ($recipe['difficultyID'] == 2) {
                $difficulty = "Medium";
            }
            else if ($recipe['difficultyID'] == 3) {
                $difficulty = "Hard";
            }
            else {
                $difficulty = "No difficulty selected.";
            }
            if(empty($recipe['image'])) {
                $recipe['image'] = "placeholder.png";
            }
            if($recipe['isAPI'] == 1) {
                $src = $recipe['image'];
            }
            else {
                $src = 'images/recipes/'.$recipe['image'];
            }
        ?>
             <div class='col-lg-4' >
             <!-- <img src='images/recipes/pancakes.jpg' alt='dish image' height='250' width='270'> -->
             <img src='<?php echo $src;  ?>' alt='dish image' height='250' width='270'>
             <h4 class='recipe-name'> <?php echo $recipe['name']; ?> </h4>
             <h5 class='recipe-difficulty' >  Difficulty: <?php echo $difficulty; ?> </h5>
             <h5 class='recipe-time' > <img src='images/recipeasy-icons-logos/clock.png' style='margin-bottom:0.3%'  alt='clock icon' height='25' width='25'> Time: <?php echo $recipe['maxTime']; ?>
            </h5>
            <a href="recipe_single.php?recipe_ID=<?php echo $recipe['recipe_ID']?>"><button type="button" class="btn btn-sm btn-outline-secondary">View Recipe</button></a>
            <br>
            </div>

        <?php endforeach;
        echo "</div>" ?>
        <a href = "add-recipe.php"><button> Add recipe </button></a>
    </div>
    
    <?php include_once 'includes/footer.php'; ?>

</body>
</html>