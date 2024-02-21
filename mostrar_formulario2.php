<?php
session_start();

// Puedes realizar acciones de procesamiento aquí, como almacenar la orden en la base de datos, enviar correos electrónicos, etc.

// Limpiar el carrito después de realizar el pedido
unset($_SESSION['carrito']);

echo '<html>
<head>
  <style>
    /* custom font */
    @import url(https://fonts.googleapis.com/css?family=Montserrat);

    /* basic reset */
    * {margin: 0; padding: 0;}

    html {
      height: 100%;
      /* Image only BG fallback */

      /* background = gradient + image pattern combo */
      background: linear-gradient(rgba(196, 102, 0, 0.6), rgba(155, 89, 182, 0.6));
    }

    body {
      font-family: montserrat, arial, verdana;
    }
    
    /* form styles */
    .wrapper {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    .container {
      background: white;
      border: 0 none;
      border-radius: 3px;
      box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
      padding: 20px 30px;
      box-sizing: border-box;
      width: 400px; /* Adjusted width for consistency */
      position: relative;
    }

    .container h1 {
      font-size: 20px;
      text-transform: uppercase;
      color: #2C3E50;
      margin-bottom: 10px;
    }

    .container i {
      margin-right: 10px;
    }

    .container label {
      display: block;
      text-align: left;
      margin: 10px 0;
    }

    .container input {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 3px;
      margin-bottom: 10px;
      width: 100%;
      box-sizing: border-box;
      font-family: montserrat;
      color: #2C3E50;
      font-size: 13px;
    }

    .container .btns {
      display: flex;
      justify-content: space-between;
      margin-top: 20px;
    }

    .container button {
      width: 45%;
      background: #27AE60;
      font-weight: bold;
      color: white;
      border: 0 none;
      border-radius: 1px;
      cursor: pointer;
      padding: 10px;
      text-decoration: none;
      font-size: 14px;
    }

    .container button:last-child {
      background: #3498db;
    }

  </style>
</head>
<body>';

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
echo '</body></html>';
?>
