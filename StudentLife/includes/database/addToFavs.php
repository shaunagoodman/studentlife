<?php  
include_once 'includes/database/connection.php';
include_once 'includes/CDNs.php';
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
    $user = $_SESSION['user_ID'];
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        //   **************** CHECK IF EXISTS IN FAVOURITES ****************
        $query = "SELECT * FROM favourites WHERE recipe_ID = $recipe_ID";
        $statement = $conn->prepare($query);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if(!$row) {
            //   **************** ADD TO FAVOURITES TABLE ****************
            $query = "INSERT INTO favourites(recipe_ID, user_ID) VALUES ($recipe_ID, $user)";
            $statement2 = $conn->prepare($query);
            if($statement2->execute()) {
                echo "<script language = javascript>
                        swal({  title: 'Added to favourites!',  
                        type: 'success',    
                        showCancelButton: false,   
                        closeOnConfirm: false,   
                        confirmButtonText: 'Aceptar', 
                        showLoaderOnConfirm: true, }).then(function() {
                            window.location = 'favourites.php';
                        });;
                    </script>";
            }
            $addToFavs = $statement2->fetchAll();
            $statement2->closeCursor();
        } // end check favs
        else {
            echo "<script language = javascript>
            swal({  title: 'You have already favourited this!',  
            type: 'success',    
            showCancelButton: false,   
            closeOnConfirm: false,   
            confirmButtonText: 'Aceptar', 
            showLoaderOnConfirm: true, }).then(function() {
                window.location = 'recipe-list.php';
            });;
        </script>";
        }
        $statement->closeCursor();
    }
}
?>