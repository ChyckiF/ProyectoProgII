const CerrarSesion = document.getElementById('CerrarSesion');
CerrarSesion.addEventListener('click', () => {
    //Preguntar al usuario si esta seguro de cerrar sesion
    const confirmar = confirm('¿Estás seguro de que deseas cerrar sesión?');
    if (confirmar) {
        //redireccionar a la pagina de login
        window.location.href = 'login.html';
    }
});

