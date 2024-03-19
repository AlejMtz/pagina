<?php
session_start(); // Iniciar la sesión

$conexion = new mysqli("localhost", "root", "", "agendas");

if ($conexion->connect_error) {
    die("Error en la conexión a la base de datos: " . $conexion->connect_error);
}

$query = "SELECT * FROM productos";
$resultado = $conexion->query($query);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/3.4.0/model-viewer.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.4.0/p5.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>PROCESADORES - Productos</title>
    <link rel="icon" href="img/icono.jpg">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            text-decoration: none;
            list-style: none;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            background-image: linear-gradient(rgba(0, 0, 0, 0.7),
                    rgba(0, 0, 0, 0.7)),
                url(https://cdn.glitch.global/fa65af7c-32f2-4615-893a-5a9cf4c54001/procesador_2.jpg?v=1706063711861);
            background-position: center bottom;
            background-repeat: no-repeat;
            background-size: cover;
            min-height: 80vh;
            display: flex;
            align-items: center;
            padding: 80px 0 0 0;
        }

        .menu {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            color: white;
            font-size: 60px;
            font-weight: 800;
            text-transform: uppercase;
            position: relative;
            animation: moveLogo 5s infinite linear;
            text-shadow: -2px -2px 0 black, 2px -2px 0 black, -2px 2px 0 black, 2px 2px 0 black;
            text-decoration: none; 
        }

        @keyframes moveLogo {
            0% {
                left: 0;
                /* Posición inicial, sin desplazamiento lateral */
            }

            50% {
                left: 20px;
                /* Desplazamiento hacia la derecha en la mitad de la animación */
            }

            100% {
                left: 0;
                /* Posición final, sin desplazamiento lateral */
            }
        }

        .menu .navbar ul li {
            position: relative;
            float: left;
        }

        .menu .navbar ul li a {
            font-size: 30px;
            padding: 20px;
            color: aliceblue;
            display: block;
            font-weight: 600;
            text-decoration: none; 
        }

        .menu .navbar ul li a:hover {
            color: lightcoral;
        }

        .menu .navbar ul {
            list-style: none; 
        }

        #menu {
            display: none;
        }

        .menu-icono {
            width: 25px;
        }

        .menu label {
            cursor: pointer;
            display: none;
        }

        .header-content {
            text-align: center;
            position: relative;
        }

        .header-txt {
            position: relative;
            perspective: 2000px;
        }

        .header-txt h1 {
            font-size: 72px;
            font-weight: bold;
            color: white;
            text-transform: uppercase;
            position: relative;
            transform: translateZ(-20px);
            animation: rotate 5s linear infinite;
            text-shadow: -2px -2px 0 black, 2px -2px 0 black, -2px 2px 0 black, 2px 2px 0 black;
        }

        @keyframes rotate {
            0% {
                transform: rotateX(0deg) translateY(0px);
            }

            50% {
                transform: rotateX(180deg) translateY(-10px);
            }

            100% {
                transform: rotateX(360deg) translateY(0px);
            }
        }

        .header-txt span {
            font-size: 75px;
            color: aliceblue;
        }

        .header-img {
            width: 50%;
            text-align: center;
        }

        .header-img img {
            width: 450px;
        }

        button img {
            max-width: 40px;
            max-height: 40px;
            margin-right: 5px;
            vertical-align: middle;
        }

        .navbar ul li a img {
            max-width: 50px;
            max-height: 50px;
            margin-right: 5px;
            vertical-align: middle;
        }

        .general-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 35px;
        }

        .general-txt {
    text-align: center;
    border-radius: 25px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    flex: 0 0 calc(33.33% - 35px);
    max-width: calc(33.33% - 35px);
    margin-bottom: 35px;
    padding-bottom: 35px;
}

        .general-txt h3 {
            font-size: 50px;
            color: #292933;
            margin-bottom: 40px;
        }

        .general-txt p {
            color: black;
        }

        .general-txt img {
            max-width: 200px;
            margin-bottom: 15px;
        }

        .general-txt model-viewer {
            width: 200px;
            height: 200px;
            margin-bottom: 15px;
        }

        .general-txt form {
            margin-top: 15px;
        }

        .general-txt input[type='submit'] {
            font-size: 20px;
            padding: 10px 15px;
            background-color: #292933;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .general-txt input[type='submit']:hover {
            background-color: lightcoral;
        }

        .general-txt h3 {
            font-size: 30px;
            color: #292933;
            margin-bottom: 10px;
        }

        .menu-pl {
    padding: 0.5cm 0 1cm 0; 
    text-align: center;
    position: relative;
}

