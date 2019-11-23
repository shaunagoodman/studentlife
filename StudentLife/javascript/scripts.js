function findRecipe() {
var request = new XMLHttpRequest();
const urlString = "https://api.spoonacular.com/recipes/complexSearch?maxReadyTime=15&apiKey=53bea2eb3c79445188bc4d3f00895d15&query=";
var ingredients =document.getElementById('ingredients').value;
var requestString = urlString + ingredients;
request.open("GET", requestString, true);
request.onload = function() {
  var data = JSON.parse(this.response);
  if (request.status >= 200 && request.status < 400) {
    var idArr;
    var titleArr;
for (i = 0; i< data.results.length; i++) {
  var select = document.getElementById("selectIngredients");
  var id = data.results[i].id;
  var title = data.results[i].title;
  var el = document.createElement("option");
  el.textContent = title;
  el.value = id;
  select.appendChild(el);
}
}
}
request.send(); 
}
    //https://api.spoonacular.com/recipes/324694/analyzedInstructions?apiKey=53bea2eb3c79445188bc4d3f00895d15
function viewRecipe () {
  var request = new XMLHttpRequest();
  var select = document.getElementById("selectIngredients");
  var id = select.value;
var urlString1 = "https://api.spoonacular.com/recipes/"
var urlString2 = "/information?apiKey=53bea2eb3c79445188bc4d3f00895d15";
var requestString = urlString1 + id + urlString2;
console.log(requestString);
request.open("GET", requestString, true);
request.onload = function() {
  var data = JSON.parse(this.response);
  var ingredients = [];
  var equipment = [];
  var steps = [];
  if (request.status >= 200 && request.status < 400) {
    if(data.extendedIngredients != null) {
      for (i = 0; i< data.extendedIngredients.length; i++) {
      ingredients.push(data.extendedIngredients[i].name);
    }
    }
  if(data.analyzedInstructions != null) {
    for(i = 0; i <data.analyzedInstructions[0].steps.length; i++) {
      steps.push(data.analyzedInstructions[0].steps[i].step);
    }
  }
  }
  document.getElementById("selectedRecipe").innerHTML += "INGREDIENTS </br>";
  for(i = 0; i < ingredients.length; i++) {
    document.getElementById("selectedRecipe").innerHTML += ingredients[i] + "</br>";
  }
  document.getElementById("selectedRecipe").innerHTML += "</br>";
  document.getElementById("selectedRecipe").innerHTML += "STEPS </br>";
  for(i = 0; i < steps.length; i++) {
    document.getElementById("selectedRecipe").innerHTML += "Step " + (i+1) + ": " + steps[i] + "</br>";
  }
}
request.send();
}
