<?php
session_start();
 include_once 'includes/database/connection.php'; ?>
 
<?php
$blogId = filter_input(INPUT_GET, "blogId");
echo $blogId;
if ($blogId == NULL) {
	header("location:blog_list.php");
}

// Get individual blog
$query = 'SELECT * FROM blog WHERE blogId=:blogId';
$statement4 = $conn->prepare($query);
$statement4->bindValue(":blogId", $blogId);
$blog = $statement4->fetchAll();
$statement4->closeCursor();
?>

<html>

<head>
<meta charset="UTF-8">
<title>Blog</title>

<?php include_once 'includes/CDNs.php'; ?>

</head>

<body>
         <?php include_once 'includes/nav-menu.php'; ?>



<p class="text-muted"><?php echo $blogs['blogContent'] ?></p>

<?php include_once 'includes/footer.php'; ?>
</body>

</html>