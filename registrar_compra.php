<?php
include 'informacion_bd.php';

// Verificar si hubo un error en la conexión
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

// Recibir datos del carrito desde la solicitud POST
$data = json_decode(file_get_contents("php://input"));

if ($data) {
    $total = $data->total;
    $items = $data->items;
    
    // Insertar cada producto en la base de datos
    foreach ($items as $item) {
        if ($item !== null) {
            $nombreProducto = $item->name;
            $precioProducto = $item->price;

            // Realizar la inserción en la tabla 'compras'
            $sql = "INSERT INTO compras (nombre_producto, precio_producto,fecha_compra) VALUES ('$nombreProducto', $precioProducto,NOW())";

            if ($conexion->query($sql) !== TRUE) {
                echo json_encode(["error" => "Error al guardar en la base de datos"]);
                $conexion->close();
                exit;
            }
        }
        
    }
    echo json_encode(["total" => $total]);
} else {
    echo json_encode(["error" => "Datos no recibidos"]);
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>