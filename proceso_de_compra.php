<?php
session_start();

// Puedes realizar acciones de procesamiento aquí, como almacenar la orden en la base de datos, enviar correos electrónicos, etc.

// Limpiar el carrito después de realizar el pedido
unset($_SESSION['carrito']);

echo "<h2>Proceso de Compra</h2>";
echo "<p>¡Gracias por realizar tu pedido!</p>";

// Formulario para ingresar datos del comprador
echo '<div id="popup-form" class="popup-form">';
echo '<div class="popup-content">';
echo '<span id="close-button" class="close-button">X</span>';
echo '<h3>Ingrese sus datos de comprador</h3>';
echo '<form action="procesar_comprador.php" method="post">';  // Cambiado a "procesar_comprador.php"
echo '<label for="nombre">Nombre:</label>';
echo '<input type="text" id="nombre" name="nombre" required>';
echo '<br>';
echo '<label for="apellidos">Apellidos:</label>';
echo '<input type="text" id="apellidos" name="apellidos" required>';
echo '<br>';
echo '<label for="telefono">Teléfono:</label>';
echo '<input type="text" id="telefono" name="telefono" required>';
echo '<br>';
echo '<label for="email">Correo electrónico:</label>';
echo '<input type="email" id="email" name="email" required>';
echo '<br>';
echo '<button type="submit" id="submitButton">';
echo '<img src="" alt="Texto alternativo de la imagen">';
echo 'Enviar';
echo '</button>';
echo '</form>';
echo '</div>';
echo '</div>';
?>
