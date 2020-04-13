<!--
TEST COMMENT Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
require_once 'includes/database/connection.php';

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
	<title>Blogs</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="images/recipeasy-icons-logos/small-logo.png">
	<?php include_once 'includes/CDNs.php'; ?>
	<link href="includes/stylesheet.css" rel="stylesheet" type="text/css" />


</head>

<body class='site' >
	<?php include_once 'includes/nav-menu.php'; ?>
	<main class='site-content' >
	<div class="container">

		<!-- <div class='sub-menu'>
			<div style='text-align: right'>
				<ul class='diff-list' id='ul-difficulty-list'>
					<li class='li-diff-list'> <a href='add_blog.php'>Add New Post </a></li>
				</ul>
			</div>
		</div> -->




		<h1 class="allRecipes-h1"><span class="underline">Blogs</span></h1>


		<!-- <p><a href="add_blog.php"><button type="button" class="btn btn-light">New Blog Post</button></a></p> -->

		<div class='row'>
			<?php foreach ($blog as $blogs) { ?>
				<div class="col-lg-4 bottom-home ">
					<div class="hvr-shadow card home-card test-card">
						<div class="card-body">
							<h5 class="card-title"><?php echo $blogs['blogTitle']; ?></h5>
							<p class="card-text">To read more click</p>
							<a href="blog_single.php?blogId=<?php echo $blogs['blogId'] ?>"><button type="button" class="btn btn-light btn-sm">View Post</button></a>
						</div>
					</div>
				</div>
				<br>
			<?php } ?>
			<br> <br>
		</div>
	</div>

	<?php include_once 'includes/footer.php'; ?>
	</main>
</body>

</html>