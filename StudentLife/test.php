<?php
// Initialize the session
session_start();
require_once 'includes/database/connection.php';
if (isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true) {
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
} else {
	header("location: login.php");
	exit;
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Profile</title>

	<?php include_once 'includes/CDNs.php'; ?>
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script> -->

</head>

<body style="background-color: #b9d0dd;">

	<?php include_once 'includes/nav-menu.php'; ?>


	<div class="container-fluid">
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
</body>

</html>