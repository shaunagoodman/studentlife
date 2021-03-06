

function myFunction() {
    swal("Sorry!", "This is a work in progress!", "warning");
}

function favouritePopUp() {
    swal({
        title: 'Not Logged In!',
        text: 'You must be logged in to favourite a recipe.',
        type: 'success',
        showCancelButton: false,
        closeOnConfirm: false,
        confirmButtonText: 'Aceptar',
        showLoaderOnConfirm: true,
    }).then(function () {
        window.location = 'login.php';
    });;
}

function thankYou() {
    swal({
        title: 'We have received your message!',
        text: 'It means a lot to us, we will get back in touch shortly.',
        type: 'success',
        showCancelButton: false,
        closeOnConfirm: false,
        confirmButtonText: 'Aceptar',
        showLoaderOnConfirm: true,
    }).then(function () {
        window.location = 'index.php';
    });;
}
function noAccess() {
    swal({
        title: 'Oops!',
        text: 'It seems you do not have access to this page. Please contact your administrator.',
        type: 'success',
        showCancelButton: false,
        closeOnConfirm: false,
        confirmButtonText: 'Aceptar',
        showLoaderOnConfirm: true,
    }).then(function () {
        window.location = 'index.php';
    });;
}

function deactivated() {
    swal({  title: 'Account Deactivated!',
    text: 'Please contact us if you wish for your details to be permanently deleted from our records',  
   type: 'success',    
   showCancelButton: false,   
   closeOnConfirm: false,   
   confirmButtonText: 'Aceptar', 
   showLoaderOnConfirm: true, }).then(function() {
       window.location = 'logout.php';
   });;
}

function APIError() {
    swal({
        title: "Oops!",
        type: "fail",
        text: "Spoonacular seems to be having problems returning more data. Please try again tomorrow."
    });
}
function noRecipe() {
    swal({
        title: "Oops!",
        type: "fail",
        text: "There's no recipe matching your criteria. Why not try another?"
    });
}
function recipeDeleted() {
    swal({  title: 'Recipe Deleted!',  
   type: 'success',    
   showCancelButton: false,   
   closeOnConfirm: false,   
   confirmButtonText: 'Aceptar', 
   showLoaderOnConfirm: true, }).then(function() {
       window.location = 'admin.php';
   });;
}
function recipeAdded() {
    swal({  title: 'Recipe Added',  
       type: 'success',    
       showCancelButton: false,   
       closeOnConfirm: false,   
       confirmButtonText: 'Aceptar', 
       showLoaderOnConfirm: true, }).then(function() {
           window.location = 'recipes-list.php';
       });;
}

function commentFail() {
    swal({  title: 'Cannot post comment!',  
    text: 'You must be logged in to leave a comment.',
       type: 'fail',    
       showCancelButton: false,   
       closeOnConfirm: false,   
       confirmButtonText: 'Aceptar', 
       showLoaderOnConfirm: true, }).then(function() {
           window.location = 'login.php';
       });;
}