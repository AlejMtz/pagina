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
echo '<button id="spanishButton">Change to Spanish</button>';
echo '</div>';

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

echo '<script>
// Función para cambiar el contenido al inglés
function changeToEnglish() {
    // Cambiar el contenido del formulario a inglés
    document.querySelectorAll(\'form label\').forEach(function(element) {
        switch (element.textContent.trim()) {
            case "Nombre:":
                element.textContent = "Name:";
                break;
            case "Apellidos:":
                element.textContent = "Last Name:";
                break;
            case "Teléfono:":
                element.textContent = "Phone:";
                break;
            case "Correo electrónico:":
                element.textContent = "Email:";
                break;
            default:
                break;
        }
    });

    // Cambiar el texto del botón
    document.querySelector(\'form button[type="submit"]\').textContent = "Submit";
}

// Función para cambiar el contenido al español
function changeToSpanish() {
    // Cambiar el contenido del formulario a español
    document.querySelectorAll(\'form label\').forEach(function(element) {
        switch (element.textContent.trim()) {
            case "Name:":
                element.textContent = "Nombre:";
                break;
            case "Last Name:":
                element.textContent = "Apellidos:";
                break;
            case "Phone:":
                element.textContent = "Teléfono:";
                break;
            case "Email:":
                element.textContent = "Correo electrónico:";
                break;
            default:
                break;
        }
    });

    // Cambiar el texto del botón
    document.querySelector(\'form button[type="submit"]\').textContent = "Enviar";
}

// Manejador de eventos para el botón de cambio de idioma a inglés
document.getElementById("englishButton").addEventListener("click", changeToEnglish);

// Manejador de eventos para el botón de cambio de idioma a español
document.getElementById("spanishButton").addEventListener("click", changeToSpanish);
</script>';

echo '</body></html>';
?>
