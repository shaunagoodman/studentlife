<?php
// Initialize the session
session_start();
require_once 'includes/database/connection.php';
try {
    //Difficuties
    $query = "SELECT * from difficulties";
    $statement = $conn->prepare($query);
    $statement->execute();
    $difficulties = $statement->fetchAll();
    $statement->closeCursor();

    //Cuisines
    $query = "SELECT * from cuisine ORDER BY name";
    $statement = $conn->prepare($query);
    $statement->execute();
    $cuisine = $statement->fetchAll();
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
        $statement2 = $conn->prepare($sql);
        $statement2->execute();
        $recipes = $statement2->fetchAll();
        $statement2->closeCursor();
    }
    else {
        $difficultyID = filter_input(INPUT_GET, "difficulty_id", FILTER_VALIDATE_INT); 
        $cuisineID = filter_input(INPUT_GET, "cuisine_ID", FILTER_VALIDATE_INT); 
   if (isset($_POST["postvar"]))
   {
       echo $_POST["postvar"];
   }
        if ($difficultyID != "") {
            $query = "SELECT * from recipes WHERE difficultyID = '$difficultyID'";
        }
        else if ($cuisineID != "") {
            $query = "SELECT * FROM recipes r INNER JOIN recipecuisine rc ON r.recipe_ID = rc.recipe_ID WHERE rc.cuisine_ID = '$cuisineID'";
        } 
        else if(isset($_POST['time'])) {
            $query = "SELECT * FROM recipes WHERE `maxTime`<= '00:".$_POST['range'].":00' ";
        }  
        else if(isset($_POST['sortAsc'])) {
            $query = "SELECT * FROM recipes ORDER BY name ASC";
        }  
        else if(isset($_POST['sortDesc'])) {
            $query = "SELECT * FROM recipes ORDER BY name DESC ";
        } 
        else if(isset($_POST['recent'])) {
            $query = "SELECT * FROM recipes ORDER BY maxTime ";
        }   
        else if(isset($_POST['nonUser'])) {
            $query = "SELECT * FROM `recipes` r INNER JOIN user u ON u.user_ID = r.user_ID WHERE u.u_type = 1 ";
        } 
        else {
            $query = "SELECT * from recipes";
        }
        $statement2 = $conn->prepare($query);
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
    <?php include_once 'includes/CDNs.php';  ?>
    <script src="javascript/recipesFilter.js"></script>
    <script src="javascript/slider.js"></script>
    <link href="includes/stylesheet.css" rel="stylesheet" type="text/css" />
</head>
<body onload = "slider()" class='site' >
    <?php include_once 'includes/nav-menu.php';?>
    <main class='site-content' >
        <div class="container">
            <!-- DIFFICULTIES -->
        <div class='sub-menu' >
        <?php
        //get the results from the categories variable(usuing a loop)
        echo "<div id='div-difficulty-list' >";
        echo "<ul class='diff-list' id='ul-difficulty-list' >";
        echo "<li class='li-diff-list' > <a href='recipes-list.php'>Show All </li>";
        foreach ($difficulties as $difficulty) :
            echo "<li class='li-diff-list'>";
            echo "<a class='diff-menu-a' href='recipes-list.php?difficulty_id=" . $difficulty['difficultyID'] . "'>";
            echo $difficulty['diffName'];
            echo "</a>";
            echo "</li>"; 
        endforeach;
        echo "</ul>";
        echo "</div>";
        ?>
    </div>

        <!-- CUISINE -->
        <div class='sub-menu' >
        <?php
        //get the results from the categories variable(usuing a loop)
        echo "<div id='div-difficulty-list' >";
        echo "<ul class='diff-list' id='ul-difficulty-list' >";
        foreach ($cuisine as $c) :
            echo "<li class='li-diff-list'>";
            echo "<a class='diff-menu-a' href='recipes-list.php?cuisine_ID=" . $c['cuisine_ID'] . "'>";
            echo $c['name'];
            echo "</a>";
            echo "</li>"; 
        endforeach;
        echo "</ul>";
        echo "</div>";
        ?>
        <form method = "POST">
        <label>Max Time</label>
        <div>
        <input name = "range" type = "range" min = "1" max = "60" value = "10" id = "myRange"/>
            <span id = "demo"> <span>
            	
        </div>
        <input type = "submit" name = "time" value = "Filter by Time" />
        <div>
        <label> Sort Asc</label>
        <input name = "sortAsc" type = "submit" value = "SortAsc"/>
        </div>
        <div>
        <label> Sort Desc</label>
        <input name = "sortDesc" type = "submit" value = "SortDesc"/>
        </div>
        <label> Most Recent </label>
        <input name = "recent" type = "submit" value = "Recent"/>
        </div>
        <label> Non user Generated </label>
        <input name = "nonUser" type = "submit" value = "nonUser"/>
        </div>
        </form>


    <h1 class="allRecipes-h1" ><span class="underline">All Recipes </span></h1>
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
            $maxTime = $recipe['maxTime'];
            $timestamp = strtotime($maxTime);
            $time = date('i', $timestamp);
        ?>
        <div class="col-lg-4 bottom-home ">
            <div class="card home-card recipe-page-card">
                <img src="<?php echo $src;?>" class="card-img-top" alt='dish image' height='315' width='328'>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $recipe['name'];  ?></h5>
                    <p class="card-text" class='recipe-difficulty'> Difficulty: <?php echo $difficulty; ?> </p>
                    <p class="card-text" class='recipe-time'> <img src='images/recipeasy-icons-logos/clock.png' style='margin-bottom:0.3%' alt='clock icon' height='25' width='25'> Time: <?php echo $time; ?> minutes
                    </p>
                    <center><a href="recipe_single.php?recipe_ID=<?php echo $recipe['recipe_ID'] ?>"><button type="button" class="btn btn-light stretched-link">View Recipe</button></a> </center>
                </div>
            </div>
        </div>

        <?php endforeach;
        }
        else {
            echo "<script language = javascript>
            noRecipe();
              </script>";
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
            }
        }
        echo "</div>" ;
        ?>

    </div>



    </main>
    <?php include_once 'includes/footer.php'; ?>

</body>
</html>