<?php
session_start(); // Inicia la sesión

// Datos de conexión
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyectoprog";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Solo procesar si el formulario fue enviado por POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Obtener y limpiar los datos del formulario
    $email = trim($_POST['email']);
    $pass = $_POST['password'];

    // Buscar el usuario por email
    $sql = "SELECT id, nombre, password FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si el usuario existe
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Verificar contraseña
        if (password_verify($pass, $row['password'])) {
            // Guardar datos en sesión
            $_SESSION['usuario_id'] = $row['id'];
            $_SESSION['usuario_nombre'] = $row['nombre'];

            // Redirigir al inicio (o al dashboard)
            header("Location: ../Vista/index.html");
            exit();
        } else {
            echo "Contraseña incorrecta. <a href='login.html'>Intentar de nuevo</a>";
        }
    } else {
        echo "No existe una cuenta con ese correo. <a href='login.html'>Volver</a>";
    }

    $stmt->close();
}

$conn->close();
?>
