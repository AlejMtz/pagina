<?php
// Conectar a la base de datos (debes completar con tus propias credenciales)
$conexion = new mysqli("localhost", "root", "", "agendas");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error en la conexión a la base de datos: " . $conexion->connect_error);
}

// Realizar una consulta para obtener los productos
$query = "SELECT * FROM productos";
$resultado = $conexion->query($query);

if ($resultado->num_rows > 0) {
    // Mostrar la información de los productos
    while ($row = $resultado->fetch_assoc()) {
        echo "<h3>" . $row['nombre'] . "</h3>";
        echo "<p>Descripción: " . $row['descripcion'] . "</p>";
        echo "<p>Precio: $" . $row['precio'] . "</p>";
        echo "<p>Stock: $" . $row['stock'] . "</p>";
        echo "<img src='" . $row['imagen'] . "' alt='Imagen del producto' style='max-width: 200px;'><br>";
        echo "<model-viewer src='" . $row['modelo3d'] . "' style='width: 200px; height: 200px;'></model-viewer><br>";

        // Agregar botón "Agregar al carrito"
        echo "<form action='agregar_al_carrito.php' method='post'>";
        echo "<input type='hidden' name='producto_id' value='" . $row['id'] . "'>";
        echo "<input type='submit' value='Agregar al carrito'>";
        echo "</form>";
    }
} else {
    echo "No hay productos disponibles.";
}

// Cerrar la conexión
$conexion->close();
?>
