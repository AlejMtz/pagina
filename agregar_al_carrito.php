<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['producto_id'])) {
    $producto_id = $_POST['producto_id'];

    // Agregar el producto al carrito (realiza las operaciones necesarias según tu lógica)
    $_SESSION['carrito'][] = $producto_id;

    // Puedes realizar otras operaciones aquí si es necesario

    echo "success"; // Devuelve una respuesta para indicar el éxito de la operación
} else {
    echo "error"; // Devuelve una respuesta para indicar un error si es necesario
}
?>
