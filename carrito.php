<?php
session_start();

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['producto_id'])) {
        $producto_id = $_POST['producto_id'];

        if (!in_array($producto_id, $_SESSION['carrito'])) {
            $_SESSION['carrito'][] = $producto_id;
        }
    }

    if (isset($_POST['eliminar_producto'])) {
        $eliminar_producto_id = $_POST['eliminar_producto'];

        // Buscar y eliminar el producto del carrito
        $_SESSION['carrito'] = array_values(array_diff($_SESSION['carrito'], array($eliminar_producto_id)));
    }
}

// Mostrar el carrito
if (empty($_SESSION['carrito'])) {
    echo "El carrito está vacío.";
} else {
    echo "<h2>Carrito de compras</h2>";
    echo "<ul>";
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
            echo "<li>Producto: " . htmlspecialchars($row['nombre']) . " - Precio: $" . number_format($row['precio'], 2) . " ";
            echo "<form action='carrito.php' method='post'>";
            echo "<input type='hidden' name='eliminar_producto' value='$producto_id'>";
            echo "<input type='submit' value='Eliminar'>";
            echo "</form></li>";
        }

        $stmt->close();
        $conexion->close();
    }
    echo "</ul>";
}
?>
