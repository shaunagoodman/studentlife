
function randomRecipe() {
    swal({
        text: 'Search for a random recipe.',
      })
      .then(query => {
        if (!query) throw null;
        return fetch(`https://api.spoonacular.com/recipes/search?query=${query}&number=1&apiKey=53bea2eb3c79445188bc4d3f00895d15`);
    })
    .then(results => {
      return results.json();
    })
    .then(json => {
      const movie = json.results[0];
     
      if (!movie) {
        return swal("No movie was found!");
      }
     
      const name = "Name: " + movie.title;
      const id = "ID: " + movie.id;
      const stuff = name+ "\n" + id;
     
      swal({
        title: "It seems there are no results for your search. Why not try the following?:",
        text: stuff,
        button: {
            text: "Search!",
            closeModal: false,
          }
      });
    })
    .catch(err => {
      if (err) {
        swal("Oh noes!", "The AJAX request failed!", "error");
      } else {
        swal.stopLoading();
        swal.close();
      }
    });
}