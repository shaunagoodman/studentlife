<?php
// Initialize the session
session_start();
require_once 'includes/database/connection.php';

try {
    //write a query to get the dynamic categories (All categories)  maybe go to phpmyadmin to check is it working
    $query = "SELECT * from difficulties";           //run in phpmyadmin to check if working

    //run my query 
    //prepare the query (PDO)
    $statement = $conn->prepare($query);
    //bind data if required  (if i need to contrain using a WHERE clause) not needed rn cos we need all categories
    //execute the query
    $statement->execute();


    //create a variable to save the result set ($categories)
    $difficulties = $statement->fetchAll();
    //close the statement
    $statement->closeCursor();

    if(isset($_POST['submit'])) {
        $searchString = $_POST['something'];
        $array = explode(" ",$searchString);
        $sql = "SELECT * FROM recipes WHERE name ";
        $count = 0;
        forEach($array as $value) {
            if ($count == 0) {
                $sql .= " LIKE '%" . $value . "%'";
            }
            else {
                $sql .= " OR '%" . $value . "%'";
            }
            $count++;
        }
        $statement = $conn->prepare($sql);
        $statement->execute();
        $recipes = $statement->fetchAll();
        

}
else if(empty($_POST['submit'])) {
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
    $statement2 = $conn->prepare($query);
    //bind data if required  (if i need to contrain using a WHERE clause)
    $statement2->bindValue(":difficulty_id", $difficultyID);
    //execute the query
    $statement2->execute();
    //create a variable to save the result set ($products)
    $recipes = $statement2->fetchAll();
    //close the statement
    $statement2->closeCursor();
}
} catch (Exception $ex) {
    $errorMessage = $e->getMessage();
    echo $errorMessage;
    exit();
}


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
        <title>Create a Recipe</title>

        <?php session_start();
        include_once 'includes/CDNs.php'; 
        require_once 'includes/database/connection.php';
        ?> 
        <link href="includes/stylesheet.css" rel="stylesheet" type="text/css"/>
        <script src="javascript/addInput.js"></script>
    </head>
<body>
<?php include_once 'includes/nav-menu.php'; ?> 

<div id="recipe-list" >
    <?php
    $sql = 'SELECT * FROM recipes';
    echo "<div class = 'recipe-details'>";
    foreach ($conn->query($sql) as $row) {
        echo $row['name'] . "</br>";
        echo "Difficulty: " . $row['difficulty'] . "</br>";
        echo "Serves: " . $row['servings'] . "</br>";
        $maxTime = $row["maxTime"];
                $time = explode(':', $maxTime);
                $minutes = ($time[0] * 60.0 + $time[1] * 1.0);
                echo $minutes . " minutes</br>";
                echo "<href = ''>Link to recipe</a> </br>";
    }
    echo "</div>";
    ?>
</div>

<?php
include_once 'includes/footer.php';
$conn = null; 
?>
</body>
</html>
<html>
