<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
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
    <title>Profile</title>

    <?php include_once 'includes/CDNs.php'; ?>

    <link href="includes/stylesheet.css" rel="stylesheet" type="text/css" />



</head>

<body>

    <?php include_once 'includes/nav-menu.php'; ?>
    <div class="profile-body desktop-profile">

        <div class="container desktop-profile">

            <div class="row">

                <div class="col-lg-12">
                    <center>
                        <h1 class="profile-title1"> Welcome,<?php echo $_SESSION["fname"]["lname"]; ?></h1>
                    </center>
                </div>


                <div class="col-lg-6 user-col ">

                    <div class="user-info profile-user-info">

                        <h2 class="user-name"><?php echo ($_SESSION["fname"]["lname"]); ?></h2>
                        <hr>
                        <h5 class="h5-profile">Email:</h5>
                        <p><?php echo htmlspecialchars($_SESSION["u_email"]); ?></p>

                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>




    <div class="container div-button desktop-profile">

        <div class="row">

            <div class="col-lg-4">
                <div class="user-info profile-buttons favourites-button">
                    <h2 class="my-favourites">Favourites</h2>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="user-info profile-buttons budget-button">
                    <h2 class="my-budget">My Budget</h2>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="user-info profile-buttons recipe-button">
                    <h2 class="recipes">My Recipes</h2>
                </div>
            </div>

        </div>
    </div>
    </div>




    </div>


    <!--        -------------------    MOBILE VERSION ------------------------ -->
    <div class="profile-body mobile-profile">

        <div class="container mobile-profile">

            <div class="row">

                <div class="col-md-12 ">

                    <div class="user-info profile-user-info">

                        <h2 class="user-name">Emmaaaaaaaa Byrne</h2>
                        <hr>
                        <center class="mobile-profile-info">

                            <h5 class="h5-profile">Email:</h5>
                            <p><?php echo htmlspecialchars($_SESSION["u_email"]); ?></p>

                        </center>
                    </div>
                </div>

            </div>
        </div>
        </div>

        <div class="container mobile-profile">

        <div class="row">

            <div class="col-md-12">

                <div class="user-info profile-buttons favourites-button">

                    <h2 class="my-favourites">My Calendar</h2>
                </div>

                <br>

                <div class="user-info profile-buttons budget-button">
                    <h2 class="my-budget">My Budget</h2>
                </div>

                <br>

                <div class="user-info profile-buttons recipe-button">
                    <h2 class="recipes">Recipes</h2>
                </div>

            </div>


        </div>


        </div>


    

    <br>








    </div>





    <?php include_once 'includes/footer.php'; ?>






</body>

</html>