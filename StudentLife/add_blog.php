<?php
session_start();
require_once "includes/database/connection.php";
if (!isset($_SESSION["loggedin"]) ||  $_SESSION["u_type"] == 0) {
	header("location: login.php");
    exit;
}

include_once 'includes/database/addBlog.php'; 
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Post Blog</title>
	<link rel="icon" href="images/recipeasy-icons-logos/small-logo.png">
	<?php include_once 'includes/CDNs.php'; ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class='site' >
	<?php include_once 'includes/nav-menu.php'; ?>
	<main class='site-content' >
	<div class='container'>

		<h2 class="allRecipes-h1"><span class="underline">Post New Blog</span></h2>

		<form class="login-form" enctype="multipart/form-data" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

			<div class="form-group <?php echo (!empty($title_err)) ? 'has-error' : ''; ?>">
				<p class='add-blog-title' >Title fo you Blog Post</p>
				<input class='blog-post-title' type="text" name="blogTitle" class="form-control">
				<span class="help-block"><?php echo $title_err; ?></span>
			</div>

			<div class="form-group <?php echo (!empty($content_err)) ? 'has-error' : ''; ?>">
				<p class='add-blog-content-title' >Blog Post Content</p>
				<textarea class='blog-post' type="text" name="blogContent" class="form-control"> </textarea>
				<span class="help-block"><?php echo $content_err; ?></span>
			</div>

			<input type="hidden" name="blogId" value="<?php echo $id; ?>" />
			<input type="submit" class="btn btn-light btn-sm" name="submitBlog" value="Submit">
			<a href=".php" class="btn btn-light-invert btn-sm">Cancel</a>
		</form>
		<br> <br>
	</div>
	</main>
	<?php include_once 'includes/footer.php'; ?>


</body>

</html>