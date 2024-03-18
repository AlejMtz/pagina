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

    /* Center the alert */
    .alert {
      position: fixed;
      top: 50%;
      right: calc(4cm); /* Ajustado para estar 5 cm a la derecha */
      transform: translate(0, -50%);
      background: #27AE60;
      color: white;
      padding: 15px;
      border-radius: 5px;
      display: none;
    }

    #colorBlindContainer {
      position: absolute;
      top: 2cm; /* Mover el contenedor 2cm hacia abajo */
      left: 2cm; /* Mover el contenedor 2cm hacia la derecha */
    }

    #colorBlindButton {
      background-color: #fbeee0;
      border: 2px solid #422800;
      border-radius: 30px;
      box-shadow: #422800 4px 4px 0 0;
      color: #422800;
      cursor: pointer;
      display: inline-block;
      font-weight: 600;
      font-size: 18px;
      padding: 0 18px;
      line-height: 50px;
      text-align: center;
      text-decoration: none;
      user-select: none;
      -webkit-user-select: none;
      touch-action: manipulation;
    }
    
    #colorBlindButton:hover {
      background-color: #fff;
    }
    
    #colorBlindButton:active {
      box-shadow: #422800 2px 2px 0 0;
      transform: translate(2px, 2px);
    }
    
    @media (min-width: 768px) {
      #colorBlindButton {
        min-width: 120px;
        padding: 0 25px;
      }
    }

    #englishButton {
      position: absolute;
      top: 5cm; /* Mover el contenedor 2cm hacia abajo */
      left: 2cm; /* Mover el contenedor 2cm hacia la derecha */
    }

    #englishButton {
      background-color: #fbeee0;
      border: 2px solid #422800;
      border-radius: 30px;
      box-shadow: #422800 4px 4px 0 0;
      color: #422800;
      cursor: pointer;
      display: inline-block;
      font-weight: 600;
      font-size: 18px;
      padding: 0 18px;
      line-height: 50px;
      text-align: center;
      text-decoration: none;
      user-select: none;
      -webkit-user-select: none;
      touch-action: manipulation;
    }
    
    #englishButton:hover {
      background-color: #fff;
    }
    
    #englishButton:active {
      box-shadow: #422800 2px 2px 0 0;
      transform: translate(2px, 2px);
    }
    
    @media (min-width: 768px) {
      #englishButton {
        min-width: 120px;
        padding: 0 25px;
      }
    }

    #spanishButton {
      position: absolute;
      top: 8cm; /* Mover el contenedor 2cm hacia abajo */
      left: 2cm; /* Mover el contenedor 2cm hacia la derecha */
    }

    #spanishButton {
      background-color: #fbeee0;
      border: 2px solid #422800;
      border-radius: 30px;
      box-shadow: #422800 4px 4px 0 0;
      color: #422800;
      cursor: pointer;
      display: inline-block;
      font-weight: 600;
      font-size: 18px;
      padding: 0 18px;
      line-height: 50px;
      text-align: center;
      text-decoration: none;
      user-select: none;
      -webkit-user-select: none;
      touch-action: manipulation;
    }
    
    #spanishButton:hover {
      background-color: #fff;
    }
    
    #spanishButton:active {
      box-shadow: #422800 2px 2px 0 0;
      transform: translate(2px, 2px);
    }
    
    @media (min-width: 768px) {
      #spanishButton {
        min-width: 120px;
        padding: 0 25px;
      }
    }

  </style>
  <script src="coloresDalto.js" defer></script>
</head>
<body>';

echo '<div id="colorBlindContainer">';
echo '<button id="colorBlindButton">Cambiar colores para daltonismo</button>';
echo '</div>';

echo '<div id="languageButton">';
echo '<button id="englishButton">Change to English</button>';
echo '</div>';

echo '<div id="languageButton">';
echo '<button id="spanishButton">Cambiar a Español</button>';
echo '</div>';


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
echo '                <button type="button" onclick="regresarAlCarrito()">Regresar al Carrito</button>';
echo '            </div>';
echo '        </form>';
echo '    </div>';
echo '</div>';


echo '<div class="alert" id="myAlert">¡Compra realizada con éxito!</div>';

// Script de JavaScript para mostrar la alerta
echo '<script>';
echo 'function mostrarAlerta() {';
echo '    document.getElementById("myAlert").style.display = "block";';
echo '    setTimeout(function() {';
echo '        document.getElementById("myAlert").style.display = "none";';
echo '    }, 3000);';  // Ocultar la alerta después de 3 segundos
echo '}';
echo 'function regresarAlCarrito() {';
echo '    window.location.href = "carrito.php";';  // Redirigir al carrito
echo '}';
echo '</script>';
echo '</body></html>';

echo '<script>
// Función para cambiar el contenido al inglés
function changeToEnglish() {
    // Cambiar el contenido del formulario a inglés
    document.querySelectorAll(\'form label\').forEach(function(element) {
        switch (element.textContent.trim()) {
            case "Dirección":
                element.textContent = "Address";
                break;
            case "Ciudad":
                element.textContent = "City";
                break;
            case "Estado":
                element.textContent = "State";
                break;
            case "Codigo Postal":
                element.textContent = "Postal Code";
                break;
            case "No. Tarjeta de Credito":
                element.textContent = "Credit Card Number";
                break;
            case "Exp":
                element.textContent = "Expire";
                break;
            case "CCV":
                element.textContent = "CCV";
                break;
            default:
                break;
        }
    });

    // Cambiar el texto de los botones
    document.querySelectorAll(\'form button\').forEach(function(button) {
        switch (button.textContent.trim()) {
            case "Pagar":
                button.textContent = "Pay";
                break;
            case "Regresar al Carrito":
                button.textContent = "Return to Cart";
                break;
            default:
                break;
        }
    });

    // Cambiar los títulos
    document.querySelector(\'.container h1\').textContent = "Shipping Details";
    document.querySelectorAll(\'.container h1\')[1].textContent = "Payment Information";
}



// Función para cambiar el contenido al español
function changeToSpanish() {
    // Cambiar el contenido del formulario a español
    document.querySelectorAll(\'form label\').forEach(function(element) {
        switch (element.textContent.trim()) {
            case "Address":
                element.textContent = "Dirección";
                break;
            case "City":
                element.textContent = "Ciudad";
                break;
            case "State":
                element.textContent = "Estado";
                break;
            case "Postal Code":
                element.textContent = "Codigo Postal";
                break;
            case "Credit Card Number":
                element.textContent = "No. Tarjeta de Credito";
                break;
            case "Expire":
                element.textContent = "Exp";
                break;
            case "CCV":
                element.textContent = "CCV";
                break;
            default:
                break;
        }
    });

    // Cambiar el texto de los botones
    document.querySelectorAll(\'form button\').forEach(function(button) {
        switch (button.textContent.trim()) {
            case "Pay":
                button.textContent = "Pagar";
                break;
            case "Return to Cart":
                button.textContent = "Regresar al Carrito";
                break;
            default:
                break;
        }
    });

    // Cambiar los títulos
    document.querySelector(\'.container h1\').textContent = "Detalles de Envío";
    document.querySelectorAll(\'.container h1\')[1].textContent = "Información del Pago";
}

// Manejador de eventos para el botón de cambio de idioma a inglés
document.getElementById("englishButton").addEventListener("click", changeToEnglish);

// Manejador de eventos para el botón de cambio de idioma a español
document.getElementById("spanishButton").addEventListener("click", changeToSpanish);
</script>';

?>
