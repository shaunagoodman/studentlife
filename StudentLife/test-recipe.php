<?php
// Initialize the session
session_start();
?>

<?php


//database connection
$dsn = "mysql:host=localhost;dbname=student_db_test";
$dbUsername = "student_user";
$dbPassword = "";

try {
    $db = new PDO ($dsn, $dbUsername, $dbPassword);
} 
catch (Exception $ex) {
    $errorMessage = $e->getMessage();
    echo $errorMessage;
    exit();
}

//write a query to get the dynamic categories (All categories)  maybe go to phpmyadmin to check is it working
$query = "SELECT * from difficulties ORDER by diffName ASC";           //run in phpmyadmin to check if working

//run my query 
        //prepare the query (PDO)
        $statement = $db -> prepare($query); 
        //bind data if required  (if i need to contrain using a WHERE clause) not needed rn cos we need all categories
        //execute the query
        $statement ->execute();
        
        
//create a variable to save the result set ($categories)
$difficulties = $statement ->fetchAll();
//close the statement
$statement ->closeCursor();


//create a variable to save the result set ($categories)
$difficulties = $statement ->fetchAll();
//close the statement
$statement ->closeCursor();



//get the category id from the URL (if there is one)
$difficultyID = filter_input(INPUT_GET, "difficulty_id", FILTER_VALIDATE_INT);
//write a query to get the dynamic products (all products - from the categories ive selected) 
if ($difficultyID != "") {
//query if a value has been passed for category id
    $query = "SELECT * from recipes WHERE difficultyID = :difficulty_id";
} else {
//query if a value has NOT been passed for category id
    $query = "SELECT * from recipes";
}

//prepare the query (PDO)
        $statement2 = $db -> prepare($query);
        //bind data if required  (if i need to contrain using a WHERE clause)
        $statement2 -> bindValue(":difficulty_id", $difficultyID);
        //execute the query
        $statement2 ->execute();
//create a variable to save the result set ($products)
$recipes = $statement2 ->fetchAll();     
//close the statement
$statement2 ->closeCursor();
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
    <?php include_once 'includes/CDNs.php'; ?>
    <link href="includes/stylesheet.css" rel="stylesheet" type="text/css" />


</head>

<body>
    <?php include_once 'includes/nav-menu.php'; ?>


    


    <div>
            <!--dynamic categories (All categories)
            output $categories (from my query above)
            add a link (a tag) around each category name to call this page again (passing through the category id)
            -->
            <h3>Sort By Difficulty</h3>
            <?php
            //get the results from the categories variable(usuing a loop)
            echo "<ul>"; 
            foreach($difficulties as $difficulty) :
            //add a list
            echo "<li>";
            //output category name
            echo "<a href='test-recipe.php?difficulty_id=" . $difficulty['difficultyID'] . "'>";     //will reload
            echo $difficulty['diffName'];
            echo "</a>";
            echo "</li>";
            //close loop  
            endforeach;
            echo "</ul>";
            ?>
        </div>



        <main>
           <!--Dynamic Products (all products - from the categories ive selected)
           output products (from my query above)
           -->
           <?php
           echo "<table>";
           //get the results from the $products variable(using a loop)
           foreach ($recipes as $recipe) :
               echo "<tr>";
               //output product name
              echo "<td>"; echo "<p>Recipe Name:  </p>" ; echo $recipe['name']; echo "</td> </br>";
               //output price
               
             echo "<td>"; echo "<p>Serves:  </p>" ;  echo $recipe ['servings']; echo "</td>";
               echo "</tr>";
           endforeach;
           echo "</table>";
           ?>
           
        </main>




    <?php include_once 'includes/footer.php'; ?>

</body>

  </html>