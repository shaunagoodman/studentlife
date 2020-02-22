function findRecipe() {
  let request = new XMLHttpRequest();
  const urlString1 = "https://api.spoonacular.com/recipes/complexSearch?maxReadyTime=";
  const urlString2 = "&apiKey=53bea2eb3c79445188bc4d3f00895d15&query=";
  let ingredients =document.getElementById('ingredients').value;
  let maxTime =document.getElementById('time').value;
  let intolerances = getIntolerances();
  let dietRestriction = getDietRestrictions();
  if(maxTime === "") {
    maxTime = 30;
  }
  let requestString;
  if(intolerances.length == 0 && dietRestriction == 0) {
      requestString = `${urlString1}${maxTime}${urlString2}${ingredients}`;
  }
  else if(intolerances.length == 0 && dietRestriction != 0) {
      requestString = `${urlString1}${maxTime}${urlString2}${ingredients}&diet=${dietRestriction}`;
  }
  else if(intolerances.length != 0 && dietRestriction == 0) {
      requestString = `${urlString1}${maxTime}${urlString2}${ingredients}&intolerances=${intolerances}`;
  }
  else {
      requestString = `${urlString1}${maxTime}${urlString2}${ingredients}&intolerances=${intolerances}&diet=${dietRestriction}`;
  }
  
 

  console.log(requestString);
  request.open("GET", requestString, true);
  request.onload = function() {
    let data = JSON.parse(this.response);
    if (request.status >= 200 && request.status < 400) {
    for (i = 0; i< data.results.length; i++) {
      let select = document.getElementById("selectIngredients");
      let id = data.results[i].id;
      let title = data.results[i].title;
      let el = document.createElement("option");
      el.textContent = title;
      el.value = id;
      select.appendChild(el);
    }
    }
  }
  request.send(); 
  const el = document.querySelector('#result');
    if (el.classList.contains("hide")) {
      el.classList.remove("hide");
  }
}
function viewRecipe () {
  document.getElementById("ingredientList").innerHTML = " ";
  document.getElementById("methodList").innerHTML = " ";
  let request = new XMLHttpRequest();
  let select = document.getElementById("selectIngredients");
  let id = select.value;
let urlString1 = "https://api.spoonacular.com/recipes/"
let urlString2 = "/information?apiKey=53bea2eb3c79445188bc4d3f00895d15";
let requestString = urlString1 + id + urlString2;
console.log(requestString);
request.open("GET", requestString, true);
request.onload = function() {
  let data = JSON.parse(this.response);
  let ingredients = [];
  let equipment = [];
  let steps = [];
  let amount = [];
  let unit = [];
  if (request.status >= 200 && request.status < 400) { 
    if(data.extendedIngredients.length != 0) {
      for (i = 0; i< data.extendedIngredients.length; i++) {
      ingredients.push(data.extendedIngredients[i].name);
      amount.push(data.extendedIngredients[i].measures.metric.amount);
      unit.push(data.extendedIngredients[i].measures.metric.unitShort);
    }
    }
    else {
      ingredients.push("No ingredients listed");
    }
  if(data.analyzedInstructions === null) { 
    steps.push("No steps listed.");
  }
  else {
    for(i = 0; i <data.analyzedInstructions[0].steps.length; i++) { 
      steps.push(data.analyzedInstructions[0].steps[i].step);
    }
  }


  }

  /* Only change below for where the method is being displayed*/
  document.querySelector("#recipeName").innerHTML = data.title;
  document.getElementById("ingredientList").innerHTML = "<h3 class = 'resultHeading'> Ingredients </h3> </br>"; // H for heading is set here
  for(i = 0; i < ingredients.length; i++) {
    document.getElementById("ingredientList").innerHTML += amount[i] + " " + unit[i] + " " + ingredients[i] + "</br>";
  }
  document.getElementById("ingredientList").innerHTML += "</br>";
  document.getElementById("methodList").innerHTML = "<h3 class = 'resultHeading'> Method </h3> </br>";// H for heading is set here
  let result = "";
  for(i = 0; i < steps.length; i++) {
    result += "<li>" + steps[i]+ "</li>";
  }
  document.getElementById("methodList").innerHTML += result;
  let favouriteButton = document.createElement("button");
  favouriteButton.innerHTML = "Add to Favourites";
  let aboveButton = document.getElementById("methodList");
  aboveButton.appendChild(favouriteButton);
  favouriteButton.setAttribute("class", "favouriteButton");
}
request.send();


}

