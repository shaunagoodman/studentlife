
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
