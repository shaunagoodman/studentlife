<?php 

session_start();
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Recipes Details</h2>
                        <a href="add_recipe.php" class="btn btn-success pull-right">Add New Recipe</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "includes/database/connection.php";
                    
                    // Attempt select query execution
                    $query = "SELECT * FROM recipes ";
                    if($result = $conn->query($query)){
                        if($result->rowCount() > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Recipe ID #</th>";
                                        echo "<th>User ID #</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Image</th>";
                                        echo "<th>Video Name</th>";
                                        echo "<th>Rating</th>";
                                        echo "<th>Servings</th>";
                                        echo "<th>Difficulty</th>";
                                        echo "<th>Max Time</th>";
                                        echo "<th>Difficulty ID</th>";
                                        echo "<th>Date Created</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch()){
                                    echo "<tr>";
                                        echo "<td>" . $row['recipe_ID'] . "</td>";
                                        echo "<td>" . $row['user_ID'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['image'] . "</td>";
                                        echo "<td>" . $row['video_name'] . "</td>";
                                        echo "<td>" . $row['rating'] . "</td>";
                                        echo "<td>" . $row['servings'] . "</td>";
                                        echo "<td>" . $row['difficulty_text'] . "</td>";
                                        echo "<td>" . $row['maxTime'] . "</td>";
                                        echo "<td>" . $row['difficultyID'] . "</td>";
                                        echo "<td>" . $row['date_created'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='recipe-read.php?recipe_ID=". $row['recipe_ID'] ."' title='View Recipe' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='update_recipe.php?recipe_ID=". $row['recipe_ID'] ."' title='Update Recipe' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete_recipe.php?recipe_ID=". $row['recipe_ID'] ."' title='Delete Recipe' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            unset($result);
                        } else{
                            echo "<p class='lead'><em>No Recipes were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $query. " . $mysqli->error;
                    }
                    
                    // Close connection
                    unset($conn);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>