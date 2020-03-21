<?php


// Initialize the session
session_start();


// Include config file
require_once "includes/database/connection.php";


$query = "SELECT * FROM recipes WHERE user_ID = '117' ORDER BY date_created";
$statement = $conn->prepare($query);
$statement->execute();
$recipes = $statement->fetchAll();
//close the statement
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
    <title>Home</title>
    <link rel="icon" href="images/recipeasy-icons-logos/Capture.png">
    <?php include_once 'includes/CDNs.php'; ?>




</head>

<body class='site' >
<main class='site-content' >
    <?php include_once 'includes/nav-menu.php'; ?>




    
<p>dcuhwdhwiuedhiouwh</p>
</main>
    <?php include_once 'includes/footer.php'; ?>






</body>

</html>