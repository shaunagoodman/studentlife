<?php
session_start();
require_once 'includes/database/connection.php';

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
} elseif (!isset($_SESSION["u_type"]) || $_SESSION["u_type"] != 1) {
    header("location: profile.php");
    exit;
}

$query = "SELECT * FROM recipes";
$statement = $conn->prepare($query);
$statement->execute();
$recipes = $statement->fetchAll();
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
    <title>All Recipes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/recipeasy-icons-logos/small-logo.png">
    <?php include_once 'includes/CDNs.php'; ?>
</head>

<body class='site'>
    <?php include_once 'includes/nav-menu.php'; ?>
    <main class='site-content'>
        <div class="container">

            <h1 class="allRecipes-h1"><span class="underline">View All Recipes</span></h1>




            <table class="table1">
                <tr>
                    <th class="th1">Recipe ID</th>
                    <th class="th1">Recipe Name</th>
                    <th class="th1">Servings </th>
                    <th class="th1">Time</th>
                    <th class="th1">Ratings</th>
                    <th class="th1">Difficulty</th>
                    <th class="th1">Image</th>
                    <th class="th1">Video</th>
                    <th class="th1">Delete</th>
                </tr>
                <?php foreach ($recipes as $recipe) : ?>
                    <tr>
                        <td class="td1">
                            <p><?php echo $recipe['recipe_ID']; ?></p>
                        </td>
                        <td class="td1">
                            <p><?php echo $recipe['name']; ?></p>
                        </td>
                        <td class="td1">
                            <p><?php echo $recipe['servings']; ?></p>
                        </td>
                        <td class="td1">
                            <p><?php echo $recipe['maxTime']; ?></p>
                        </td>
                        <td class="td1">
                            <p><?php echo $recipe['rating']; ?></p>
                        </td>
                        <td class="td1">
                            <p><?php echo $recipe['difficultyID']; ?></p>
                        </td>
                        <td class="td1">
                            <p><?php echo $recipe['image']; ?></p>
                        </td>
                        <td class="td1">
                            <p><?php echo $recipe['video_name']; ?></p>
                        </td>
                        <td class="td1">

                            <form action="delete-recipe.php" method="post" id="delete_recipe_form">
                                <a href="delete_recipe.php?recipe_ID=<?php echo $recipe['recipe_ID'] ?>" class="add-my-recipe">Delete</a>
                            </form>
                        </td>


                        <!-- <td class="td1"><form action="edit_user_form.php" method="post"
                                                      id="edit_user_form">
                                        <input type="hidden" name="user_id"
                                               value="// echo $users['user_ID']; ">
                                        <input class="btn btn-sm btn-light-invert" type="submit" value="Edit">
                                    </form></td> -->
                    </tr>
                <?php endforeach; ?>
            </table>
            <br>
            <br>












        </div>
        <?php include_once 'includes/footer.php'; ?>
    </main>
</body>

</html>