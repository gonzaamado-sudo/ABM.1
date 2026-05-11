<?php
// Activar errores para no ver más la pantalla en blanco si algo falla
ini_set('display_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "personas"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// --- PARTE 1: PROCESAR LA ACTUALIZACIÓN (Cuando el usuario envía el formulario) ---
if (isset($_POST['actualizar'])) {
    $id = intval($_POST['id']);
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];

    $sql = "UPDATE usuarios SET nombre='$nombre', email='$email' WHERE id=$id";

    if ($conn->query($sql)) {
        header("Location: mostrar.php"); // Volver a la lista
        exit();
    } else {
        echo "Error al actualizar: " . $conn->error;
    }
}

// --- PARTE 2: CARGAR DATOS ACTUALES (Para mostrar en los inputs) ---
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $resultado = $conn->query("SELECT * FROM usuarios WHERE id = $id");
    $usuario = $resultado->fetch_assoc();
} else {
    die("ID no proporcionado.");
}
?>


    <h2>Editar Usuario</h2>
    <form method="POST" action="editar.php?id=<?php echo $id; ?>">
        <!-- Campo oculto para enviar el ID -->
        <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
        
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $usuario['nombre']; ?>" required>
        
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $usuario['email']; ?>" required>
        
        <button type="submit" name="actualizar">Guardar Cambios</button>
        <a href="mostrar.php">Cancelar</a>
    </form>
</body>
</html>

<?php $conn->close(); ?>
