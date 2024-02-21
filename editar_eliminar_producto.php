<?php
session_start(); // Iniciar la sesión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conexion = new mysqli("localhost", "root", "", "agendas");

    if ($conexion->connect_error) {
        die("Error en la conexión a la base de datos: " . $conexion->connect_error);
    }

    $productoId = $_POST['producto_id'];

    if (isset($_POST['actualizar'])) {
        // Redirigir a la página de actualización con el ID del producto
        header("Location: actualizar_producto.php?producto_id=" . urlencode($productoId));
        exit();
    } elseif (isset($_POST['eliminar'])) {
        // Eliminar el producto de la base de datos
        $query = "DELETE FROM productos WHERE id = $productoId";

        if ($conexion->query($query) === TRUE) {
            $mensaje = "Producto eliminado con éxito.";
        } else {
            $mensaje = "Error al eliminar el producto: " . $conexion->error;
        }

        // Redirigir a la página de administración con el mensaje
        header("Location: admin.php?mensaje=" . urlencode($mensaje));
        exit();
    }

    $conexion->close();
}
?>
