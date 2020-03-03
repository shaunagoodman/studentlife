<?php
// Initialize the session
session_start();
require_once 'includes/database/connection.php';

try {
    $query = "SELECT * from difficulties";
    $statement = $conn->prepare($query);
    $statement->execute();
    $difficulties = $statement->fetchAll();
    $statement->closeCursor();


    //#################CUISINES##################
    $query = "SELECT * from cuisine";
    $statement = $conn->prepare($query);
    $statement->execute();
    $cuisines = $statement->fetchAll();
    $statement->closeCursor();
    //#######END CUISINES###########

//~~~~~~~~~~~~~~~~INTOLERANCES~~~~~~~~~~~~~~~~~~~~~~
$query = "SELECT * from intolerance";

//run my query 
//prepare the query (PDO)
$statement = $conn->prepare($query);

//bind data if required  (if i need to contrain using a WHERE clause) not needed rn cos we need all categories
//execute the query
$statement->execute();


//create a variable to save the result set ($categories)
$intolerances = $statement->fetchAll();
//close the statement
$statement->closeCursor();

//~~~~~~~~~~~~~~~~ END INTOLERANCES~~~~~~~~~~~~~~~~~~~~~~

//~~~~~~~~~~~~~~~~DIET RESTRICTION~~~~~~~~~~~~~~~~~~~~~~
$query = "SELECT * from dietrestriction";

//run my query 
//prepare the query (PDO)
$statement = $conn->prepare($query);

//bind data if required  (if i need to contrain using a WHERE clause) not needed rn cos we need all categories
//execute the query
$statement->execute();


//create a variable to save the result set ($categories)
$restrictions = $statement->fetchAll();
//close the statement
$statement->closeCursor();

//~~~~~~~~~~~~~~~~ END DIET RESTRICTION~~~~~~~~~~~~~~~~~~~~~~

    if (isset($_POST['submit'])) {
        $searchString = $_POST['something'];
        $array = explode(" ", $searchString);
        $sql = "SELECT * FROM recipes WHERE name ";
        $count = 0;
        foreach ($array as $value) {
            if ($count == 0) {
                $sql .= " LIKE '%" . $value . "%'";
            } else {
                $sql .= " OR '%" . $value . "%'";
            }
            $count++;
        }
        $statement = $conn->prepare($sql);
        $statement->execute();
        $recipes = $statement->fetchAll();
    } else if (empty($_POST['submit'])) {
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
// //~~~~~~~~~~~~~~~~~~~~CUISINE####################
if (isset($_POST['submit'])) {
    $searchString = $_POST['something'];
    $array = explode(" ", $searchString);
    $sql = "SELECT * FROM recipes WHERE name ";
    $count = 0;
    foreach ($array as $value) {
        if ($count == 0) {
            $sql .= " LIKE '%" . $value . "%'";
        } else {
            $sql .= " OR '%" . $value . "%'";
        }
        $count++;
    }
    $statement = $conn->prepare($sql);
    $statement->execute();
    $recipes = $statement->fetchAll();

}
    else if (empty($_POST['submit'])) {
        //get the category id from the URL (if there is one)
        $cuisine_ID = filter_input(INPUT_GET, "cuisine_id", FILTER_VALIDATE_INT);
        //write a query to get the dynamic products (all products - from the categories ive selected) 
        if ($cuisine_ID != "") {
            //query if a value has been passed for category id
            $query2 = "SELECT * from recipes WHERE cuisine_ID = :cuisine_id";
        } else {
            //query if a value has NOT been passed for category id
            $query2 = "SELECT * from recipes";
        }

        //prepare the query (PDO)
        $statement3 = $conn->prepare($query2);

        //bind data if required  (if i need to contrain using a WHERE clause)
        $statement3->bindValue(":cuisine_id", $cuisine_ID);
        //execute the query
        $statement3->execute();
        //create a variable to save the result set ($products)
        $recipes = $statement3->fetchAll();
        //close the statement
        $statement3->closeCursor();
    }

//     //#########################INTOLERANCES###############

    if (isset($_POST['submit'])) {
        $searchString = $_POST['something'];
        $array = explode(" ", $searchString);
        $sql = "SELECT * FROM recipes WHERE name ";
        $count = 0;
        foreach ($array as $value) {
            if ($count == 0) {
                $sql .= " LIKE '%" . $value . "%'";
            } else {
                $sql .= " OR '%" . $value . "%'";
            }
            $count++;
        }
        $statement = $conn->prepare($sql);
        $statement->execute();
        $recipes = $statement->fetchAll();
    
    }
        else if (empty($_POST['submit'])) {
            //get the category id from the URL (if there is one)
            $intolerance_ID = filter_input(INPUT_GET, "intolerance_id", FILTER_VALIDATE_INT);
            //write a query to get the dynamic products (all products - from the categories ive selected) 
            if ($intolerance_ID != "") {
                //query if a value has been passed for category id
                $query3 = "SELECT * from recipes WHERE intolerance_ID = :intolerance_id";
            } else {
                //query if a value has NOT been passed for category id
                $query3 = "SELECT * from recipes";
            }
    
            //prepare the query (PDO)
            $statement4 = $conn->prepare($query3);
    
            //bind data if required  (if i need to contrain using a WHERE clause)
            $statement4->bindValue(":intolerance_id", $intolerance_ID);
            //execute the query
            $statement4->execute();
            //create a variable to save the result set ($products)
            $recipes = $statement4->fetchAll();
            //close the statement
            $statement4->closeCursor();
        }
 //#########################INTOLERANCES END###############

    //#########################DIET RESTRICTIONS###############

    if (isset($_POST['submit'])) {
        $searchString = $_POST['something'];
        $array = explode(" ", $searchString);
        $sql = "SELECT * FROM recipes WHERE name ";
        $count = 0;
        foreach ($array as $value) {
            if ($count == 0) {
                $sql .= " LIKE '%" . $value . "%'";
            } else {
                $sql .= " OR '%" . $value . "%'";
            }
            $count++;
        }
        $statement = $conn->prepare($sql);
        $statement->execute();
        $recipes = $statement->fetchAll();
    
    }
        else if (empty($_POST['submit'])) {
            //get the category id from the URL (if there is one)
            $restriction_ID = filter_input(INPUT_GET, "restriction_id", FILTER_VALIDATE_INT);
            //write a query to get the dynamic products (all products - from the categories ive selected) 
            if ($restriction_ID != "") {
                //query if a value has been passed for category id
                $query4 = "SELECT * from recipes WHERE restriction_ID = :restriction_id";
            } else {
                //query if a value has NOT been passed for category id
                $query4 = "SELECT * from recipes";
            }
    
            //prepare the query (PDO)
            $statement5 = $conn->prepare($query4);
    
            //bind data if required  (if i need to contrain using a WHERE clause)
            $statement5->bindValue(":restriction_id", $restriction_ID);
            //execute the query
            $statement5->execute();
            //create a variable to save the result set ($products)
            $recipes = $statement5->fetchAll();
            //close the statement
            $statement5->closeCursor();
        }

        //#########################END DIET RESTRICTIONS###############
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
    <title>All Recipes</title>
    <?php include_once 'includes/CDNs.php'; ?>
    <link href="includes/stylesheet.css" rel="stylesheet" type="text/css" />
    <link href="css/sidebar.css" rel="stylesheet" type="text/css" />
    <link href="css/main.css" rel="stylesheet" type="text/css" />


</head>

<body>
    <?php include_once 'includes/nav-menu.php'; ?>

    
    <?php include_once 'includes/footer.php'; ?>
    </div>
            </div>
</body>

</html>