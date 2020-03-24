function chippy() {
    var txt = document.getElementById('ingredients');
    var list = document.getElementById('list1');
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
    function remove(i) {
      items = items.filter(item => items.indexOf(item) != i);
      render();
      
    }
    function render() {
      list.innerHTML = '';
      items.map((item, index) => {
        list.innerHTML += `<li><span>${item}</span><a href="javascript: void 0" onclick="LIB.remove(${index})">X</a></li>`;
      });
      var hidden = document.getElementById("hidden1");
      hidden.style.display = "none";
      var txt = items.toString();
      hidden.value = txt;
    }
    window.LIB = {
      remove:remove,
      render: render
    }
    
    
    window.onload = function() {
      render();
      txt.focus();
    }

    var tagsource1 = [
      'Dairy', 'Egg', 'Gluten', 'Grain', 'Peanut', 'Seafood', 'Sesame', 'Shellfish', 'Soy', 'Sulfite', 'Tree Nut', 'Wheat'
      ]
  $('#intolerances').tagging(tagsource1);

  var tagsource2 = [
    'Gluten', 'Ketogenic', 'Paleo', 'Pescetarian', 'Primal', 'Vegan', 'Vegetarian', 'Whole30'
    ]
$('#dietRestrictions').tagging(tagsource2);
}
