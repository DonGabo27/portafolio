<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "miappapk";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM mensajes_contacto ORDER BY fecha DESC");
echo "<h2>Mensajes recibidos</h2>";
echo "<table border='1' cellpadding='8'>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Asunto</th>
            <th>Mensaje</th>
            <th>Fecha</th>
        </tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['nombre']}</td>
        <td>{$row['email']}</td>
        <td>{$row['asunto']}</td>
        <td>{$row['mensaje']}</td>
        <td>{$row['fecha']}</td>
    </tr>";
}
echo "</table>";
$conn->close();
?>