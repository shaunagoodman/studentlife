<?php


// Initialize the session
session_start();


// Include config file
require_once "includes/database/connection.php";
$query = "SELECT * FROM recipes r INNER JOIN user u ON u.user_ID = r.user_ID WHERE u.u_type = 1 ORDER BY date_created limit 4";
$statement = $conn->prepare($query);
$statement->execute();
$recipes = $statement->fetchAll();
//close the statement
$statement->closeCursor();



?>




<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="icon" href="images/recipeasy-icons-logos/Capture.png">
    <?php include_once 'includes/CDNs.php'; ?>




</head>

<body class='site'>

<?php include_once 'includes/mobile-nav.php'; ?>
    

    <div class="jumbotron jumbotron-fluid">
        <?php include_once 'includes/index-nav.php'; ?>
        <div class="container jumbo-title">
            <h1 class="display-4 jumbo-text">Find a Recipe</h1>
            <h4 class='jumbo-text' >Or try our Pot Luck!</h4>
            <form class="form-inline" method="post" action="">
            <div class='row' >   
            <div class='col-lg-12' >
                <input class="form-control mr-sm-2" type="search" name="something" placeholder="Search" aria-label="Search" value="<?= isset($_POST['something']) ? htmlspecialchars($_POST['something']) : '' ?>"><br>
                </div>
                
                <div class='col-lg-12 jumbo-buttons' >
                <button class='btn btn-sm btn-light'formaction = "recipes-list.php" >Find</button>
                <button class='btn btn-sm btn-light-invert'  formaction = "random-recipe.php" type="submit" name="submit" >Pot Luck?</button>
                
                </div>
            </div>
            <div id="startchange"></div>
            </form>  
        </div>
    </div>
    

    <main class='site-content'>
        <div class="container first-home-container " >

            <div class="row">

                <div class="col-lg-12">
                    <h1 class="home-title1"> <span class="underline"> Our Features </span> </h1>
                    <!-- <hr class='home-hr1' align="left"> -->
                    <br> <br>

                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 text-center icon-padding">
                            <img class='home-icons' src="images/recipeasy-icons-logos/burger.png">
                            <h3>Find Easy Recipes and Save them</h3>
                            <p>100's of simple and cheap to make recipes at your finger tips! </p>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12 text-center icon-padding">
                            <img class='home-icons' src="images/recipeasy-icons-logos/fridge.png">
                            <h3>Whats in your fridge?</h3>
                            <p>Just put in the ingredient you have and find recipes you can make there and then</p>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12 text-center icon-padding">
                            <img class='home-icons' src="images/recipeasy-icons-logos/platter.png">
                            <h3>Random Recipe Generator</h3>
                            <p>Want to find something new and exciting to cook?</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class='container third-home-container'>

            <div class="row">

                <div class="col-lg-12">
                    <h1 class="home-title1"> <span class="underline"> Latest Recipes</span></h1>
                    
                </div>
                <?php foreach ($recipes as $recipe) :
                ?>

                    <div class="col-lg-3 col-md-6 bottom-home ">

                        <div class="card home-card test-card hvr-shadow">

                            <img src="images/recipes/<?php echo $recipe['image'];  ?>" class="card-img-top" alt='dish image' height='250' width='270'>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $recipe['name'];  ?></h5>
                                <p class="card-text">Easy to make and tatse delicious.</p>
                                <a href="recipe_single.php?recipe_ID=<?php echo $recipe['recipe_ID'] ?>" class="btn btn-light stretched-link">More Info</a>
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