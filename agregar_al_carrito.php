<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['producto_id'])) {
        $producto_id = $_POST['producto_id'];

        
        if (verificarStockDisponible($producto_id)) {
            
            $_SESSION['carrito'][] = $producto_id;

            
            actualizarStock($producto_id);
            
            echo "Producto agregado al carrito";
        } else {
            echo "No hay suficiente stock disponible.";
        }
    }
}

function verificarStockDisponible($producto_id) {
    $conexion = new mysqli("localhost", "root", "", "agendas");

    if ($conexion->connect_error) {
        die("Error en la conexión a la base de datos: " . $conexion->connect_error);
    }

    $query = "SELECT stock FROM productos WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $producto_id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        $stock = $row['stock'];

        // Verificar si hay suficiente stock
        if ($stock > 0) {
            return true;
        } else {
            return false;
        }
    }

    $stmt->close();
    $conexion->close();

    return false;
}

function actualizarStock($producto_id) {
    $conexion = new mysqli("localhost", "root", "", "agendas");

    if ($conexion->connect_error) {
        die("Error en la conexión a la base de datos: " . $conexion->connect_error);
    }

    $query = "UPDATE productos SET stock = stock - 1 WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $producto_id);
    $stmt->execute();

    $stmt->close();
    $conexion->close();
}
?>