.menu-pl h2 {
    font-size: 40px;
    color: #292933;
    margin-bottom: 0.5cm; 
    margin-top: 0.5cm; 
}

#alerta {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #27AE60;
            color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            z-index: 9999;
        }


.footer {
    background-color: whitesmoke; 
    padding: 40px 0;
    text-align: center;
    margin-top: -5cm; 
}

.contact-info {
    display: flex;
    flex-direction: column; 
    align-items: center;
    font-size: 18px;
    margin-bottom: 20px;
    text-align: center;
}

.contact-info h5,
.contact-info p {
    margin: 0;
    padding: 10px;
    font-size: 18px; 
    text-align: center; 
    width: 100%; 
}
.col-12.mb-4 {
    display: flex;
    flex-direction: row; 
    align-items: center;
    justify-content: center;
}


.btn-social {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    text-align: center;
    line-height: 60px;
    font-size: 28px;
    margin-right: 10px; 
    background-color: #fff; 
    color: black; 
    border: 2px solid black; 
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background-color 0.3s, color 0.3s;
}
.btn-social:hover {
    background-color: #000000; 
    color: #fff; 
}

.btn-1 {
    display: flex;
    align-items: center;
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
  margin-top: 0.5cm; 
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
  margin-top: 0.5cm; 
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
  margin-top: 0.5cm; 
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

@keyframes blink {
    0% { opacity: 1; }
    50% { opacity: 0; }
    100% { opacity: 1; }
}

.alert {
    padding: 10px;
    margin-top: 10px;
    border-radius: 5px;
    animation: blink 5s infinite;
}

    </style>
            <script src="coloresDalto.js" defer></script>

</head>

<body>
    <header class="header">
        <div class="menu container">
            <a href="#" class="logo">PROCESADORES DE
                <br> ALIMENTOS</a>
            <input type="checkbox" id="menu" />
            <nav class="navbar">
                <ul>
                    <li>
                        <a href="index.html">
                            <img src="img/inicio.jpg" alt="Inicio"> Inicio
                        </a>
                    </li>
                    <li>
                        <a href="carrito.php" class="btn-1">
                            <img src="img/carrito2.jpg" alt="Comprar">
                            Comprar
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="header-content container">
            <div class="header-txt">
                <h1>PRODUCTOS</h1>
            </div>
        </div>
    </header>

    <div id="alerta"></div>

    <section class="menu-pl container">

    <!-- Botón para cambiar al inglés -->
<button id="englishButton">Change to English</button>

<!-- Botón para cambiar al español -->
<button id="spanishButton">Cambiar a Español</button>

<button id="colorBlindButton">Cambiar colores para daltonismo</button>

        <h2>Nuestros Productos</h2>
        <div id="interactAlert" class="alert" style="background-color: #fbeee0; color: black;">
        <i class="fas fa-info-circle"></i> Utiliza el cursor para girar y hacer zoom en los modelos 3D.
    </div>
    </section>


    <?php
if ($resultado->num_rows > 0) {
    echo "<div class='general-content container'>";
    while ($row = $resultado->fetch_assoc()) {
        echo "<div class='general-txt'>";
        echo "<h3>" . $row['nombre'] . "</h3>";
        echo "<p> " . $row['descripcion'] . "</p>";
        echo "<p>Precio: $" . $row['precio'] . "</p>";
        echo "<p>Stock:" . $row['stock'] . "</p>";
        echo "<img src='" . $row['imagen'] . "' alt='Imagen del producto' style='max-width: 200px;'><br>";

        // Modelo 3D
        echo "<model-viewer src='" . $row['modelo3d'] . "' style='width: 200px; height: 200px; margin-left:20%;' camera-controls auto-rotate></model-viewer><br>";

        // Agregar botón "Agregar al carrito"
        echo "<form onsubmit='agregarAlCarrito(event, " . $row['id'] . ", \"" . $row['imagen'] . "\", " . $row['stock'] . ")'>";
        echo "<button type='submit' style='background: none; border: none; cursor: pointer; width: 120px; height: 40px;'>";
        echo "<img src='img/carrito.jpg' alt='Agregar al carrito' style='max-width: 120%; max-height: 120%;'>";
        echo "</button>";
        echo "</form>";

        echo "</div>"; // Cierre de div .general-txt
    }
    echo "</div>"; // Cierre de div .general-content
} else {
    echo "No hay productos disponibles.";
}

$conexion->close();
?>

<script>
    function mostrarAlerta(mensaje) {
        // Mostrar la alerta con el mensaje proporcionado
        var alerta = document.getElementById('alerta');
        alerta.innerHTML = mensaje;
        alerta.style.backgroundColor = "#E0DEDE"; // Puedes cambiar el color de fondo según tu preferencia
        alerta.style.display = 'block';

        // Ocultar la alerta después de 5 segundos
        setTimeout(function () {
            alerta.style.display = 'none';
        }, 1000);
    }

    function agregarAlCarrito(event, productoId, imagen, stock) {
        event.preventDefault(); // Evitar la acción predeterminada del formulario

        // Verificar si hay suficiente stock
        if (stock > 0) {
            // Realizar una solicitud AJAX para agregar el producto al carrito
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // La solicitud se ha completado con éxito
                    mostrarAlerta("Producto agregado al carrito");

                    // Agregar la imagen del producto al carrito
                    var carrito = document.getElementById('carrito');
                    var nuevoElemento = document.createElement('div');
                    nuevoElemento.innerHTML = "<img src='" + imagen + "' alt='Imagen del producto en el carrito' style='max-width: 50px;'>";

                    carrito.appendChild(nuevoElemento);
                }
            };

            // Configurar la solicitud AJAX
            xhr.open("POST", "agregar_al_carrito.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            // Enviar la solicitud con el ID del producto
            xhr.send("producto_id=" + productoId);
        } else {
            mostrarAlerta("No hay suficiente stock disponible.");
        }
    }
