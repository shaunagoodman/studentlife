

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