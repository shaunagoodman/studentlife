<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
} elseif (!isset($_SESSION["u_type"]) || $_SESSION["u_type"] != 1) {
    header("location: profile.php");
    exit;
}


require_once 'includes/database/connection.php';

try {
    $userID = $_SESSION['user_ID'];
    $query = "SELECT * FROM recipes WHERE user_ID = $userID";
    $statement2 = $conn->prepare($query);
    $statement2->bindValue(":userID", $userID);
    $statement2->execute();
    $recipes = $statement2->fetchAll();
    $statement2->closeCursor();
} catch (Exception $ex) {
    $errorMessage = $e->getMessage();
    echo $errorMessage;
    exit();
}

$query = "SELECT * FROM blog";
$statement = $conn->prepare($query);
$statement->execute();
$blog = $statement->fetchAll();
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
    <title>Profile</title>

    <?php include_once 'includes/CDNs.php'; ?>

   



</head>

<body class='site'>

    <?php include_once 'includes/nav-menu.php'; ?>
    <main class='site-content'>
        <div class="profile-body desktop-profile">

            <div class="container desktop-profile">

                <div class="row">

                    <div class="col-lg-12">

                    </div>


                    <div class="col-lg-6 user-col ">

                        <div class="user-info profile-user-info">

                            <h2 class="user-name"><span class="underline"><?php echo $_SESSION["fname"] . " " . $_SESSION["lname"]; ?></span></h2>

                            <hr>
                            <h5 class="h5-profile">Email:</h5>

                            <p><?php echo htmlspecialchars($_SESSION["u_email"]); ?></p>

                            <a href="edit_details.php" class="btn btn-light btn-sm">Edit Profile</a>

                            <a href="reset_password.php" class="btn btn-light btn-sm">Reset Password</a>


                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>




        <div class="container div-button desktop-profile">

            <div class='sub-menu'>
                <div style='text-align: right'>
                    <ul class='diff-list' id='ul-difficulty-list'>
                        <li class='li-diff-list'> <a href='add_blog.php'>Add New Post </a></li>
                        <li class='li-diff-list'><a href='view-recipes-admin.php'>View All Recipes </a></li>
                        <li class='li-diff-list'><a href='view-all-users.php'>View All Users </a></li>
                        <li class='li-diff-list'><a href='show-all-recipes.php'>View All Your Recipes </a></li>
                        <li class='li-diff-list'><a href='favourites.php'>View Favourites </a></li>
                        <li class='li-diff-list'><a href='add-recipe.php'>Create a Recipes </a></li>
                    </ul>
                </div>
            </div>
</div>
            <!-- <div class="row">

                <div class="col-lg-6 ">
                    <div class="user-info profile-buttons favourites-button">
                        <h2><a href="favourites.php" class="recipes my-favourites">Favourites</a></h2>
                    </div>
                </div>



                <div class="col-lg-6">
                    <div class="user-info profile-buttons recipe-button">
                        <h2><a href="show-all-recipes.php" class="recipes">Recipes</a></h2>
                    </div>
                </div>
            </div> -->


        <div class="container-fluid desktop-profile">
		<div class="row">
			<div class="col-sm-12">
				<div id="inam" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">



						<?php
						$count = 1;



						//get the results from the $recipes variable(using a loop)

						echo "<div class='carousel-item active'>";
						echo "<div class='container'>";
						echo "<div class='row' >";

						foreach ($recipes as $recipe) :
							if ($count % 3 == 1 && $count != 1) {
								echo "<div class='carousel-item'>";
								echo "<div class='container'>";
								echo "<div class='row' >";
							}
							if ($recipe['difficultyID'] == 1) {

								$difficulty = "Easy";
							} else if ($recipe['difficultyID'] == 2) {

								$difficulty = "Medium";
							} else if ($recipe['difficultyID'] == 3) {

								$difficulty = "Hard";
							} else {

								$difficulty = "No difficulty selected.";
							}
							if (empty($recipe['image'])) {

								$recipe['image'] = "images/recipes/placeholder.png";
							}
							if ($recipe['isAPI'] == 1) {

								$src = $recipe['image'];
							} else {

								$src = 'images/recipes/' . $recipe['image'];
							}
						?>

							<!-- DISPLAY SECTION ONE -->

							<div class="col-sm-12 col-lg-4">
								<div class="card home-card recipe-page-card">
									<img src="<?php echo $src; ?>" class="card-img-top" alt='dish image' height='315' width='328'>
									<div class="card-body">
										<h5 class="card-title"><?php echo $recipe['name']; ?></h5>
										<p class="card-text" class='recipe-difficulty'> Difficulty: <?php echo $difficulty; ?> </p>
										<p class="card-text" class='recipe-time'> <img src='images/recipeasy-icons-logos/clock.png' style='margin-bottom:0.3%' alt='clock icon' height='25' width='25'> Time: <?php echo $recipe['maxTime']; ?>
										</p>
										<center><a href="recipe_single.php?recipe_ID=<?php echo $recipe['recipe_ID'] ?>"><button type="button" class="btn btn-light">View Recipe</button></a> </center>
									</div>
								</div>
							</div>
						<?php
							// end the divs after every 3rd recipe
							if ($count % 3 == 0) {

								echo "</div>";
								echo "</div>";
								echo "</div>";
							}

							$count++;

						endforeach;

						echo "</div>";
						echo "</div>";
						echo "</div>";
						?>

					</div>
					<a href="#inam" class="carousel-control-prev" data-slide="prev">
						<span class="carousel-control-prev-icon"></span>
					</a>

					<a href="#inam" class="carousel-control-next" data-slide="next">
						<span class="carousel-control-next-icon"></span>
					</a>
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

                            <h2 class="user-name"><?php echo $_SESSION["fname"] . " " . $_SESSION["lname"]; ?></h2>
                            <hr>
                            <center class="mobile-profile-info">

                                <h5 class="h5-profile">Email:</h5>
                                <p><?php echo htmlspecialchars($_SESSION["u_email"]); ?></p>

                                <a href="edit_details.php" class="btn btn-light btn-sm">Edit Profile</a>

                                <a href="reset_password.php" class="btn btn-light btn-sm">Reset Password</a>

                            </center>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="container mobile-profile">

            <div class='sub-menu'>
                <div style='text-align: right'>
                    <ul class='diff-list' id='ul-difficulty-list'>
                        <li class='li-diff-list'> <a href='add_blog.php'>Add New Post </a></li>
                        <li class='li-diff-list'><a href='recipes-list.php'>View All Recipes </a></li>
                        <li class='li-diff-list'><a href='how-all-recipes.php.php'>All My Recipes </a></li>
                        <li class='li-diff-list'><a href='favourites.php'>View All Favourites </a></li>
                        <li class='li-diff-list'><a href='view-all-users.php'>View All Users </a></li>
                    </ul>
                </div>
            </div>

        </div>

        <br>

        </div>

    </main>



    <?php include_once 'includes/footer.php'; ?>






</body>

</html>