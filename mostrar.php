<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "personas";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT id, nombre, email FROM usuarios";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuarios</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; font-family: Arial, sans-serif; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f2f2f2; }
        tr:nth-child(even) { background-color: #f9f9f9; }
    </style>
</head>
<body>
    <h2>Usuarios Registrados</h2>
    <a href="index.html">← Volver al formulario</a>

    <?php
    // 1. Verificamos si hubo un error en la consulta
    if (!$resultado) {
        echo "Error en la consulta: " . $conn->error;
    } 
    // 2. Verificamos si hay filas para mostrar
    elseif ($resultado->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Nombre</th><th>Email</th><th>Acciones</th></tr>";

        while($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila["id"] . "</td>"; 
            echo "<td>" . $fila["nombre"] . "</td>";
            echo "<td>" . $fila["email"] . "</td>"; 
            // Corregido: Todo el HTML dentro del echo con comillas correctas
            echo "<td>
                    <a href='editar.php?id=" . $fila["id"] . "'>Editar</a> | 
                    <a href='eliminar.php?id=" . $fila["id"] . "' style='color:red;'>Eliminar</a>
                  </td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>0 resultados encontrados.</p>";
    }

    $conn->close();
    ?>
</body>
</html>
