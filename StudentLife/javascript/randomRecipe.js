let ingredients = [];
let cuisine = [];
let utensils = [];
let steps = [];
let amount = [];
let unit = [];
let title = "";
function findRecipe() {
  const el = document.querySelector('#displayedRecipe');
    if (el.classList.contains("hide")) {
      el.classList.remove("hide");
  }
  let titleArea = document.getElementById("recipeName");
  let timeArea = document.getElementById("time");
  let servingsArea = document.getElementById("servings");
  let cuisineArea = document.getElementById("cuisine");
  let methodListArea = document.getElementById("methodList");
  let ingredientListArea = document.getElementById("ingredientList");
  let equipmentArea = document.getElementById("equipment");
  titleArea.innerHTML = "";
  timeArea.innerHTML = "";
  servingsArea.innerHTML = "";
  cuisineArea.innerHTML = "";
  methodListArea.innerHTML = "";
  ingredientListArea.innerHTML = "";
  equipmentArea.innerHTML = "";
  let request = new XMLHttpRequest();
  let requestString = "https://api.spoonacular.com/recipes/random?number=1&apiKey=53bea2eb3c79445188bc4d3f00895d15";
  request.open("GET", requestString, true);
  request.onload = function() {
    let data = JSON.parse(this.response);
      if (request.status >= 200 && request.status < 400) {
        for (i = 0; i< data.recipes.length; i++) {
          let title = data.recipes[0].title;
          // GET IMAGE
          let image = data.recipes[0].image;
          let time = data.recipes[0].readyInMinutes;
          let servings = data.recipes[0].servings;
        
        // GET INGREDIENTS
          for (i = 0; i< data.recipes[0].extendedIngredients.length; i++) {
        if(!ingredients.includes(data.recipes[0].extendedIngredients[i].name)) {
          ingredients.push(data.recipes[0].extendedIngredients[i].name);
          amount.push(data.recipes[0].extendedIngredients[i].measures.metric.amount);
          unit.push(data.recipes[0].extendedIngredients[i].measures.metric.unitShort);
        }
      }
         
          // GET STEPS
    if(data.recipes[0].analyzedInstructions.length > 0) {
      let stepArr = data.recipes[0].analyzedInstructions[0].steps;

      if(data.recipes[0].analyzedInstructions === null) {
        steps.push("No steps listed.");
      }
      else {
        for(i = 0; i <stepArr.length; i++) { // 0   5
          if(!steps.includes(stepArr[i].step)) {
            steps.push(stepArr[i].step);
          }
        }
      }
     
   
     
      //GET EQUIPMENT
      for(i = 0; i < stepArr.length; i++) {
        for(j = 0; j < stepArr[i].equipment.length; j++) {
          if (stepArr[i].equipment[j] != null) {
            if(!utensils.includes(stepArr[i].equipment[j].name)) {
            utensils.push(stepArr[i].equipment[j].name);
            }
          }
          else utensils.push("No equipment listed");
        }
      }
    }
    else {
      utensils.push("No equipment listed");
      steps.push("No steps listed");
    }
         
         
          //DISPLAY
          titleArea.innerHTML += title + "</br>";          
          timeArea.innerHTML +=  time + " minutes.";
          servingsArea.innerHTML += servings;
          
          let imageArea = document.getElementById("image");
          var img = document.createElement("img");
          img.src = image;
          var src = document.getElementById("image");
          src.appendChild(img);

         
          for(i = 0; i < ingredients.length; i++) {
            ingredientListArea.innerHTML += amount[i] + " " + unit[i] + " " + ingredients[i] + "</br>";
          }
          // Equipment
          for(i = 0; i < utensils.length; i++) {
            equipmentArea.innerHTML += utensils[i] + "</br>";
          }
          if(utensils.length = 0) {
            equipmentArea.innerHTML += "No equipment listed" + "</br>";
          }
          //Method
          let result = "";
          for(i = 0; i < steps.length; i++) {
            result += "<li>" + steps[i]+ "</li>";
          }
          methodListArea.innerHTML += result;
        }
    }
    else {
      swal({  title: 'Something has gone wrong!',
                     text: 'We have no available recipes right now. Please try again later!',  
                    type: 'fail',    
                    showCancelButton: false,   
                    closeOnConfirm: false,   
                    confirmButtonText: 'Aceptar', 
                    showLoaderOnConfirm: true, }).then(function() {
                        window.location = 'index.php';
                    });
                  }
  }
  request.send();
}
