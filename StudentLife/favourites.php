<?php
// Initialize the session
session_start();
require_once 'includes/database/connection.php';
// Check if the user is logged in, if not then redirect him to login page
if (isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true) {
    try {
        $userID = $_SESSION['user_ID'];
        $sql = "SELECT * FROM recipes WHERE isFavourite = 1 AND favourited_by = $userID";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $recipes = $statement->fetchAll();

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
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>
    <meta charset="UTF-8">
    <title>Favourites</title>
    <?php include_once 'includes/CDNs.php'; ?>
    <link href="includes/stylesheet.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <?php include_once 'includes/nav-menu.php'; ?>

    <div class="container">


    <h1 class="allRecipes-h1" >Favourites</h1>
    <hr align="left">
    

        <?php
        echo "<div class='row' >";
        //get the results from the $products variable(using a loop)
        if($recipes != null) {
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
                $recipe['image'] = "images/recipes/placeholder.png";
            }
            if($recipe['isAPI'] == 1) {
                $src = $recipe['image'];
            }
            else {
                $src = 'images/recipes/'.$recipe['image'];
            }
            ?>

               <div class="col-lg-4 bottom-home ">
                    <div class="card home-card recipe-page-card">
                        <img src="<?php echo $src;?>" class="card-img-top" alt='dish image' height='315' width='328'>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $recipe['name'];  ?></h5>
                            <p class="card-text" class='recipe-difficulty'> Difficulty: <?php echo $difficulty; ?> </p>
                            <p class="card-text" class='recipe-time'> <img src='images/recipeasy-icons-logos/clock.png' style='margin-bottom:0.3%' alt='clock icon' height='25' width='25'> Time: <?php echo $recipe['maxTime']; ?>
                            </p>
                            <center><a href="recipe_single.php?recipe_ID=<?php echo $recipe['recipe_ID'] ?>"><button type="button" class="btn btn-light">View Recipe</button></a> </center>
                        </div>
                    </div>
                </div>
   
           <?php endforeach;
        }
        else {
            echo "You have not added any recipes yet.";
        }
        
        echo "</div>" ?>
        

    </div> 
    <?php include_once 'includes/footer.php';?>