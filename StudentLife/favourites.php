<?php
// Initialize the session
session_start();
require_once 'includes/database/connection.php';
// Check if the user is logged in, if not then redirect him to login page
if (isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true) {
    try {
        $userID = $_SESSION['user_ID'];
        $sql = "SELECT * FROM recipes WHERE isFavourite = 1 AND user_ID = $userID";
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
    <title>Home</title>
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
            foreach ($recipes as $recipe) : ?>

                <div class='col-lg-4' >
                <!-- <img src='images/recipes/pancakes.jpg' alt='dish image' height='250' width='270'> -->
                <img src='images/recipes/<?php echo $recipe['image'];  ?>' alt='dish image' height='250' width='270'>
                <h4 class='recipe-name'> <?php echo $recipe['name']; ?> </h4>
                <h5 class='recipe-difficulty' >  Difficulty: <?php echo $recipe['difficulty_text']; ?> </h5>
                <h5 class='recipe-time' > <img src='images/recipeasy-icons-logos/clock.png' style='margin-bottom:0.3%'  alt='clock icon' height='25' width='25'> Time: <?php echo $recipe['maxTime']; ?>
               </h5>
               <a href="recipe_single.php?recipe_ID=<?php echo $recipe['recipe_ID']?>"><button type="button" class="btn btn-sm btn-outline-secondary">View Recipe</button></a>
               <br>
               </div>
   
           <?php endforeach;
        }
        else {
            echo "You have not added any recipes yet.";
        }
        
        echo "</div>" ?>
        

    </div> 
    <?php include_once 'includes/footer.php';?>