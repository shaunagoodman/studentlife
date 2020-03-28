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

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400&display=swap" rel="stylesheet">


</head>

<body>

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