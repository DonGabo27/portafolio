<?php
// Mostrar errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verificar que sea POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Solicitud incorrecta. Debe ser POST.");
}

// Validar campos requeridos
if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message'])) {
    die("Faltan datos obligatorios.");
}

// Conectar a la base de datos
$conexion = new mysqli("localhost", "root", "", "miappapk");

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Sanitizar entradas
$nombre = $conexion->real_escape_string($_POST['name']);
$email = $conexion->real_escape_string($_POST['email']);
$asunto = isset($_POST['subject']) ? $conexion->real_escape_string($_POST['subject']) : '';
$mensaje = $conexion->real_escape_string($_POST['message']);

// Insertar en la base de datos
$sql = "INSERT INTO mensajes_contacto (nombre, email, asunto, mensaje) VALUES (?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ssss", $nombre, $email, $asunto, $mensaje);

if ($stmt->execute()) {
    echo "OK";
} else {
    echo "Error: " . $stmt->error;
}

// Cerrar conexión
$stmt->close();
$conexion->close();
?>