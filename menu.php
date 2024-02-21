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
        echo "<form onsubmit='agregarAlCarrito(event, " . $row['id'] . ", \"" . $row['imagen'] . "\", " . $row['stock'] . ")'>";
        echo "<input type='submit' value='Agregar al carrito'>";
        echo "</form>";        
        
    }
} else {
    echo "No hay productos disponibles.";
}

$conexion->close();
?>

<script>
function agregarAlCarrito(event, productoId, imagen, stock) {
    event.preventDefault(); // Evitar la acción predeterminada del formulario

    // Verificar si hay suficiente stock
    if (stock > 0) {
        // Realizar una solicitud AJAX para agregar el producto al carrito
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // La solicitud se ha completado con éxito
                alert("Producto agregado al carrito");

                // Agregar la imagen del producto al carrito
                var carrito = document.getElementById('carrito');
                var nuevoElemento = document.createElement('div');
                nuevoElemento.innerHTML = "<img src='" + imagen + "' alt='Imagen del producto en el carrito' style='max-width: 50px;'>";

                carrito.appendChild(nuevoElemento);
            }
        };

        // Configurar la solicitud AJAX
        xhr.open("POST", "agregar_al_carrito.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Enviar la solicitud con el ID del producto
        xhr.send("producto_id=" + productoId);
    } else {
        alert("No hay suficiente stock disponible.");
    }
}
</script>
