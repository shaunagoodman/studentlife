

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