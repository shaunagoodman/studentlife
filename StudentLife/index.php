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

<body>
    <?php include_once 'includes/nav-menu.php'; ?>


    <!--Carousel Wrapper-->
    <div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel">
        <!--Indicators-->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-2" data-slide-to="1"></li>
            <li data-target="#carousel-example-2" data-slide-to="2"></li>
        </ol>
        <!--/.Indicators-->
        <!--Slides-->
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <div class="view">
                    <img class="d-block w-100" src="images/backgrounds/spag2.jpg" alt="First slide">
                    <div class="mask rgba-black-light"></div>
                </div>
                <div class="carousel-caption">
                    <h3 class="h3-responsive"> <a class='carousel-recipe' href='recipes-list.php'> Simple Spaghetti </a> </h3>
                    <p>Find out more here!</p>
                </div>
            </div>
            <div class="carousel-item">
                <!--Mask color-->
                <div class="view">
                    <img class="d-block w-100" src="images/backgrounds/pizza.jpg" alt="Second slide">
                    <div class="mask rgba-black-strong"></div>
                </div>
                <div class="carousel-caption">
                    <h3 class="h3-responsive"><a class='carousel-recipe' href='recipes-list.php'>Classic Pizza</a></h3>
                    <p>Find out more here!</p>
                </div>
            </div>
            <div class="carousel-item">
                <!--Mask color-->
                <div class="view">
                    <img class="d-block w-100" src="images/backgrounds/noodles-1.jpg" alt="Third slide">
                    <div class="mask rgba-black-slight"></div>
                </div>
                <div class="carousel-caption">
                    <h3 class="h3-responsive"> <a class='carousel-recipe' href='recipes-list.php'>Tasty Noodles</a></h3>
                    <p>Find out more here!</p>
                </div>
            </div>
        </div>
        <!--/.Slides-->
        <!--Controls-->
        <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        <!--/.Controls-->
    </div>
    <!--/.Carousel Wrapper-->


    <div class="container first-home-container">

        <div class="row">

            <div class="col-lg-12">
                <h1 class="home-title1"> Our Features</h1>
                <hr align="left">
                <br> <br>

                <div class="row">
                    <div class="col-lg-4 col-md-6 text-center icon-padding">
                        <img class='home-icons' src="images/recipeasy-icons-logos/burger.png" >
                            <h3>Find Easy and Save Recipes</h3>
                            <p>100's of simple and cheap to make recipes at your finger tips! </p>
                    </div>

                    <div class="col-lg-4 col-md-6 text-center icon-padding">
                        <img class='home-icons' src="images/recipeasy-icons-logos/fridge.png"  >
                            <h3>Whats in your fridge?</h3>
                            <p>Just put in the ingredient you have and find recipes you can make there and then</p>   
                    </div>

                    <div class="col-lg-4 col-md-6 text-center icon-padding">
                            <img class='home-icons' src="images/recipeasy-icons-logos/platter.png"  >
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
                    <h1 class="home-title1"> Latest Recipes</h1>
                    <hr align="left">
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
    
    







    <?php include_once 'includes/footer.php'; ?>






</body>

</html>