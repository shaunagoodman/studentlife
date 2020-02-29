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
    <?php include_once 'includes/CDNs.php'; ?>
    <link href="includes/stylesheet.css" rel="stylesheet" type="text/css" />


</head>

<body>
<?php include_once 'includes/nav-menu.php'; ?>

    <div class="container">

<h1>Blog</h1>

<p>

<a href="add_blog.php"><button type="button" class="btn btn-light">New Blog Post</button></a>

</p>
<p>
<?php foreach ($blog as $blogs) { ?>
	<h5 class="blog-title"><?php echo $blogs['blogTitle'];?></h5>
	<center><a href="blog_single.php?blogId=<?php echo $blogs['blogId'] ?>"><button type="button" class="btn btn-light">View Post</button></a> </center>
<?php } ?>
</p>

</div>

<?php include_once 'includes/footer.php'; ?>

</body>
</html>