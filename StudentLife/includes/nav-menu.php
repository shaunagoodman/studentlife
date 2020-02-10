<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>
    <meta charset="UTF-8">
    <title></title>




    <?php include_once 'CDNs.php'; ?>

    <link href="niamh.css" rel="stylesheet" type="text/css" />

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400&display=swap" rel="stylesheet">


</head>

<body>


    <nav class="navbar navbar-expand-lg navbar-light ">

        <a class="navbar-brand" href="index.php"><img src="images/recipeasy-icons-logos/recipeasy-logo-2.png" class="d-inline-block align-top" alt="" /> </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <img class="burger-icon" src="images/recipeasy-icons-logos/burger-menu.png" alt="" />
        </button>

        <div id="navbarNavDropdown" class="navbar-collapse collapse">
            <ul class="navbar-nav mr-auto">
                <!--   ignore this space-->

            </ul>
            <ul class="navbar-nav nav-set">
                <li class="nav-hover nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class=" nav-hover nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   Recipes </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">

                        <a class="dropdown-item" href="recipes-list.php">All Recipes</a>
                        <a class="dropdown-item" href="recipe-api.php">Whats in my fridge?</a>

                    </div>
                </li>


                <li class=" nav-hover nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php
                        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {

                            echo "Profile";
                        } else {
                            echo "Login";
                        }
                        ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">




                        <?php
                        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {

                            echo '<a class="dropdown-item" href="profile.php">View Profile</a>';
                            echo '<a class="dropdown-item" href="logout.php">Logout</a>';
                        } else {
                            echo '<a class="dropdown-item" href="login.php">Login</a>';
                            echo '<a class="dropdown-item" href="staffLogin.php">Staff Login</a>';
                            echo '<a class="dropdown-item" href="sign-up.php">Register</a>';
                        }
                        ?>
                    </div>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" method="post" action="recipe-search.php">
                <input class="form-control mr-sm-2" type="search" name = "something"placeholder="Search" aria-label="Search" value="<?= isset($_POST['something']) ? htmlspecialchars($_POST['something']) : '' ?>">
                <button class="btn my-2 my-sm-0" type="submit" name = "submit"> <img src="images/recipeasy-icons-logos/white-search.png" class="d-inline-block align-top" alt="" /></button>
            </form> 
        </div>
    </nav>
</body>
</html>