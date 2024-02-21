<?php
session_start(); // Iniciar la sesión

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['producto_id'])) {
    $productoId = $_GET['producto_id'];

    // Conectar a la base de datos (debes completar con tus propias credenciales)
    $conexion = new mysqli("localhost", "root", "", "agendas");

    if ($conexion->connect_error) {
        die("Error en la conexión a la base de datos: " . $conexion->connect_error);
    }

    // Obtener la información del producto
    $query = "SELECT * FROM productos WHERE id = $productoId";
    $resultado = $conexion->query($query);

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();

        // Mostrar el formulario de actualización con la información actual
        echo "<h2>Actualizar Producto</h2>";
        echo "<form action='guardar_actualizacion.php' method='post'>";
        echo "<input type='hidden' name='producto_id' value='" . $row['id'] . "'>";
        echo "<label for='nombre'>Nombre:</label>";
        echo "<input type='text' id='nombre' name='nombre' value='" . $row['nombre'] . "' required><br>";
        echo "<label for='descripcion'>Descripcion:</label>";
        echo "<input type='text' id='descripcion' name='descripcion' value='" . $row['descripcion'] . "' required><br>";
        echo "<label for='precio'>Precio:</label>";
        echo "<input type='number' id='precio' name='precio' value='" . $row['precio'] . "' required><br>";
        echo "<label for='stock'>Stock:</label>";
        echo "<input type='number' id='stock' name='stock' value='" . $row['stock'] . "' required><br>";
        echo "<label for='imagen'>Imagen:</label>";
        echo "<input type='file' id='imagen' name='imagen' value='" . $row['imagen'] . "' required><br>";
        echo "<label for='modelo3d'>Modelo 3d (.glb):</label>";
        echo "<input type='file' id='modelo3d' name='modelo3d' value='" . $row['modelo3d'] . "' required><br>";        
        // ... (resto de campos)
        echo "<button type='submit'>Guardar Actualización</button>";
        echo "</form>";
    } else {
        echo "Producto no encontrado.";
    }

    $conexion->close();
}
?>
