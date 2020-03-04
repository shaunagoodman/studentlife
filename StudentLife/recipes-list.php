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
        if(!empty($array))
        {
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

<body class='site' >
    <?php include_once 'includes/nav-menu.php'; ?>

    <main class='site-content' >

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
        if(!empty($recipes)) {
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
        
        if($recipe['isAPI'] == 1) {
            $src = $recipe['image'];
        }
        else {
            if(empty($recipe['image'])) {
                $src = "images/recipes/placeholder.png";
            }
            else {
                $src = 'images/recipes/'.$recipe['image']; 
            }     
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
                            <center><a href="recipe_single.php?recipe_ID=<?php echo $recipe['recipe_ID'] ?>"><button type="button" class="btn btn-light stretched-link">View Recipe</button></a> </center>
                        </div>
                    </div>
                </div>

        <?php endforeach;
        } 
        else {
            echo "<script language = javascript>
            swal({  title: 'Oops!',
             text: 'It seems like we dont have ay recipes which match your search. Why not make a new search using the recipes you have?',  
            type: 'success',    
            showCancelButton: false,   
            closeOnConfirm: false,   
            confirmButtonText: 'Aceptar', 
            showLoaderOnConfirm: true, }).then(function() {
                window.location = 'recipe-api.php';
            });;
        </script>";
        }
        echo "</div>" ;
        ?>

    </div>



    </main>
    <?php include_once 'includes/footer.php'; ?>

</body>
</html>