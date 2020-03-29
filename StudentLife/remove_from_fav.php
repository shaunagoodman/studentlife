<?php
session_start();
include_once 'includes/CDNs.php';
// Process delete operation after confirmation
if(isset($_POST["recipe_ID"])){
    $recipe_ID = $_POST["recipe_ID"];
}
if(isset($_SESSION['user_ID'])){
    $user_ID = $_SESSION["user_ID"];
    }
if($_SERVER["REQUEST_METHOD"] == "POST"){
    require_once "includes/database/connection.php";
    if(isset($_POST['submitYes'])) {
//   **************** CHECK IF EXISTS IN FAVOURITES ****************
$query = "DELETE FROM favourites WHERE user_ID = $user_ID AND recipe_ID = $recipe_ID";
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
    <title>Remove from Favourites</title>

</head>
<body class='site' >
<?php include_once 'includes/nav-menu.php'; ?>
<main class='site-content' >
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    
                        <h1>Remove From Your Favourites</h1>
                  
                    <form action=" " method="post">
                        <div >
                            <input type="hidden" name="recipe_ID" value="<?php echo trim($_GET["recipe_ID"]); ?>"/>
                            <p>Are you sure you want to unfavourite this recipe?</p><br>
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