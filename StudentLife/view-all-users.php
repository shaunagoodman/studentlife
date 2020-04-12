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

$query = "SELECT * FROM user";
$statement = $conn->prepare($query);
$statement->execute();
$user = $statement->fetchAll();
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
    <title>All Users</title>
    <link rel="icon" href="images/recipeasy-icons-logos/small-logo.png">
    <?php include_once 'includes/CDNs.php'; ?>
</head>

<body class='site'>
    <?php include_once 'includes/nav-menu.php'; ?>
    <main class='site-content'>
        <div class="container">

            <h1 class="allRecipes-h1"><span class="underline">View All Users</span></h1>



<div class="table-responsive" >
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>First Name</th>
                        <th>Last Name </th>
                        <th>Email</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($user as $users) : ?>
                        <tr>
                            <th class="th1">
                                <?php echo $users['user_ID']; ?>
                            </th>
                            <td>
                                <p><?php echo $users['fname']; ?></p>
                            </td>
                            <td>
                                <p><?php echo $users['lname']; ?></p>
                            </td>
                            <td>
                                <p><?php echo $users['u_email']; ?></p>
                            </td>
                            <td>

                                <form action="delete-user.php" method="post" id="delete_user_form">
                                    <a href="delete-user.php?user_ID=<?php echo $users['user_ID'] ?>" class="add-my-recipe" style="justify-content: center;

display: flex;" ><i class="fas fa-trash-alt fa-lg"></i></a>
                                </form>
                            </td>


                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
</div>
            <br>
            <br>












        </div>
        <?php include_once 'includes/footer.php'; ?>
    </main>
</body>

</html>