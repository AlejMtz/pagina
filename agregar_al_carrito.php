<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['producto_id'])) {
        $producto_id = $_POST['producto_id'];

        
        if (verificarStockDisponible($producto_id)) {
            $carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : array();
        
            // Verificar si el producto ya está en el carrito
            $encontrado = false;
            foreach ($carrito as &$item) {
                if ($item['id'] == $producto_id) {
                    $item['cantidad'] += 1; // Incrementar la cantidad si ya está en el carrito
                    $encontrado = true;
                    break;
                }
            }
        
            if (!$encontrado) {
                // Agregar el producto al carrito con cantidad 1
                $carrito[] = array('id' => $producto_id, 'cantidad' => 1);
            }
        
            $_SESSION['carrito'] = $carrito;
        
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