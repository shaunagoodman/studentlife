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
        <title>FAQ</title>

        <?php include_once 'includes/CDNs.php'; ?> 

        <link href="includes/stylesheet.css" rel="stylesheet" type="text/css"/>



    </head>
    <body class='site' >
        <?php include_once 'includes/nav-menu.php'; ?>  

        <main class='site-content' >
        <div class="container" >

            <div class="row" >

                

                    <h1 class="faq-heading" ><span class="underline">Frequently Asked Questions</span></h1>
                


                <div class="col-lg-12 accordion-section ">


                    <div id="accordion">
                        <div class="card faq-card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link stretched-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <i class="fas fa-search"></i> How do I find a recipe? 
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                    <p class="faq-p" > You can use our "What's in your fridge?" feauture to search by certain ingredients, or you can search by recipe name too!
                                    <br> Go to the recipe section to start!</p>
                                </div>
                            </div>
                        </div>
                        
                        <br>
                        
                        <div class="card faq-card">
                            <div class="card-header" id="headingTwo">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed stretched-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <i class="fas fa-cog"></i> How do I create an account?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body">
                                   <p class="faq-p" > You can create an account by clicking on the "Login" dropdown in the menu and then clicking on 
                                   register. Then enter your name, email and password - click "Register" and you're done!  </p>
                                </div>
                            </div>
                        </div>
                        
                        <br>
                        
                        <div class="card faq-card">
                            <div class="card-header" id="headingThree">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed stretched-link" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <i class="far fa-paper-plane"></i>  I have a question! How can I contact Recipeasy?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                <div class="card-body">
                                    <p class="faq-p" > Easy! You can contact us by visiting our Contact Us page which is linked at the bottom of the website. 
                                    Just fill out the contact form and we'll get back to you ASAP!  </p>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="card faq-card">
                            <div class="card-header" id="headingFour">
                                <h5 class="mb-0">
                                    <button class="btn btn-link stretched-link" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                    <i class="fas fa-utensils"></i> What is Potluck?
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                                <div class="card-body">
                                    <p class="faq-p" > Potluck is a feature of the website you can use when you're not sure what to cook! 
                                    <br> It will generate a random recipe from our extensive database, and the possibilities are endless! <br>
                                    If you see one you like, you can then add it to your favourites using the heart shaped button underneath the recipe!</p>
                                </div>
                            </div>
                        </div>
                        
                        <br>
                        
                        <div class="card faq-card">
                            <div class="card-header" id="headingFive">
                                <h5 class="mb-0">
                                    <button class="btn btn-link stretched-link" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                    <i class="fas fa-pen-square"></i> How can I create my own recipe?
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                                <div class="card-body">
                                    <p class="faq-p" > First you have to log in. If you don't have an account you can register under the login tab.<br>
                                    Once you're logged in, you can create a recipe by following the link on your profile page. <br>
                                    When you can to the add recipe page, enter in all of the details of your recipe, including name, ingredients, steps, servings, max time and image!
                                    <br> Once you're done click the submit button. You will then find your recipe on your profile page and on the all recipes page. 
                
                                </div>
                            </div>
                        </div>
                        
                        <br>
                        
                        <div class="card faq-card">
                            <div class="card-header" id="headingSix">
                                <h5 class="mb-0">
                                    <button class="btn btn-link stretched-link" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                                    <i class="fas fa-heart"></i> How do I add a recipe to my favourites?
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                                <div class="card-body">
                                    <p class="faq-p" > First you have to log in. Then under your recipe of choice you should see an orange heart shaped button. Click it and you will be told with an alert that it has been added to your favourites. <br>
                                    You will then be brought to your favourites page where you can see all your favourite recipes!
                
                                </div>
                            </div>
                        </div>
                        
                        <br>
                        
                    
                        
                        
                        
                    </div>



                </div>

            </div>


        </div>

        </main>


        <?php include_once 'includes/footer.php'; ?>






    </body>
</html>
