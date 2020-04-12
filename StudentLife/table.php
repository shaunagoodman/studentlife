<?php


// Initialize the session
session_start();


// Include config file
require_once "includes/database/connection.php";
$query = "SELECT * FROM recipes r INNER JOIN user u ON u.user_ID = r.user_ID WHERE u.u_type = 1 ORDER BY date_created limit 4";
$statement = $conn->prepare($query);
$statement->execute();
$recipes = $statement->fetchAll();
//close the statement
$statement->closeCursor();



?>




<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="icon" href="images/recipeasy-icons-logos/small-logo.png">
    <?php include_once 'includes/CDNs.php'; ?>




</head>

<body class='site'>

    <?php include_once 'includes/nav-menu.php'; ?>

    <main class='site-content'>
        <div class="container first-home-container ">
<br><br>



<div class="table-responsive" >
        <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td colspan="2">Larry the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>
</div>




        </div>
    </main>
    <?php include_once 'includes/footer.php'; ?>
</body>

</html>