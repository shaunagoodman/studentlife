<?php
session_start();
include_once 'includes/CDNs.php';
// Process delete operation after confirmation
if(isset($_POST["recipe_ID"])){
    $recipe_ID = $_POST["recipe_ID"];
}
if(isset($_SESSION['u_type'])){
$u_type = $_SESSION["u_type"];
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    require_once "includes/database/connection.php";
    if(isset($_POST["submitYes"])){
        $query1 = "DELETE * FROM recipecuisine WHERE recipe_ID = $recipe_ID";
        $statement = $conn->prepare($query1);
        $statement->execute();
        $recipesteps = $statement->fetchAll();
        $statement->closeCursor();

        $query = "SELECT * FROM recipesteps WHERE recipe_ID = $recipe_ID";
        $statement = $conn->prepare($query);
        $statement->execute();
        $recipesteps = $statement->fetchAll();
        $statement->closeCursor();
        foreach($recipesteps as $recstep) {
            $step_ID = $recstep['steps_ID'];
            $query2 = "DELETE FROM recipesteps WHERE recipe_ID = $recipe_ID";
            $statement2 = $conn->prepare($query2);
            if($statement2->execute()) {
                $query3 = "DELETE FROM steps WHERE steps_ID = $step_ID";
                $statement3 = $conn->prepare($query3);
                $statement3->execute();
                $steps = $statement3->fetchAll();
                $statement3->closeCursor();
            }
        }
        $query = "SELECT * FROM recipeingredient WHERE recipe_ID = $recipe_ID";
        $statement = $conn->prepare($query);
        $statement->execute();
        $recipeingredients = $statement->fetchAll();
        $statement->closeCursor();
        foreach($recipeingredients as $recingredient) {
            $ingredient_ID = $recingredient['ingredient_ID'];
            $query2 = "DELETE FROM recipeingredient WHERE recipe_ID = $recipe_ID";
            $statement2 = $conn->prepare($query2);
            if($statement2->execute()) {
                $query3 = "DELETE FROM ingredients WHERE ingredient_ID = $ingredient_ID";
                $statement3 = $conn->prepare($query3);
                $statement3->execute();
                $steps = $statement3->fetchAll();
                $statement3->closeCursor();
            }
        }
        $query = "DELETE FROM comments WHERE recipe_ID = $recipe_ID";
        $statement3 = $conn->prepare($query);
        $statement3->execute();
        $comments = $statement3->fetchAll();
        $statement3->closeCursor();

        $query = "DELETE FROM recipecuisine WHERE recipe_ID = $recipe_ID";
        $statement3 = $conn->prepare($query);
        $statement3->execute();
        $recipecuisine = $statement3->fetchAll();
        $statement3->closeCursor();

        $query = "DELETE FROM favourites WHERE recipe_ID = $recipe_ID";
        $statement3 = $conn->prepare($query);
        $statement3->execute();
        $favourites = $statement3->fetchAll();
        $statement3->closeCursor();

        $query2 = "DELETE FROM recipes WHERE recipe_ID = $recipe_ID";
        $statement = $conn->prepare($query2);
        if($statement->execute()) {
            echo "<script language = javascript>
                    recipeDeleted();
                    </script>";
        }
        $recipesteps = $statement->fetchAll();
        $statement->closeCursor();
    }
} else{
    if(empty(trim($_GET["recipe_ID"]))){
        header("location: error.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Recipe</title>
    <link rel="icon" href="images/recipeasy-icons-logos/small-logo.png">

</head>
<body class='site' >
<?php include_once 'includes/nav-menu.php'; ?>
<main class='site-content' >
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    
                        <h1>Delete Record</h1>
                  
                    <form action=" " method="post">
                        <div >
                            <input type="hidden" name="recipe_ID" value="<?php echo trim($_GET["recipe_ID"]); ?>"/>
                            <p>Are you sure you want to delete this record?</p><br>
                            <p>
                                <input type='submit' class="btn btn-light"  name = 'submitYes' value="Yes"/>
                                <input type = 'submit' name = 'submitNo' formaction =" <?php 
                                if ($u_type == 1) {
                                    echo 'admin.php'; 
                                    } else { 
                                    echo 'profile.php';
                                    }
                                    ?>" class="btn btn-default" value = "No"/>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
</main>
<?php include_once 'includes/footer.php';?>
</body>
</html>