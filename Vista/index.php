<?php
session_start();

// Si no hay sesión activa, redirige al login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"> <!-- CARACTERES ESPECIALES -->
  <title>Proyecto Programación</title> <!-- TITULO -->
  <link rel="stylesheet" href="estilos.css"> <!-- CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"> <!-- ICONOS -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

  <main class="contenedor"> <!-- CONTENEDOR -->
    <div class="stars"></div> <!-- ESTRELLAS ANIMACION -->
    <div class="Fondo"></div> <!-- Fondo -->

    <!-- ========= LOGO ========= -->
    <img src="Resources/CineTackImg.png" alt="Imagen Logo" width="300" height="200" > <!-- LOGO -->

    <!-- ========= BOTONES ========= -->
    <button class="button1" id="btn-home"><i class="fa-solid fa-house"></i><span>Home</span></button>
    <button class="button2"><i class="fa-solid fa-list"></i><span>Explorar</span></button>
    <button class="button3"><i class="fa-solid fa-user"></i><span>Perfil</span></button>

    <!-- ========= Dropdown ========= -->
    <div class="dropdown">
      <button class="dropbtn"><i class="fa-solid fa-bars"></i><span>Menu</span></button>
      <div class="dropdown-content">
        <a href="#"><i class="fa-solid fa-list"></i><span>Mis listas</span></a>
        <a href="#"><i class="fa-solid fa-star"></i><span>Favoritos</span></a>
        <a href="#" id="CerrarSesion"><i class="fa-solid fa-right-to-bracket"></i></i><span>Cerrar sesión</span></a>
      </div>
    </div>
  
    <div class="overlay"> <!-- OVERLAY -->
    <h1 class="titulo">Recomendado</h1> <!-- TITULO -->

    <!-- ===== VENTANA BIENVENIDA ===== -->
    <div class="welcome-box" id="box1"></div>
    <div class="welcome-box2" id="box2"></div>
    <div class="welcome-box3" id="box3"></div>
    <div class="welcome-box4" id="box4"></div>

  </div>
  

  </main>
  <script src="../Controlador/index.js"></script> <!-- JS -->
  <script src="../Controlador/login.js"></script> <!-- JS LOGIN -->
  <script src="../Controlador/register.js"></script> <!-- JS REGISTER -->
</body>
</html>