function getIntolerances(){
  var intolerances=document.getElementsByName('intolerance');
  var selectedItems="";
  for(var i=0; i<intolerances.length; i++){
    if(intolerances[i].type=='checkbox' && intolerances[i].checked==true)
      selectedItems+=intolerances[i].value+",";
  }
  let newSelectedItems = selectedItems.substring(0, selectedItems.length - 1);
  return newSelectedItems;
}	

function getDietRestrictions(){
  var dietRestriction=document.getElementsByName('dietRestriction');
  var selectedItems="";
  for(var i=0; i<dietRestriction.length; i++){
    if(dietRestriction[i].type=='checkbox' && dietRestriction[i].checked==true)
      selectedItems+=dietRestriction[i].value+",";
  }
  let newSelectedItems = selectedItems.substring(0, selectedItems.length - 1);
  return newSelectedItems;
}	
let countIngredient = 1;
function addIngredient() {
  var area = document.getElementById("addedIngredient");
  var num = document.createElement("p");
  numText = document.createTextNode(countIngredient + ". ");
  num.appendChild(numText);
  area.appendChild(num);
  //Ingredient Name
  var ingredientNameLabel = document.createElement("p");
  ingredientNameLabelText = document.createTextNode("Name");
  ingredientNameLabel.appendChild(ingredientNameLabelText);
  area.appendChild(ingredientNameLabel);
  countIngredient++;

  var ingredientNameInput = document.createElement("INPUT");
  ingredientNameInput.setAttribute("name", "ingredient_name[]");
  ingredientNameInput.setAttribute("type", "text");
  ingredientNameInput.setAttribute("class", "form-control");
  ingredientNameInput.setAttribute("class", "ingName");
  area.appendChild(ingredientNameInput);

  //Ingredient Measure
  var ingredientMeasureLabel = document.createElement("p");
  ingredientMeasureLabelText = document.createTextNode("Measure");
  ingredientMeasureLabel.appendChild(ingredientMeasureLabelText);
  area.appendChild(ingredientMeasureLabel);

  var ingredientMeasureInput = document.createElement("INPUT");
  ingredientMeasureInput.setAttribute("name", "ingredient_measure[]");
  ingredientMeasureInput.setAttribute("type", "text");
  ingredientMeasureInput.setAttribute("class", "form-control");
  ingredientMeasureInput.setAttribute("class", "ingMeasure");
  area.appendChild(ingredientMeasureInput);

   //Ingredient Unit
   var ingredientUnitLabel = document.createElement("p");
   ingredientUnitLabelText = document.createTextNode("Unit");
   ingredientUnitLabel.appendChild(ingredientUnitLabelText);
   area.appendChild(ingredientUnitLabel);
 
   var ingredientUnitInput = document.createElement("INPUT");
   ingredientUnitInput.setAttribute("name", "ingredient_unit[]");
   ingredientUnitInput.setAttribute("type", "text");
   ingredientUnitInput.setAttribute("class", "form-control");
   ingredientUnitInput.setAttribute("class", "ingUnit");
   
   area.appendChild(ingredientUnitInput);
}
let countStep = 1;
function addStep() {
  var area = document.getElementById("addedStep");
  var step = document.createElement("p");
   stepText = document.createTextNode(countStep + ". ");
   countStep++;
   step.appendChild(stepText);
   area.appendChild(step);
 
   var stepInput = document.createElement("INPUT");
   stepInput.setAttribute("name", "steps[]");
   stepInput.setAttribute("type", "text");
   stepInput.setAttribute("class", "form-control");
   area.appendChild(stepInput);
}