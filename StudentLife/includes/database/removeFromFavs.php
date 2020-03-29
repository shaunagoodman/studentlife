<?php  
start_session();
include_once 'includes/database/connection.php';
include_once 'includes/CDNs.php';
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
    $user = $_SESSION['user_ID'];
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        //   **************** CHECK IF EXISTS IN FAVOURITES ****************
        $query = "DELETE FROM favourites WHERE user_ID = $user AND recipe_ID = $recipe_ID";
        $statement2 = $conn->prepare($query);
            if($statement2->execute()) {
                echo "<script language = javascript>
                        swal({  title: 'Removed from Favourites!',  
                        type: 'success',    
                        showCancelButton: false,   
                        closeOnConfirm: false,   
                        confirmButtonText: 'Aceptar', 
                        showLoaderOnConfirm: true, }).then(function() {
                            window.location = 'profile.php';
                        });;
                    </script>";
            } 
            else {
            echo "<script language = javascript>
            swal({  title: 'Recipe could not be removed!',  
            type: 'fail',    
            showCancelButton: false,   
            closeOnConfirm: false,   
            confirmButtonText: 'Aceptar', 
            showLoaderOnConfirm: true, }).then(function() {
                window.location = 'profile.php';
            });;
        </script>";
        }
        $favourites = $statement2->fetchAll();
        $statement2->closeCursor();
    }
}
?>