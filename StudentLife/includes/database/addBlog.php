<?php
// Define variables and initialize with empty values
$blogTitle = $blogContent = "";
$title_err = $content_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['submitBlog'])) {
		$input_title = $_POST["blogTitle"];
		if (empty($input_title)) {
			$title_err = "Please Enter Title For Your Blog.";
		} else {
			$blogTitle = $input_title;
		}

		// Validate Blog Content
		$input_content = $_POST["blogContent"];
		if (empty($input_content)) {
			$content_err = "Please Enter Your Blog Content.";
		} else {
			$blogContent = $input_content;
		}

		/******************** Add to Blog table ************************/
		if (!empty($input_title) && !empty($input_content)) {
			// echo "INSERT INTO blog (blogId, blogTitle, blogContent) VALUES (null, $blogTitle, $blogContent)";
			$query = "INSERT INTO blog (blogId, blogTitle, blogContent) VALUES (null, :blogTitle, :blogContent)";
			if ($stmt = $conn->prepare($query)) {
				$stmt->bindParam(":blogTitle", $blogTitle);
				$stmt->bindParam(":blogContent", $blogContent);

				// $param_ingredient_name = $ingredient_name;
				// $param_ingredient_measure = $ingredient_measure;
				// $param_ingredient_unit = $ingredient_unit;


				if ($stmt->execute()) {
					//echo "sent";
				} else {
					echo "Something went wrong. Please try again later.";
				}
				$stmt->closeCursor();
			}
		}
	}
}
?>