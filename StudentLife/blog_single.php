<?php
session_start();
include_once 'includes/database/connection.php'; ?>

<?php
$blogId = filter_input(INPUT_GET, "blogId");
if ($blogId == NULL) {
    header("location:blog_list.php");
}

// // Get individual blog
// $query = "SELECT * FROM blog WHERE blogId=:blogId";
// echo "SELECT * FROM blog WHERE blogId=$blogId";
// $statement4 = $conn->prepare($query);
// $statement4->bindValue(":blogId", $blogId);
// $blog = $statement4->fetchAll();
// print_r($blog);
// $statement4->closeCursor();

$query = "SELECT * FROM blog WHERE blogId=:blogId";
$statement = $conn->prepare($query);
$statement->bindValue(":blogId", $blogId);
$statement->execute();
$blog = $statement->fetchAll();
$statement->closeCursor();
?>

<html>

<head>
    <meta charset="UTF-8">
    <title>Blog</title>

    <?php include_once 'includes/CDNs.php'; ?>

</head>

<body class='site' >
    <?php include_once 'includes/nav-menu.php'; ?>

<main class='site-content' >
    <div class='container'>

        <?php foreach ($blog as $blogs) { ?>
            <h2 class="allRecipes-h1"><span class="underline"><?php echo $blogs['blogTitle']; ?></span></h2>
        <?php } ?>


        <div class='col-lg-11'>
            <p class="blog-content">
                <?php
                foreach ($blog as $content) {
                    echo $content['blogContent'];
                }
                ?>
            </p>
        </div>
    </div>
    </main>
    <?php include_once 'includes/footer.php'; ?>
    
</body>

</html>