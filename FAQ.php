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
    <body>
        <?php include_once 'includes/nav-menu.php'; ?>  


        <div class="container" >

            <div class="row" >

                <div class="col-lg-12" >

                    <h1 class="faq-heading" >Frequently Asked Questions</h1>
                    <hr class="faq-line" >
                </div>


                <div class="col-lg-12 accordion-section ">


                    <div id="accordion">
                        <div class="card faq-card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        How do I find a recipe? 
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
                                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                     How do I create an account?
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
                                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                       I have a question! How can I contact Recipeasy?
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
                        
                    
                        
                        
                        
                    </div>



                </div>

            </div>


        </div>




        <?php include_once 'includes/footer.php'; ?>






    </body>
</html>
