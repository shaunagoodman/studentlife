function findRecipe() {
  var checkList = document.getElementById('list1');
var items = document.getElementById('items');
        checkList.getElementsByClassName('anchor')[0].onclick = function (evt) {
            if (items.classList.contains('visible')){
                items.classList.remove('visible');
                items.style.display = "none";
            }
            
            else{
                items.classList.add('visible');
                items.style.display = "block";
            }
            
            
        }

        items.onblur = function(evt) {
            items.classList.remove('visible');
        }
  var request = new XMLHttpRequest();
  const urlString1 = "https://api.spoonacular.com/recipes/complexSearch?maxReadyTime=";
  const urlString2 = "&apiKey=53bea2eb3c79445188bc4d3f00895d15&query=";
  var ingredients =document.getElementById('ingredients').value;
  var maxTime =document.getElementById('time').value;
  var intolerance = document.getElementById("selectIntolerance").value;
  var dietRestriction = document.getElementById("selectDietRestriction").value;
  console.log(intolerance);
  console.log(dietRestriction);
    if(maxTime === "") {
      maxTime = 10;
    }
  var requestString = `${urlString1}${maxTime}${urlString2}${ingredients}&intolerances=${intolerance}&diet=${dietRestriction}`;
  console.log(requestString);
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
  const el = document.querySelector('#result');
    if (el.classList.contains("hide")) {
      el.classList.remove("hide");
  }
}
function viewRecipe () {
  document.getElementById("ingredientList").innerHTML = " ";
  document.getElementById("methodList").innerHTML = " ";
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
  var amount = [];
  var unit = [];
  if (request.status >= 200 && request.status < 400) { 
    if(data.extendedIngredients.length != 0) {
      for (i = 0; i< data.extendedIngredients.length; i++) {
      ingredients.push(data.extendedIngredients[i].name);
      amount.push(data.extendedIngredients[i].measures.metric.amount);
      unit.push(data.extendedIngredients[i].measures.metric.unitShort);
    }
    }
    else {
      ingredients.push("No ingredients");
    }
  if(data.analyzedInstructions != null) { 
    for(i = 0; i <data.analyzedInstructions[0].steps.length; i++) { 
      steps.push(data.analyzedInstructions[0].steps[i].step);
    }
  }
  else {
    steps.push("No ingredients listed.");
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
  var result = "";
  for(i = 0; i < steps.length; i++) {
    result += "<li>" + steps[i]+ "</li>";
  }
  document.getElementById("methodList").innerHTML += result;
  var favouriteButton = document.createElement("button");
  favouriteButton.innerHTML = "Add to Favourites";
  var aboveButton = document.getElementById("methodList");
  aboveButton.appendChild(favouriteButton);
  favouriteButton.setAttribute("class", "favouriteButton");
}
request.send();

}