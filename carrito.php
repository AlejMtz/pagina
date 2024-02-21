<?php
session_start();

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['producto_id'])) {
        $producto_id = $_POST['producto_id'];

        // Agregar el producto al carrito (realiza las operaciones necesarias según tu lógica)
        $_SESSION['carrito'][] = $producto_id;
    }
}

// Mostrar el carrito
if (empty($_SESSION['carrito'])) {
    echo "El carrito está vacío.";
} else {
    echo "<h2>Carrito de compras</h2>";
    echo "<div id='carrito'>";
    foreach ($_SESSION['carrito'] as $producto_id) {
        // Realizar una consulta a la base de datos para obtener la información del producto
        $conexion = new mysqli("localhost", "root", "", "agendas");

        if ($conexion->connect_error) {
            die("Error en la conexión a la base de datos: " . $conexion->connect_error);
        }

        $query = "SELECT * FROM productos WHERE id = ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("i", $producto_id);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();
            echo "<div>";
            echo "<img src='" . htmlspecialchars($row['imagen']) . "' alt='Imagen del producto' style='max-width: 50px;'>";
            echo "Producto: " . htmlspecialchars($row['nombre']) . " - Precio: $" . number_format($row['precio'], 2) . " ";
            echo "<form action='carrito.php' method='post'>";
            echo "<input type='hidden' name='eliminar_producto' value='$producto_id'>";
            echo "<input type='submit' value='Eliminar'>";
            echo "</form>";
            echo "</div>";
        }

        $stmt->close();
        $conexion->close();
    }
    echo "</div>";
}

echo "<form action='proceso_de_compra.php' method='post'>";
echo "<input type='submit' value='Realizar Pedido'>";
echo "</form>";

?>
