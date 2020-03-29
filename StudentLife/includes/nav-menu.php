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
    <script src="javascript/example.js"></script>
    <?php include_once 'CDNs.php'; ?>

    <link href="niamh.css" rel="stylesheet" type="text/css" />

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400&display=swap" rel="stylesheet">
    <script src="javascript/nav.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="javascript/search-toggle.js"></script>



</head>

<body>

<style>


nav {
  background-color: #EF7823 !important;
  /* padding-bottom: 10% */
}

/* .form-inline{
    width: 100px;
} */
</style>


<!-- <script>

$('button').click(function(){
    $('input').animate({width: 'toggle'});
});

</script> -->


    <nav id="navbar" class="navbar navbar-expand-lg navbar-light desktopNav">
        <a class="navbar-brand" href="index.php"><img src="images/recipeasy-icons-logos/new-logo-white.png" class="d-inline-block align-top" alt="recipeasy-logo" style='width:100%' /> </a>
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

                <li class="nav-hover nav-item">
                    <a class="nav-link" href="recipes-list.php">Recipes</a>
                </li>

                <li class="nav-hover nav-item">
                    <a class="nav-link" href="recipe-api.php">Whats in my fridge?</a>
                </li>

                
                <!-- <li class=" nav-hover nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Recipes </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">

                        <a class="dropdown-item" href="recipes-list.php">All Recipes</a>
                        <a class="dropdown-item" href="recipe-api.php">Whats in my fridge?</a>
                        <a class="dropdown-item" href="random-recipe.php">Random Recipe Generator</a>

                    </div>
                </li> -->




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

                            echo '<a class="dropdown-item" href="admin.php">View Profile</a>';
                            echo '<a class="dropdown-item" href="logout.php">Logout</a>';
                        } else {
                            echo '<a class="dropdown-item" href="login.php">Login</a>';
                            echo '<a class="dropdown-item" href="sign-up.php">Register</a>';
                        }
                        ?>
                    </div>
                </li>
            </ul>

            <div class="box" >
            <form class="form-inline my-2 my-lg-0 " method="post" action="recipes-list.php">
                <input class="form-control mr-sm-2" type="search" name="something" placeholder="Search" aria-label="Search" value="<?= isset($_POST['something']) ? htmlspecialchars($_POST['something']) : '' ?>">
                <button style="visibility: hidden;" type="submit" name="submit"></button>
            </form>
            </div>
            <button class="btn my-2 my-sm-0 slide-toggle"> <img src="images/recipeasy-icons-logos/white-search.png" class="d-inline-block align-top" alt="" /></button>
        </div>
    </nav>




<!-- MOBILE NAV MENU -->

<nav class='mobileNav'>
        <div class="header"></div>
        <input type="checkbox" class="openSidebarMenu" id="openSidebarMenu">
        <label for="openSidebarMenu" class="sidebarIconToggle">
            <div class="spinner diagonal part-1"></div>
            <div class="spinner horizontal"></div>
            <div class="spinner diagonal part-2"></div>
        </label>
        <div id="sidebarMenu">
        <ul class="sidebarMenuInner">
            <li>
                <form class="form-inline my-2 my-lg-0" method="post" action="recipes-list.php">
                <input class="form-control mr-sm-2" type="search" name="something" placeholder="Search" aria-label="Search" value="<?= isset($_POST['something']) ? htmlspecialchars($_POST['something']) : '' ?>">
                <button class="btn my-2 my-sm-0" type="submit" name="submit"> </button>
            </form>
                </li>
                <li> <img width="10%" src="images/recipeasy-icons-logos/home.png"> <a href="index.php">Home</a></li>
                <li> <img width="10%" src="images/recipeasy-icons-logos/recipes.png"> <a href="recipes-list.php">All Recipes</a></li>
                <li> <img width="10%" src="images/recipeasy-icons-logos/question.png"> <a href="recipe-api.php">Whats in my fridge?</a></li>

                <li>
                    <?php
                    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {

                        echo ' <img width="10%" src="images/recipeasy-icons-logos/profile.png"> <a  href="admin.php">View Profile</a>';
                    } else {
                        echo ' <img width="10%" src="images/recipeasy-icons-logos/login.png"> <a href="login.php">Login</a>';
                    }
                    ?>
                </li>

                <li>
                    <?php
                    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {

                        echo ' <img width="10%" src="images/recipeasy-icons-logos/logout.png"> <a  href="logout.php">Logout</a>';
                    } else {
                        echo ' <img width="10%" src="images/recipeasy-icons-logos/profile.png"> <a href="sign-up.php">Register</a>';
                    }
                    ?>
                </li>

                

            </ul>
        </div>
    </nav>












</body>

</html>