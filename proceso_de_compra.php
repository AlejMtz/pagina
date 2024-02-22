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
    #popup-form {
      width: 400px;
      margin: 50px auto;
      text-align: center;
      position: relative;
      font-family: Montserrat, sans-serif;
    }

    #popup-form .popup-content {
      background: white;
      border: 0 none;
      border-radius: 3px;
      box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
      padding: 20px 30px;
      box-sizing: border-box;
      width: 80%;
      margin: 0 10%;
      position: relative;
    }

    #popup-form label {
      display: block;
      text-align: left;
      margin: 10px 0;
    }

    #popup-form input {
      padding: 15px;
      border: 1px solid #ccc;
      border-radius: 3px;
      margin-bottom: 10px;
      width: 100%;
      box-sizing: border-box;
      font-family: montserrat;
      color: #2C3E50;
      font-size: 13px;
    }

    #popup-form button {
      width: 100px;
      background: #27AE60;
      font-weight: bold;
      color: white;
      border: 0 none;
      border-radius: 1px;
      cursor: pointer;
      padding: 10px;
      margin: 10px 5px;
      text-decoration: none;
      font-size: 14px;
    }

    #popup-form h2 {
      font-size: 15px;
      text-transform: uppercase;
      color: #2C3E50;
      margin-bottom: 10px;
    }

    #popup-form h3 {
      font-weight: normal;
      font-size: 13px;
      color: #666;
      margin-bottom: 20px;
    }

    /* Alerta de éxito */
    .alert {
      position: fixed;
      top: 50%;
      right: calc(5cm);
      transform: translate(0, -50%);
      background: #27AE60;
      color: white;
      padding: 15px;
      border-radius: 5px;
      display: none;
    }

  </style>
</head>
<body>';

echo '<div id="popup-form" class="popup-form">';
echo '<div class="popup-content">';
echo '<h2>Proceso de Compra</h2>';
echo '<p>¡Gracias por realizar tu pedido!</p>';

// Formulario para ingresar datos del comprador
echo '<h3>Ingrese sus datos de comprador</h3>';
echo '<form id="msform" action="procesar_comprador.php" method="post">';
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
echo '<button type="submit" class="action-button" onclick="mostrarAlerta()">Enviar</button>';
echo '</form>';
echo '</div>';
echo '</div>';

// Alerta
echo '<div class="alert" id="myAlert">Datos ingresados correctamente</div>';

// Script de JavaScript para mostrar la alerta
echo '<script>';
echo 'function mostrarAlerta() {';
echo '    document.getElementById("myAlert").style.display = "block";';
echo '    setTimeout(function() {';
echo '        document.getElementById("myAlert").style.display = "none";';
echo '    }, 4000);';  // Ocultar la alerta después de 3 segundos
echo '}';
echo '</script>';

echo '</body></html>';
?>
