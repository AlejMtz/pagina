<?php
session_start(); // Iniciar la sesión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conexion = new mysqli("localhost", "root", "", "agendas");

    if ($conexion->connect_error) {
        die("Error en la conexión a la base de datos: " . $conexion->connect_error);
    }

    // Obtener los datos actualizados del formulario
    $productoId = $_POST['producto_id'];
    $nuevoNombre = $_POST['nombre'];
    $nuevoDescripcion = $_POST['descripcion'];
    $nuevoPrecio = $_POST['precio'];
    $nuevoStock = $_POST['stock'];
    $nuevoImagen = $_POST['imagen'];
    $nuevoModelo3d = $_POST['modelo3d'];
    // ... (resto de campos)

    // Actualizar los datos en la base de datos
    $query = "UPDATE productos SET nombre = '$nuevoNombre' WHERE id = $productoId";
    $query = "UPDATE productos SET descripcion = '$nuevoDescripcion' WHERE id = $productoId";
    $query = "UPDATE productos SET precio = '$nuevoPrecio' WHERE id = $productoId";
    $query = "UPDATE productos SET stock = '$nuevoStock' WHERE id = $productoId";
    $query = "UPDATE productos SET imagen = '$nuevoImagen' WHERE id = $productoId";
    $query = "UPDATE productos SET modelo3d = '$nuevoModelo3d' WHERE id = $productoId";

    if ($conexion->query($query) === TRUE) {
        $mensaje = "Producto actualizado con éxito.";
    } else {
        $mensaje = "Error al actualizar el producto: " . $conexion->error;
    }

    // Redirigir a la página de administración con el mensaje
    header("Location: admin.php?mensaje=" . urlencode($mensaje));
    exit();

    $conexion->close();
}
?>
