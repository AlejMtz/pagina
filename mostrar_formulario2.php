<?php
session_start();

// Puedes realizar acciones de procesamiento aquí, como almacenar la orden en la base de datos, enviar correos electrónicos, etc.

// Limpiar el carrito después de realizar el pedido
unset($_SESSION['carrito']);

echo "<h2>Proceso de Compra</h2>";
echo "<p>¡Gracias por realizar tu pedido!</p>";

// Mostrar el segundo formulario
echo '<div class="wrapper">';
echo '    <div class="container">';
echo '        <form action="procesar_segundo_formulario.php" method="post">';
echo '            <h1>';
echo '                <i class="fas fa-shipping-fast"></i>';
echo '                Detalles de Envio';
echo '            </h1>';
echo '            <div class="name">';
echo '            </div>';
echo '            <div class="direccion">';
echo '                <label for="name">Dirección</label>';
echo '                <input type="text" name="direccion">';
echo '            </div>';
echo '            <div class="address-info">';
echo '                <div>';
echo '                    <label for="ciudad">Ciudad</label>';
echo '                    <input type="text" name="ciudad">';
echo '                </div>';
echo '                <div>';
echo '                    <label for="estado">Estado</label>';
echo '                    <input type="text" name="estado">';
echo '                </div>';
echo '                <div>';
echo '                    <label for="codigo">Codigo Postal</label>';
echo '                    <input type="text" name="codigo">';
echo '                </div>';
echo '            </div>';
echo '            <h1>';
echo '                <i class="far fa-credit-card"></i> Información del Pago';
echo '            </h1>';
echo '            <div class="cc-num">';
echo '                <label for="card-num">No. Tarjeta de Credito</label>';
echo '                <input type="text" name="card-num">';
echo '            </div>';
echo '            <div class="cc-info">';
echo '                <div>';
echo '                    <label for="card-num">Exp</label>';
echo '                    <input type="text" name="expire">';
echo '                </div>';
echo '                <div>';
echo '                    <label for="card-num">CCV</label>';
echo '                    <input type="text" name="security">';
echo '                </div>';
echo '            </div>';
echo '            <div class="btns">';
echo '                <button type="submit" onclick="mostrarAlerta()">Pagar</button>';
echo '                <button>Back to cart</button>';
echo '            </div>';
echo '        </form>';
echo '    </div>';
echo '</div>';

// Script de JavaScript para mostrar la alerta
echo '<script>';
echo 'function mostrarAlerta() {';
echo '    alert("¡Compra realizada con éxito!");';
echo '}';
echo '</script>';
?>
