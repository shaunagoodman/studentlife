
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
        $servername = "localhost";
        $username = "student_user";
        $password = "";
        $db_name = "Student_db";
        
        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $db_name);
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        ?> 
        <link href="includes/stylesheet.css" rel="stylesheet" type="text/css"/>
        <script src="javascript/addInput.js"></script>
    </head>
<body>
<?php include_once 'includes/nav-menu.php'; ?> 

<div id="recipe-list" >
    <?php
        $query = "SELECT * FROM recipes";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            // output data of each row
            $name = "";
            $difficulty = ""; 
            $maxTime = "";
           // $image_name = "";
            while($row = $result->fetch_assoc()) {
                $name = $row["name"];
                $difficulty = $row["difficulty"];
                $servings = $row["servings"];
                $image_name = $row["image"];
                $maxTime = $row["maxTime"];
                $time = explode(':', $maxTime);
                $minutes = ($time[0] * 60.0 + $time[1] * 1.0);
                echo "<div class = 'recipe-image'>";
                echo "IMAGE"; //THIS IS WHERE THE IMAGE WILL BE DISPLAYING.
                echo "</div>";

                echo "<div class = 'recipe-details'>";
                echo $name . "</br>";
                echo "Difficulty: " . $difficulty . "</br>";
                echo "Serving: " .$servings . "</br>";
                echo "Time: " .$minutes . " minutes" ."</br>";
                echo "</div>";
        }
        }
    ?>
</div>

<?php
include_once 'includes/footer.php';
$conn->close();
?>
</body>
</html>
<html>
