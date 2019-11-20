<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Profile</title>

        <?php include_once 'includes/CDNs.php'; ?> 

        <link href="includes/stylesheet.css" rel="stylesheet" type="text/css"/>



    </head>
    <body>

        <?php include_once 'includes/nav-menu.php'; ?>  
        <div class="profile-body">

            <div class="container desktop-profile" >

                <div class="row" >

                    <div class="col-lg-12" >
                        <center>   <h1 class="profile-title1" > Welcome, (name)</h1> </center>


                    </div>


                    <div class="col-lg-6 " >

                        <div class="user-info profile-user-info" >

                            <h2 class="user-name" >Emma Byrne</h2>
                            <hr>
                            <h5>Email:</h5>
                            <p>name@gmail.com</p>

                            <h5>College</h5>
                            <p>Dundalk Institute of Technology</p>

                            <h5>Location:</h5>
                            <p>Dundalk, Co.Louth</p>
                        </div>


                    </div>

                    <div class="col-lg-6" >

                        <div class="user-info profile-buttons calendar-button" >

                            <h2 class="my-calendar" >My Calendar</h2>
                        </div>

                        <br>

                        <div class="user-info profile-buttons budget-button" >
                            <h2 class="my-budget" >My Budget</h2>
                        </div>

                        <br>

                        <div class="user-info profile-buttons recipe-button" >  
                            <h2 class="recipes" >Recipes</h2>
                        </div>

                    </div>

                </div>


                <div class="row">

                    <div class="col-lg-6" >

                        <div class="user-info fave-info" >

                            <h2 class="user-name" >Favourites</h2>
                            <hr>

                            <img src="images/spaghetti.PNG" width="35%" alt=""/> <p> Spaghetti Bolognese </p>

                        </div>


                    </div>

                </div>


            </div>


            <!--        -------------------    MOBILE VERSION ------------------------ -->

            <div class="container mobile-profile" >

                <div class="row" >



                    <div class="col-md-12 " >

                        <div class="user-info profile-user-info" >

                            <h2 class="user-name" >Emmaaaaaaaa Byrne</h2>
                            <hr>
                            <center class="mobile-profile-info">

                                <h5>Email:</h5>
                                <p>name@gmail.com</p>

                                <h5>College</h5>
                                <p>Dundalk Institute of Technology</p>

                                <h5>Location:</h5>
                                <p>Dundalk, Co.Louth</p>
                        
                        </center>
                        </div>
                    </div>

                   
                </div>


                <div class="row">

                    <div class="col-lg-6" >

                        <div class="user-info fave-info" >

                            <h2 class="fave-title" >Favourites</h2>
                            <hr>

                            <img src="images/spaghetti.PNG" width="35%" alt=""/> <p> Spaghetti Bolognese </p>

                        </div>


                    </div>

                    
                    
                    <div class="col-md-12" >

                        <div class="user-info profile-buttons calendar-button" >

                            <h2 class="my-calendar" >My Calendar</h2>
                        </div>

                        <br>

                        <div class="user-info profile-buttons budget-button" >
                            <h2 class="my-budget" >My Budget</h2>
                        </div>

                        <br>

                        <div class="user-info profile-buttons recipe-button" >  
                            <h2 class="recipes" >Recipes</h2>
                        </div>

                    </div>
                    
                    
                    
                    
                    
                </div>


            </div> 

            <br>








        </div>





        <?php include_once 'includes/footer.php'; ?>






    </body>
</html>
