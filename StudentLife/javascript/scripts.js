let ingredients = [];
let cuisine = [];
let utensils = [];
let steps = [];
let amount = [];
let unit = [];
let title = "";
function findRecipe() {
  let request = new XMLHttpRequest();
  const urlString1 = "https://api.spoonacular.com/recipes/complexSearch?maxReadyTime=";
  const urlString2 = "&apiKey=53bea2eb3c79445188bc4d3f00895d15&query=";
  let ingredients = document.getElementById('hidden1').value;
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
    if (data.results.length > 0) {
      if (request.status >= 200 && request.status < 400) {
        for (i = 0; i< data.results.length; i++) {
          let select = document.getElementById("selectIngredients");
          let id = data.results[i].id;
          let title = data.results[i].title;
          let el = document.createElement("option");
          el.textContent = title;
          el.value = id;
          el.setAttribute("name", "recipeResult");
          select.appendChild(el);
          if (select == null) {
            swal({  title: 'Something has gone wrong!',
                   text: 'There is no recipe which match your criteria. Please make a new search.',  
                  type: 'fail',    
                  showCancelButton: false,   
                  closeOnConfirm: false,   
                  confirmButtonText: 'Aceptar', 
                  showLoaderOnConfirm: true, }).then(function() {
                      window.location = 'recipe-api.php';
                  });
          }
        }
        }
    }
    else {
      swal({  title: 'Something has gone wrong!',
                   text: 'We do not have any recipes that match your search. Please try again!',  
                  type: 'fail',    
                  showCancelButton: false,   
                  closeOnConfirm: false,   
                  confirmButtonText: 'Aceptar', 
                  showLoaderOnConfirm: true, }).then(function() {
                      window.location = 'recipe-api.php';
                  });
    }
  }
  request.send(); 
  const el = document.querySelector('#result');
    if (el.classList.contains("hide")) {
      el.classList.remove("hide");
  }
}
function viewRecipe () {
  const el = document.querySelector('#displayedRecipe');
    if (el.classList.contains("hide")) {
      el.classList.remove("hide");
  }
  document.getElementById("ingredientList").innerHTML = " ";
  document.getElementById("methodList").innerHTML = " ";
  document.getElementById("servings").innerHTML = " ";
  document.getElementById("equipment").innerHTML = " ";
  document.getElementById("cuisine").innerHTML = " ";




  let request = new XMLHttpRequest();
  let select = document.getElementById("selectIngredients");
  let id = select.value;
  setCookie("recipe_ID", id);
let urlString1 = "https://api.spoonacular.com/recipes/";
let urlString2 = "/information?apiKey=53bea2eb3c79445188bc4d3f00895d15";
let requestString = urlString1 + id + urlString2;
request.open("GET", requestString, true);
request.onload = function() {
  let data = JSON.parse(this.response);
  title = data.title;
  if (request.status >= 200 && request.status < 400) {
    // GET CUISINE
    if(data.cuisines.length != 0) {
      for(i = 0; i < data.cuisines.length; i++) {
        cuisine.push(data.cuisines[i]);
      }
    }
    else {
      cuisine.push("No cuisine listed");
    }
    // GET IMAGE
    let image = data.image;

    //TIME 
    let time = data.readyInMinutes;
    // GET SERVINGS
    let servingsInt = JSON.parse(data.servings);

    // GET INGREDIENTS 
    if(data.extendedIngredients.length > 0) {
      for (i = 0; i< data.extendedIngredients.length; i++) {
        if(!ingredients.includes(data.extendedIngredients[i].name)) {
          ingredients.push(data.extendedIngredients[i].name);
          amount.push(data.extendedIngredients[i].measures.metric.amount);
          unit.push(data.extendedIngredients[i].measures.metric.unitShort);
        }
      }
    }
    else {
      ingredients.push("No ingredients listed");
    }
    // GET STEPS
    if(data.analyzedInstructions.length > 0) {
      let stepArr = data.analyzedInstructions[0].steps;

      if(data.analyzedInstructions === null) { 
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
  

  /* Only change below for where the method is being displayed*/
  // Image
  let imageArea = document.getElementById("image");
  var img = document.createElement("img");
  img.src = image;
  imageArea.appendChild(img);
  //Time
  let timeArea = document.getElementById("maxTime");
  timeArea.innerHTML = time;
  
  // Recipe Name
  let titleArea = document.getElementById("recipeName");
  titleArea.innerHTML += title;

  // //Servings
  let servingsArea = document.getElementById("servings");
  servingsArea.innerHTML += servingsInt;

  // Cuisine
  for(i = 0; i < cuisine.length; i++) {
    document.getElementById("cuisine").innerHTML += cuisine[i] + "</br>";
  }
  // document.getElementById("cuisine").innerHTML += "</br>";

  //Ingredients
  for(i = 0; i < ingredients.length; i++) {
    document.getElementById("ingredientList").innerHTML += amount[i] + " " + unit[i] + " " + ingredients[i] + "</br>";
  }
  document.getElementById("ingredientList").innerHTML += "</br>";

  // Equipment
  for(i = 0; i < utensils.length; i++) {
    document.getElementById("equipment").innerHTML += utensils[i] + "</br>";
  }
  document.getElementById("equipment").innerHTML += "</br>";

  //Method
  let result = "";
  for(i = 0; i < steps.length; i++) {
    result += "<li>" + steps[i]+ "</li>";
  }
  document.getElementById("methodList").innerHTML += result;
}
else {
  swal({  title: 'Something has gone wrong!',
  text: 'There is no recipe which match your criteria. Please make a new search.',  
 type: 'fail',    
 showCancelButton: false,   
 closeOnConfirm: false,   
 confirmButtonText: 'Aceptar', 
 showLoaderOnConfirm: true, }).then(function() {
     window.location = 'recipe-api.php';
 });
}
}
request.send();


}

function toggleIntolerances() {
  var checked = document.getElementById("selectIntolerance").checked;
  if (checked) {
    document.getElementById("intoleranceList").style.display = "block";
  } else {
    document.getElementById("intoleranceList").style.display = "none";
  }
}
function toggleDietRestrictions() {
  var checked = document.getElementById("selectDietRestriction").checked;
  if (checked) {
    document.getElementById("dietRestrictionsList").style.display = "block";
  } else {
    document.getElementById("dietRestrictionsList").style.display = "none";
  }
}
function toggleTime() {
  var checked = document.getElementById("addTime").checked;
  if (checked) {
    document.getElementById("addedTime").style.display = "block";
  } else {
    document.getElementById("addedTime").style.display = "none";
  }
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
 
   var select = document.createElement("SELECT");
  select.setAttribute("name", "ingredient_unit[]");
  area.appendChild(select);

  var option = document.createElement("option");
  option.setAttribute("value", "grams");
  var value = document.createTextNode("g");
  option.appendChild(value);
  select.appendChild(option);

  var option = document.createElement("option");
  option.setAttribute("value", "milimeters");
  var value = document.createTextNode("ml");
  option.appendChild(value);
  select.appendChild(option);

  var option = document.createElement("option");
  option.setAttribute("value", "kilograms");
  var value = document.createTextNode("kg");
  option.appendChild(value);
  select.appendChild(option);
  var option = document.createElement("option");
  option.setAttribute("value", "litres");
  var value = document.createTextNode("litre(s)");
  option.appendChild(value);
  select.appendChild(option);

  var option = document.createElement("option");
  option.setAttribute("value", "slice");
  var value = document.createTextNode("slice");
  option.appendChild(value);
  select.appendChild(option);
  
  var option = document.createElement("option");
  option.setAttribute("value", "whole");
  var value = document.createTextNode("whole");
  option.appendChild(value);
  select.appendChild(option);

  var option = document.createElement("option");
  option.setAttribute("value", "pinch");
  var value = document.createTextNode("pinch");
  option.appendChild(value);
  select.appendChild(option);

//   var b = document.createElement("option");
//   b.setAttribute("value", "ml");
//   var t = document.createTextNode("ml");
//  select.appendChild(t);
  
//     var c = document.createElement("option");
//   c.setAttribute("value", "kg");
//   var t = document.createTextNode("kg");
//   select.appendChild(t);
  
//     var d = document.createElement("option");
//   d.setAttribute("value", "litres");
//   var t = document.createTextNode("litres");
//   select.appendChild(t);
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

function displayEquipment() {
  for(i = 0; i < utensils.length; i++) {
    console.log(utensils[i] );
  }
}

function setCookie(cname, cvalue) {

  document.cookie = cname + "=" + cvalue + ";" + "path=/";

}

function chippy() {
  var txt = document.getElementById('ingredients');
var list = document.getElementById('list');
var items = [];

txt.addEventListener('keypress', function(e) {
  if (e.key === 'Enter') {
    let val = txt.value;
    if (val !== '') {
      if (items.indexOf(val) >= 0) {
        alert('Tag name is a duplicate');
      } else {
        items.push(val);
        render();
        txt.value = '';
        txt.focus();
      }
    } else {
      alert('Please type a tag Name');
    }
  }
});

function render() {
  list.innerHTML = '';
  items.map((item, index) => {
    list.innerHTML += `<li><span>${item}</span><a href="javascript: remove(${index})">X</a></li>`;
  });
}

function remove(i) {
  items = items.filter(item => items.indexOf(item) != i);
  render();
}

window.onload = function() {
  render();
  txt.focus();
}
}

function displayTime() {
  let time = document.getElementById("maxTime").value;
  let area = document.getElementById("timeArea");
  area.innerHTML = time + " minutes";
}