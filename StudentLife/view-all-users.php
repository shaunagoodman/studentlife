<?php
session_start();
require_once 'includes/database/connection.php';

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
    <?php include_once 'includes/CDNs.php'; ?>
</head>

<body class='site'>
    <?php include_once 'includes/nav-menu.php'; ?>
    <main class='site-content'>
        <div class="container">

        <h1 class="allRecipes-h1">View All Users</h1>
		<hr align="left">




            <table class = "table1">
                        <tr>
                            <th class="th1">User ID</th>
                            <th class="th1">First Name</th>
                            <th class="th1">Last Name </th>
                            <th class="th1">Email</th>
                            <th class="th1">Delete</th>
                            <th class="th1">Edit</th>
                        </tr>
                        <?php foreach ($user as $users) : ?>
                            <tr>
                                <td class="td1"><p><?php echo $users['user_ID']; ?></p></td>
                                <td class="td1"><p><?php echo $users['fname']; ?></p></td>
                                <td class="td1"><p><?php echo $users['lname']; ?></p></td>
                                <td class="td1"><p><?php echo $users['u_email']; ?></p></td>
                                <td class="td1">

                                    <form action="delete_product.php" method="post"
                                          id="delete_product_form">
                                        <input type="hidden" name="item_id"
                                               value="<?php echo $users['user_ID']; ?>">
                                        <input class="btn btn-sm btn-light-invert" type="submit" value="Delete">
                                    </form></td>

                                <td class="td1"><form action="edit_product_form.php" method="post"
                                                      id="edit_product_form">
                                        <input type="hidden" name="item_id"
                                               value="<?php echo $users['user_ID']; ?>">
                                        <!-- <input type="hidden" name="category_id"
                                               value="<?php echo $users['CID']; ?>"> -->
                                        <input class="btn btn-sm btn-light-invert" type="submit" value="Edit">
                                    </form></td>
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