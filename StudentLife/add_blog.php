<?php
session_start();
require_once "includes/database/connection.php";

// Define variables and initialize with empty values
$blogTitle = $blogContent = "";
$title_err = $content_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if (isset($_POST['submit'])) {
		//echo "Hello";
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
		if(!empty($input_title) && !empty($input_content)){
			// echo "INSERT INTO blog (blogId, blogTitle, blogContent) VALUES (null, $blogTitle, $blogContent)";
			$query = "INSERT INTO blog (blogId, blogTitle, blogContent) VALUES (null, :blogTitle, :blogContent)";
			if($stmt = $conn->prepare($query)){
				$stmt->bindParam(":blogTitle", $blogTitle);
				$stmt->bindParam(":blogContent", $blogContent);
			
				// $param_ingredient_name = $ingredient_name;
				// $param_ingredient_measure = $ingredient_measure;
				// $param_ingredient_unit = $ingredient_unit;
			
			
			if($stmt->execute()) {
				//echo "sent";
			}
			else {
				echo "Something went wrong. Please try again later.";
			}
			$stmt->closeCursor();
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
<div class='container' >
<h2 class="allRecipes-h1" >Post New Blog</h2>
<hr align="left">

<form class = "login-form" enctype="multipart/form-data" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

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

<input type="hidden" name="blogId" value="<?php echo $id; ?>" />
        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
        <a href=".php" class="btn btn-default">Cancel</a>
    </form>
	</div>
	    <?php include_once 'includes/footer.php'; ?>


</body>
</html>