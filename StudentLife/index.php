<?php
// Initialize the session
session_start();
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
                    <h3 class="h3-responsive">Simple Spaghetti</h3>
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
                    <h3 class="h3-responsive">Classic Pizza</h3>
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
                    <h3 class="h3-responsive">Tasty Noodles</h3>
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


    <div class="container">

        <div class="row">

            <div class="col-lg-12">
                <h1 class="home-title1"> What We Do</h1>
                <hr align="left">
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

              
                <div class="row">

                    <div class="col-lg-12">
                        <h1 class="home-title1"> New Recipes</h1>
                        <hr align="left">
                    </div>

                    <div class="col-lg-4 bottom-home ">

                        <div class="card home-card" >
                            <img src="images/recipes/wrap.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Chicken Wrap</h5>
                                <p class="card-text">Easy to make and tatse delicious.</p>
                                <a href="#" class="btn btn-light">More Info</a>
                            </div>
                        </div>

                    </div>


                    <div class="col-lg-4 bottom-home ">

                        <div class="card home-card" >
                            <img src="images/recipes/protein-pan.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Protein Pancakes</h5>
                                <p class="card-text">Simple to make and healthy too!</p>
                                <a href="#" class="btn btn-light">More Info</a>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-4  bottom-home">

                        <div class="card home-card">
                            <img src="images/recipes/spaghetti.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Simple Spaghetti</h5>
                                <p class="card-text">A classic Italian dish made easy</p>
                                <a href="#" class="btn btn-light">More Info</a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>





    <?php include_once 'includes/footer.php'; ?>






</body>

</html>