<?php


// Initialize the session
session_start();


// Include config file
require_once "includes/database/connection.php";


$query = "SELECT * FROM recipes WHERE user_ID = '117' ORDER BY date_created";
$statement = $conn->prepare($query);
$statement->execute();
$recipes = $statement->fetchAll();
//close the statement
$statement->closeCursor();



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
    <link rel="icon" href="images/recipeasy-icons-logos/Capture.png">
    <?php include_once 'includes/CDNs.php'; ?>




</head>

<body class='site'>

    <?php include_once 'includes/nav-menu.php'; ?>

    <div class="jumbotron jumbotron-fluid">
        <div class="container jumbo-title">
            <h1 class="display-4 jumbo-text">Find a Recipe</h1>
            <p class='jumbo-text' >This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>

         
            <form class="form-inline" method="post">
            <div class='row' >   
            <div class='col-lg-12' >
                <input class="form-control mr-sm-2" type="search" name="something" placeholder="Search" aria-label="Search" value="<?= isset($_POST['something']) ? htmlspecialchars($_POST['something']) : '' ?>"><br>
                </div>
                
                <div class='col-lg-12 jumbo-buttons' >
                <button class='btn btn-sm btn-light'  type="submit" name="submit" formaction = "recipes-list.php" >Click Me!</button> 
                <button class='btn btn-sm btn-light-invert' formaction = "random-recipe.php">Click Me!</button>
                </div>
            </div>
            </form>
           

            
        </div>
    </div>

    <main class='site-content'>
        <div class="container first-home-container">

            <div class="row">

                <div class="col-lg-12">
                    <h1 class="home-title1"> <span class="underline"> Our Features </span> </h1>
                    <!-- <hr class='home-hr1' align="left"> -->
                    <br> <br>

                    <div class="row">
                        <div class="col-lg-4 col-md-6 text-center icon-padding">
                            <img class='home-icons' src="images/recipeasy-icons-logos/burger.png">
                            <h3>Find Easy Recipes and Save them</h3>
                            <p>100's of simple and cheap to make recipes at your finger tips! </p>
                        </div>

                        <div class="col-lg-4 col-md-6 text-center icon-padding">
                            <img class='home-icons' src="images/recipeasy-icons-logos/fridge.png">
                            <h3>Whats in your fridge?</h3>
                            <p>Just put in the ingredient you have and find recipes you can make there and then</p>
                        </div>

                        <div class="col-lg-4 col-md-6 text-center icon-padding">
                            <img class='home-icons' src="images/recipeasy-icons-logos/platter.png">
                            <h3>Random Recipe Generator</h3>
                            <p>Want to find something new and exciting to cook?</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- <div class="col-md-12  second-home-container background-gal ">
        <div class='container '>

        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
            nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
            velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
            sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

        <p>Turpis tincidunt id aliquet risus feugiat in ante metus dictum. Habitant morbi tristique senectus et netus et. Enim neque
            volutpat ac tincidunt vitae. Donec ultrices tincidunt arcu non sodales neque. Vitae nunc sed velit dignissim
            sodales ut eu sem. Mauris vitae ultricies leo integer malesuada. Scelerisque eu ultrices vitae auctor eu augue ut
            lectus arcu. Purus non enim praesent elementum facilisis leo vel. Scelerisque varius morbi enim nunc faucibus a.
            Eu feugiat pretium nibh ipsum. </p>

        </div>
    </div> -->


        <div class='container third-home-container'>

            <div class="row">

                <div class="col-lg-12">
                    <h1 class="home-title1"> <span class="underline"> Latest Recipes</span></h1>
                    
                </div>
                <?php foreach ($recipes as $recipe) :

                ?>
                    <div class="col-lg-4 bottom-home ">

                        <div class="card home-card test-card">
                            <img src="images/recipes/<?php echo $recipe['image'];  ?>" class="card-img-top" alt='dish image' height='250' width='270'>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $recipe['name'];  ?></h5>
                                <p class="card-text">Easy to make and tatse delicious.</p>
                                <a href="recipe_single.php?recipe_ID=<?php echo $recipe['recipe_ID'] ?>" class="btn btn-light">More Info</a>
                            </div>
                        </div>

                    </div>

                <?php endforeach; ?>

            </div>
        </div>




    </main>




    <?php include_once 'includes/footer.php'; ?>






</body>

</html>