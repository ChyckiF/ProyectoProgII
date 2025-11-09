<?php
// Datos de conexión
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyectoprog";

// Conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener y limpiar los datos
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Verificar si el correo ya está registrado
    $check = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "El correo ya está registrado. <a href='register.html'>Volver</a>";
    } else {
        // Insertar nuevo usuario
        $sql = "INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $nombre, $email, $pass);

        if ($stmt->execute()) {
            header("Location: ../Vista/login.html");
        } else {
            echo "Error al registrar: " . $stmt->error;
        }

        $stmt->close();
    }

    $check->close();
}

$conn->close();
?>
