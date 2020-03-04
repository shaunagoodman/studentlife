<?php
// Initialize the session
session_start();
include_once 'includes/database/connection.php';
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}



?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>
    <meta charset="UTF-8">
    <title>Profile</title>

    <?php include_once 'includes/CDNs.php'; ?>
    <script src="javascript/scripts.js"></script>
    <link href="includes/stylesheet.css" rel="stylesheet" type="text/css" />
</head>

<body class='site'>

    <?php include_once 'includes/nav-menu.php'; ?>
    <main class='site-content' >
    <div class="profile-body desktop-profile">
        
            <div class="container desktop-profile">

                <div class="row">

                    <div class="col-lg-12">

                    </div>


                    <div class="col-lg-6 user-col ">

                        <div class="user-info profile-user-info">

                            <h2 class="user-name"><?php echo $_SESSION["fname"] . " " . $_SESSION["lname"]; ?></h2>

                            <hr>
                            <h5 class="h5-profile">Email:</h5>

                            <p><?php echo htmlspecialchars($_SESSION["u_email"]); ?></p>
                            <form method = "post">
                            <a href="edit_details.php" class="btn btn-light btn-sm">Edit Profile</a>
                            <a href="reset_password.php" class="btn btn-light btn-sm">Reset Password</a>
                            <input type="submit" class="btn btn-light btn-sm" name="submitbutton" value="Deactivate Account"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br>
    </div>
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $userID = $_SESSION['user_ID'];
        $submitbutton= $_POST['submitbutton'];
        if ($submitbutton){
            $query = "UPDATE user SET isActive = 0 WHERE user_ID = $userID";
            $statement = $conn->prepare($query);
            if($statement->execute()) {
               echo "<script language = javascript>
               deactivated();
              </script>";
            }
            $recipeIngredient = $statement->fetchAll();
            $statement->closeCursor();
        }
    }
    ?>



    <div class="container div-button desktop-profile">

        <div class="row">

            <div class="col-lg-6 ">
                <div class="user-info profile-buttons favourites-button">
                    <h2><a href="favourites.php" class="recipes my-favourites">Favourites</a></h2>
                </div>
            </div>



            <div class="col-lg-6">
                <div class="user-info profile-buttons recipe-button">
                    <h2><a href="show-all-recipes.php" class="recipes">Recipes</a></h2>
                </div>
            </div>

        </div>
    </div>
    </div>




    </div>


    <!--        -------------------    MOBILE VERSION ------------------------ -->
    <div class="profile-body mobile-profile">

        <div class="container mobile-profile">

            <div class="row">

                <div class="col-md-12 ">

                    <div class="user-info profile-user-info">

                        <h2 class="user-name"><?php echo $_SESSION["fname"] . " " . $_SESSION["lname"]; ?></h2>
                        <hr>
                        <center class="mobile-profile-info">

                            <h5 class="h5-profile">Email:</h5>
                            <p><?php echo htmlspecialchars($_SESSION["u_email"]); ?></p>

                            <a href="edit_details.php" class="btn btn-light btn-sm">Edit Profile</a>

                            <a href="reset_password.php" class="btn btn-light btn-sm">Reset Password</a>

                        </center>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container mobile-profile">

        <div class="row">

            <div class="col-md-12">

                <div class="user-info profile-buttons favourites-button">
                    <h2><a href="favourites.php" class="recipes my-favourites">Favourites</a></h2>
                </div>


                <br>

                <div class="user-info profile-buttons recipe-button">
                    <h2><a href="show-all-recipes.php" class="recipes">Recipes</a></h2>
                </div>

            </div>


        </div>


    </div>




    <br>








    </div>

    </main>



    <?php include_once 'includes/footer.php'; ?>






</body>

</html>