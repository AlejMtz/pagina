<?php
session_start();

// Verifica si hay productos en el carrito
if (isset($_SESSION["carrito"]) && count($_SESSION["carrito"]) > 0) {
    foreach ($_SESSION["carrito"] as $producto) {
        // Aquí puedes mostrar los detalles del producto en el carrito
        echo "<p>" . $producto["nombre"] . " - $" . $producto["precio"] . "</p>";
    }
} else {
    echo "El carrito está vacío.";
}
?>
