require('./bootstrap');
// const Swal = require('sweetalert2');

window.loginFirst = () => {
    Swal.fire({
        title: 'Error!',
        text: 'Debes iniciar sesión para crear un evento',
        icon: 'error',
        confirmButtonText: 'Okay'
    })
}