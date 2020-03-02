<?php
session_start();
 include_once 'includes/database/connection.php'; ?>
 
<?php
$blogId = filter_input(INPUT_GET, "blogId");
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
<h5 class="card-title">
<?php
foreach($blog as $content) {
     echo $content['blogContent']; 
}
?>
    </h5>

<?php include_once 'includes/footer.php'; ?>
</body>
</html>