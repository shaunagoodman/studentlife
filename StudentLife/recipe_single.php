<?php
session_start();
 include_once 'includes/database/connection.php'; ?>

<?php
// Initialize the session



  $recipe_ID = filter_input(INPUT_GET, "recipe_ID");
  if ($recipe_ID == NULL) {
       header("location:recipes-list.php");
}
// Get recipes
$query = 'SELECT * FROM recipes WHERE recipe_ID=:recipe_ID';
$statement2 = $conn->prepare($query);
$statement2->bindValue(":recipe_ID", $recipe_ID);
$statement2->execute();
$recipes = $statement2->fetchAll();
$statement2->closeCursor();
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
    <title>Home</title>

    <?php include_once 'includes/CDNs.php'; ?>


</head>
    <body>
         <?php include_once 'includes/nav-menu.php'; ?>

             <?php foreach ($recipes as $recipe) : 
        $querysteps = 'SELECT * FROM recipesteps WHERE recipe_ID=:recipe_ID';
        $statement3 = $conn->prepare($querysteps);
        $statement3->bindValue(':recipe_ID', $recipe["recipe_ID"]);
        $statement3->execute();
        $steps = $statement3->fetchAll();
        $statement3->closeCursor();
       ?>

       



		    
		    <center><h2 class="heading"><?php echo $recipe['name'] ?> </h2></center> 
    		    <center><figure>
                <center> <p class="text-muted"><strong>Difficulty: </strong><?php echo $recipe['difficulty_text'] ?></p></center>
                <img src='images/recipes/<?php echo $recipe['image'];  ?>' alt='dish image' height='250' width='270'>
    			</figure></center>
		  
		    <center> <p class="text-muted"><strong>Servings:</strong> <?php echo $recipe['servings'] ?></p></center>
    		  
                <center> <p class="text-muted"><strong>Cooking Time: </strong><?php echo $recipe['maxTime'] ?></p></center>

                <center> <p class="text-muted">  <strong>Ingredients: </strong></p></center>

                <?php foreach ($recipes as $recipe) : 
        $queryrecipeings = 'SELECT * FROM recipeingredient WHERE recipe_ID=:recipe_ID';
        $statement4 = $conn->prepare($queryrecipeings);
        $statement4->bindValue(':recipe_ID', $recipe["recipe_ID"]);
        $statement4->execute();
        $recipeings = $statement4->fetchAll();
        $statement4->closeCursor();
       ?>

       <?php foreach ($recipeings as $recipeing) : 
        $querydesc = 'SELECT * FROM ingredients WHERE ingredient_ID=:ingredient_ID';
        $statement6 = $conn->prepare($querydesc);
        $statement6->bindValue(':ingredient_ID', $recipeing["ingredient_ID"]);
        $statement6->execute();
        $ingredients = $statement6->fetchAll();
        $statement6->closeCursor();
                    ?>

        
<?php foreach ($ingredients as $ingredient) : ?>
            <center> <p class="text-muted"><?php echo $ingredient['name'] ?> <?php echo $ingredient['amount'] ?> <?php echo $ingredient['unit'] ?></p></center><?php endforeach; ?>
                  <?php endforeach; ?>
          <?php endforeach; ?>

                <?php foreach ($steps as $step) :   
                 
        $querydesc = 'SELECT * FROM steps WHERE steps_ID=:steps_ID';
        $statement5 = $conn->prepare($querydesc);
        $statement5->bindValue(':steps_ID', $step["steps_ID"]);
        $statement5->execute();
        $descriptions = $statement5->fetchAll();
        $statement5->closeCursor();
                    ?>
<?php foreach ($descriptions as $description) : ?>

                <center> <p class="text-muted"><strong>Method: </strong><?php echo $description['description'] ?></p></center><?php endforeach; ?><?php endforeach; ?>
    		</div>
		
    	
    	    </div>
    	</div>

	<?php endforeach; ?>
   





    <?php include_once 'includes/footer.php'; ?>






</body>
</html>