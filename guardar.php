<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "personas"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Lógica para insertar (usando POST que es lo estándar para formularios)
if (isset($_POST['nombre']) && isset($_POST['email'])) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];

    $sql = "INSERT INTO usuarios (nombre, email) VALUES ('$nombre', '$email')";

    if ($conn->query($sql)) {
        echo "¡Usuario registrado con éxito!";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Aquí cerramos el PHP para escribir HTML puro de forma más fácil
?>

<!-- Este es el div con el enlace que pediste -->
<div style="margin-top: 20px; padding: 10px; background-color: #f0f0f0; border: 1px solid #ccc;">
    <a href="mostrar.php">Ver lista de usuarios registrados</a>
</div>

<?php
// Volvemos a abrir PHP para cerrar la conexión
$conn->close();
?>
