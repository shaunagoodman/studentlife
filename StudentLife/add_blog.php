<?php
session_start();
require_once "includes/database/connection.php";

// Define variables and initialize with empty values
$blogTitle = $blogContent = "";
$title_err = $content_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if (isset($_POST['submit'])) {
		echo "Hello";
		//Validate Blog Title	
		$input_title = $_POST["blogTitle"];

		if(empty($input_title)) {
			$title_err = "Please Enter Title For Your Blog.";
		} else{
			$blogTitle = $input_title;
		}

		// Validate Blog Content
		$input_content = $_POST["blogContent"];
		if(empty($input_content)) {
			$content_err = "Please Enter Your Blog Content.";
		} else{
			$blogContent = $input_content;
		}

		/******************** Add to Blog table ************************/
		if(empty($title_err) && empty($content_err)){
			$query = "INSERT INTO blog (blodId, blogTitle, blogContent) VALUES (null, '$blogTitle', '$blogContent')";
			if($statement = $conn->prepare($query)){
				$statement->bindParam(":blogTitle", $blogTitle);
				$statement->bindParam(":blogContent", $blogContent);
			if($statement->execute()) {
				echo "sent";
			}
			$statement->fetchAll();
			$statement->closeCursor();
			}
		}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Post Blog</title>
    <script src="javascript/scripts.js"></script>
    <?php include_once 'includes/CDNs.php'; ?>
</head>

<body>
<?php include_once 'includes/nav-menu.php'; ?>

<h2>Post New Blog</h2>

<form class = "blog-form" enctype="multipart/form-data" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

<div class = "form-group <?php echo (!empty($title_err)) ? 'has-error' : ''; ?>">
<label>Title</label>
	<input type="text" name="blogTitle" class="form-control">
	<span class="help-block"><?php echo $title_err;?></span>
</div>

<div class = "form-group <?php echo (!empty($content_err)) ? 'has-error' : ''; ?>">
<label>Content</label>
	<input type="text" name="blogContent" class="form-control">
	<span class="help-block"><?php echo $content_err;?></span>
</div>

<input type="submit" class="btn btn-primary" value="Submit">
<a href="show-all-recipes.php" class="btn btn-default">Cancel</a>
    </form>
	
	    <?php include_once 'includes/footer.php'; ?>


</body>
</html>