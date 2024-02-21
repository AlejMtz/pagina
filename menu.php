<?php
session_start(); // Iniciar la sesión

$conexion = new mysqli("localhost", "root", "", "agendas");

if ($conexion->connect_error) {
    die("Error en la conexión a la base de datos: " . $conexion->connect_error);
}

$query = "SELECT * FROM productos";
$resultado = $conexion->query($query);

if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        echo "<h3>" . $row['nombre'] . "</h3>";
        echo "<p>Descripción: " . $row['descripcion'] . "</p>";
        echo "<p>Precio: $" . $row['precio'] . "</p>";
        echo "<p>Stock:" . $row['stock'] . "</p>";
        echo "<img src='" . $row['imagen'] . "' alt='Imagen del producto' style='max-width: 200px;'><br>";
        echo "<model-viewer src='" . $row['modelo3d'] . "' style='width: 200px; height: 200px;'></model-viewer><br>";

        // Agregar botón "Agregar al carrito"
        echo "<form action='carrito.php' method='post'>";
        echo "<input type='hidden' name='producto_id' value='" . $row['id'] . "'>";
        echo "<input type='submit' value='Agregar al carrito'>";
        echo "</form>";
    }
} else {
    echo "No hay productos disponibles.";
}

$conexion->close();
?>