</script>

<div class="container-fluid footer bg-light py-5" style="margin-top: 90px;">
        <div class="container text-center py-5">
            <div class="row">
                <div class="col-12 mb-4">
                <a href="" class="navbar-brand m-0">
                    <h1 class="m-0 mt-n2 display-4 text-primary"><span class="text-secondary" style="color: black;">"Procesadores de Alimentos"</span></h1>
                </a>
                </div>
                <div class="col-12 mb-4">
                    <a class="btn btn-outline-secondary btn-social mr-2" href="https://wa.me/527292253156?text=Hola%20Chatbot" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                    </a>                    
                    <a class="btn btn-outline-secondary btn-social mr-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="btn btn-outline-secondary btn-social" href=" ">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>                
    <div class="contact-info">
        <div class="contact">
            <h5 class="font-weight-bold mb-2">Ponerse en contacto</h5>
        </div>
    </div>

    <script>
        // Función para cambiar el contenido al inglés
function changeToEnglish() {
    // Limpiar el contenido del span antes de actualizarlo
    document.querySelector('h1 span').innerText = ""; // Borrar el contenido anterior
    // Cambiar el contenido de los elementos relevantes a inglés
    document.querySelector('h2').innerText = "Our Products";
    document.querySelector('.logo').innerText = "FOOD PROCESSORS";
    document.querySelector('.header-txt h1').innerText = "PRODUCTS";

    // Cambiar texto de botón de inicio
    document.querySelectorAll('.navbar ul li')[0].querySelector('a').innerHTML = "<img src='img/inicio.jpg' alt='Inicio'> Home";

    // Cambiar texto de botón de carrito
    document.querySelectorAll('.navbar ul li')[1].querySelector('a').innerHTML = "<img src='img/carrito2.jpg' alt='Comprar'> Buy";
}

// Función para cambiar el contenido al español
function changeToSpanish() {
    // Limpiar el contenido del span antes de actualizarlo
    document.querySelector('h1 span').innerText = ""; // Borrar el contenido anterior
    // Cambiar el contenido de los elementos relevantes a español
    document.querySelector('h2').innerText = "Nuestros Productos";
    document.querySelector('.logo').innerText = "PROCESADORES DE ALIMENTOS";
    document.querySelector('.header-txt h1').innerText = "PRODUCTOS";

    // Mantener texto de botón de inicio
    document.querySelectorAll('.navbar ul li')[0].querySelector('a').innerHTML = "<img src='img/inicio.jpg' alt='Inicio'> Inicio";

    // Mantener texto de botón de carrito
    document.querySelectorAll('.navbar ul li')[1].querySelector('a').innerHTML = "<img src='img/carrito2.jpg' alt='Comprar'> Comprar";
}

// Manejador de eventos para el botón de cambio de idioma a inglés
document.getElementById("englishButton").addEventListener("click", changeToEnglish);

// Manejador de eventos para el botón de cambio de idioma a español
document.getElementById("spanishButton").addEventListener("click", changeToSpanish);
    </script>

</body>

</html>
