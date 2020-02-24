<?php
// Initialize the session
session_start();
require_once 'includes/database/connection.php';

try {
    //write a query to get the dynamic categories (All categories)  maybe go to phpmyadmin to check is it working
    $query = "SELECT * from difficulties";           //run in phpmyadmin to check if working

    //run my query 
    //prepare the query (PDO)
    $statement = $conn->prepare($query);

    //bind data if required  (if i need to contrain using a WHERE clause) not needed rn cos we need all categories
    //execute the query
    $statement->execute();


    //create a variable to save the result set ($categories)
    $difficulties = $statement->fetchAll();
    //close the statement
    $statement->closeCursor();

    if(isset($_POST['submit'])) {
        $searchString = $_POST['something'];
        $array = explode(" ",$searchString);
        $sql = "SELECT * FROM recipes WHERE name ";
        $count = 0;
        forEach($array as $value) {
            if ($count == 0) {
                $sql .= " LIKE '%" . $value . "%'";
            }
            else {
                $sql .= " OR '%" . $value . "%'";
            }
            $count++;
        }
        $statement = $conn->prepare($sql);
        $statement->execute();
        $recipes = $statement->fetchAll();
        

}
else if(empty($_POST['submit'])) {
    //get the category id from the URL (if there is one)
    $difficultyID = filter_input(INPUT_GET, "difficulty_id", FILTER_VALIDATE_INT);
    //write a query to get the dynamic products (all products - from the categories ive selected) 
    if ($difficultyID != "") {
        //query if a value has been passed for category id
        $query = "SELECT * from recipes WHERE difficultyID = :difficulty_id";
    } else {
        //query if a value has NOT been passed for category id
        $query = "SELECT * from recipes";
    }

    //prepare the query (PDO)
    $statement2 = $conn->prepare($query);

    //bind data if required  (if i need to contrain using a WHERE clause)
    $statement2->bindValue(":difficulty_id", $difficultyID);
    //execute the query
    $statement2->execute();
    //create a variable to save the result set ($products)
    $recipes = $statement2->fetchAll();
    //close the statement
    $statement2->closeCursor();
}

} catch (Exception $ex) {
    $errorMessage = $e->getMessage();
    echo $errorMessage;
    exit();
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
    


    <div class='sub-menu' >
        <?php
        //get the results from the categories variable(usuing a loop)
        echo "<div id='div-difficulty-list' >";
        echo "<ul class='diff-list' id='ul-difficulty-list' >";
        echo "<li class='li-diff-list' > <a href='recipes-list.php'>Show All </li>";
        foreach ($difficulties as $difficulty) :
            echo "<li class='li-diff-list'>";
            echo "<a class='diff-menu-a' href='recipes-list.php?difficulty_id=" . $difficulty['difficultyID'] . "'>";
            echo $difficulty['diffName'];
            echo "</a>";
            echo "</li>"; 
        endforeach;
        echo "</ul>";
        echo "</div>";
        ?>

    </div>


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
        ?>

             <div class='col-lg-4' >
             <!-- <img src='images/recipes/pancakes.jpg' alt='dish image' height='250' width='270'> -->
             <img src='images/recipes/<?php echo $recipe['image'];  ?>' alt='dish image' height='250' width='270'>
             <h4 class='recipe-name'> <?php echo $recipe['name']; ?> </h4>
             <h5 class='recipe-difficulty' >  Difficulty: <?php echo $difficulty; ?> </h5>
             <h5 class='recipe-time' > <img src='images/recipeasy-icons-logos/clock.png' style='margin-bottom:0.3%'  alt='clock icon' height='25' width='25'> Time: <?php echo $recipe['maxTime']; ?>
            </h5>
            <a href="recipe_single.php?recipe_ID=<?php echo $recipe['recipe_ID']?>"><button type="button" class="btn btn-sm btn-outline-secondary">View Recipe</button></a>
            <br>
            </div>

        <?php endforeach;
        echo "</div>" ?>
        

    </div>




    <?php include_once 'includes/footer.php'; ?>

</body>
</html>