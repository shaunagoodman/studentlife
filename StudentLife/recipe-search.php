<!DOCTYPE html>
<html>

        <?php session_start();
        include_once 'includes/CDNs.php'; 
        require_once 'includes/database/connection.php';
        ?> 
        <link href="css/stylesheet.css" rel="stylesheet" type="text/css"/>
    </head>
<body>
<?php include_once 'includes/nav-menu.php'; ?> 

<div id="recipe-list" >
    <?php
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
        $result = $statement->fetchAll();
        
        foreach ($result as $row => $row) 
        {
            echo $row['name'];
        }
}
    ?>
</div>
<?php
include_once 'includes/footer.php';
$conn = null; 
?>
</body>
</html>
<html>
