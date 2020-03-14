<?php
// Initialize the session
session_start();
require_once 'includes/database/connection.php';

try {
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
        $statement2 = $conn->prepare($sql);
        $statement2->execute();
        $recipes = $statement2->fetchAll();
        $statement2->closeCursor();
    }
    else {
        $sql = "SELECT * FROM recipes";
        $statement2 = $conn->prepare($sql);
        $statement2->execute();
        $recipes = $statement2->fetchAll();
        $statement2->closeCursor();
    }
}
 catch (Exception $ex) {
    $errorMessage = $e->getMessage();
    echo $errorMessage;
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <?php include_once 'includes/CDNs.php'; ?>
    <link href="includes/stylesheet.css" rel="stylesheet" type="text/css" />
</head>
<body class='site' >
    <?php include_once 'includes/nav-menu.php'; ?>
    <main class='site-content' >
        <div class="container">
        <h1 class="allRecipes-h1" >All Recipes</h1>
        <hr align="left">
        <?php
        echo "<div class='row' >";
        if(!empty($recipes)) {
        foreach ($recipes as $recipe) :  
        if($recipe['difficultyID'] == 1) {
            $difficulty = "Easy";
        }
        else if ($recipe['difficultyID'] == 2) {
            $difficulty = "Medium";
        }
        else if ($recipe['difficultyID'] == 3) {
            $difficulty = "Hard";
        }
        else {
            $difficulty = "No difficulty selected.";
        }
        
        if($recipe['isAPI'] == 1) {
            $src = $recipe['image'];
        }
        else {
            if(empty($recipe['image'])) {
                $src = "images/recipes/placeholder.png";
            }
            else {
                $src = 'images/recipes/'.$recipe['image']; 
            }     
        }
        ?>
        <div class="col-lg-4 bottom-home ">
            <div class="card home-card recipe-page-card">
                <img src="<?php echo $src;?>" class="card-img-top" alt='dish image' height='315' width='328'>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $recipe['name'];  ?></h5>
                    <p class="card-text" class='recipe-difficulty'> Difficulty: <?php echo $difficulty; ?> </p>
                    <p class="card-text" class='recipe-time'> <img src='images/recipeasy-icons-logos/clock.png' style='margin-bottom:0.3%' alt='clock icon' height='25' width='25'> Time: <?php echo $recipe['maxTime']; ?>
                    </p>
                    <center><a href="recipe_single.php?recipe_ID=<?php echo $recipe['recipe_ID'] ?>"><button type="button" class="btn btn-light stretched-link">View Recipe</button></a> </center>
                </div>
            </div>
        </div>

        <?php endforeach;
        }
        if(isset($_POST['submit'])) {
            $name = "";
            $string = $_POST['something'];
            $arraySearch = explode(" ",$string);
            $count = count($recipes);
            $searchString = "";
            if($count < 9) {
                $array = [];
                foreach($arraySearch as $arr) {
                    $searchString = $arr . "&";
                }
                $remaining = (9 - $count);
                $string1 = "https://api.spoonacular.com/recipes/search?query=";
                $string2 = "number=";
                $string3 = "&apiKey=53bea2eb3c79445188bc4d3f00895d15";
                $url = $string1 . $searchString . $string2 . $remaining . $string3;
                $response = json_decode(file_get_contents($url),true);
                    foreach ($response['results'] as $data) {
                        array_push($array, $data['id']);
                    }
                    foreach($array as $a) {
                        $url = "https://api.spoonacular.com/recipes/".$a."/information?apiKey=53bea2eb3c79445188bc4d3f00895d15";
                        $response = json_decode(file_get_contents($url),true); 
                        $name =  $response["title"];
                        $servings =  $response["servings"];
                        $image = $response["image"];
                        $maxTime = $response["readyInMinutes"];
                        ?>   
                        <div class="col-lg-4 bottom-home ">
                        <div class="card home-card recipe-page-card">
                        <img src="<?php echo $image;?>" class="card-img-top" alt='dish image' height='315' width='328'>
                        <div class="card-body">
                        <h5 class="card-title"><?php echo$name;  ?></h5>
                        <p class="card-text" class='recipe-difficulty'> Difficulty: No difficulty.</p>
                        <p class="card-text" class='recipe-time'> <img src='images/recipeasy-icons-logos/clock.png' style='margin-bottom:0.3%' alt='clock icon' height='25' width='25'> Time: <?php echo $maxTime; ?> minutes
                        </p>
                        <center><a href="api_single.php?recipe_ID=<?php echo $a ?>"><button type="button" class="btn btn-light stretched-link">View Recipe</button></a> </center>
                        </div>
                        </div>
                        </div>
                        <?php
                        }
                // else {
                //     echo "<script language = javascript>
                //     APIError();
                // </script>";
                // }
            }
        }
        echo "</div>" ;
        ?>

    </div>



    </main>
    <?php include_once 'includes/footer.php'; ?>

</body>
</html>