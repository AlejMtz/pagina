<?php
session_start();

// Reemplaza estos valores con los de tu base de datos
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_de_datos = "agendas";

// Conexión a la base de datos
$conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Agregar producto al carrito
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $producto_id = $_POST["producto_id"];

    // Recupera información del producto desde la base de datos
    $consulta = "SELECT id, nombre, precio FROM productos WHERE id = $producto_id";
    $resultado = $conexion->query($consulta);

    if ($resultado->num_rows > 0) {
        $producto = $resultado->fetch_assoc();

        // Asegúrate de que estás extrayendo el precio correctamente
        $precio = $producto["precio"];

        // Agrega el producto al carrito (puedes almacenar el carrito en la sesión)
        if (!isset($_SESSION["carrito"])) {
            $_SESSION["carrito"] = [];
        }

        // Agrega el producto al carrito con su precio
        $producto["cantidad"] = 1; // Puedes ajustar la cantidad según tus necesidades
        array_push($_SESSION["carrito"], $producto);

        // Redirige a la página del carrito
        header("Location: carrito.html");
        exit();
    } else {
        echo "Producto no encontrado.";
    }
}

$conexion->close();
?>
