<?php
session_start();

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['producto_id'])) {
        $producto_id = $_POST['producto_id'];

        // Agregar el producto al carrito (realiza las operaciones necesarias según tu lógica)
        agregarAlCarrito($producto_id);
    }

    // Verificar si se ha enviado el formulario para eliminar un producto
    if (isset($_POST['eliminar_producto'])) {
        $eliminar_producto_id = $_POST['eliminar_producto'];

        // Buscar la posición del producto en el carrito y eliminarlo
        eliminarDelCarrito($eliminar_producto_id);
    }
}

function agregarAlCarrito($producto_id) {
    // Puedes agregar lógica adicional aquí, por ejemplo, verificar el stock antes de agregar al carrito
    $_SESSION['carrito'][] = array('id' => $producto_id, 'cantidad' => 1);
}

function eliminarDelCarrito($producto_id) {
    // Buscar la posición del producto en el carrito
    $key = array_search($producto_id, array_column($_SESSION['carrito'], 'id'));
    if ($key !== false) {
        // Reducir la cantidad del producto en el carrito
        $_SESSION['carrito'][$key]['cantidad']--;

        // Eliminar el producto del carrito si la cantidad es 0 o menos
        if ($_SESSION['carrito'][$key]['cantidad'] <= 0) {
            unset($_SESSION['carrito'][$key]);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.4.0/p5.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <title>PROCESADORES - Carrito</title>
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
            /* Evitar subrayado en el título */
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
            /* Evitar subrayado en los elementos del menú */
        }

        .menu .navbar ul li a:hover {
            color: lightcoral;
        }

        .menu .navbar ul {
            list-style: none;
            /* Quitar los puntos de la lista del menú */
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

        #carrito-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin-top: 20px;
        }

        .menu-pl-item {
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 15px;
            padding: 15px;
            margin: 10px;
            width: 300px;
            text-align: center;
        }

        .menu-pl-item img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
        }

        .prices {
            margin-top: 10px;
        }

        .prices span {
            font-weight: bold;
            color: #333;
        }

        #form-realizar-pedido {
            text-align: center;
            margin-top: 1cm;
            /* 1cm hacia abajo */
        }

        #form-realizar-pedido input[type="image"] {
            text-align: center;
            width: 50px;
            /* Ajusta el ancho según tus necesidades */
            height: auto;
            /* Esto mantendrá la proporción original de la imagen */
            max-height: 150px;
            /* Ajusta la altura máxima según tus necesidades */
            margin-top: 1cm;
            /* 1cm hacia abajo */
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
  margin-left: 15cm; 
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

    </style>

<script src="coloresDalto.js" defer></script>

</head>

<body>

    <header class="header">
        <div class="menu container">
            <a href="#" class="logo">PROCESADORES DE <br> ALIMENTOS</a>
            <input type="checkbox" id="menu" />
            <nav class="navbar">
                <ul>
                    <li>
                        <a href="index.html">
                            <img src="img/inicio.jpg" alt="Inicio">
                            Inicio
                        </a>
                    </li>
                    <li>
                        <a href="menu.php">
                            <img src="img/productos.jpg" alt="Productos">
                            Productos
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="header-content container">
            <div class="header-txt">
                <h1>CARRITO</h1>
            </div>
        </div>
    </header>

    <button id="colorBlindButton">Cambiar colores para daltonismo</button>
    <br>


    <?php
    // Mostrar el carrito
    if (empty($_SESSION['carrito'])) {
        echo "El carrito está vacío.";
    } else {
        echo "<h2 style='text-align: center; font-size: 36px;'>Carrito de compras</h2>";
        echo "<div id='carrito-container' class='container'>"; // Agrega un contenedor
        // Realizar una sola consulta a la base de datos para obtener la información de todos los productos
        $conexion = new mysqli("localhost", "root", "", "agendas");

        if ($conexion->connect_error) {
            die("Error en la conexión a la base de datos: " . $conexion->connect_error);
        }

        $productos_ids = array_column($_SESSION['carrito'], 'id');
        $query = "SELECT * FROM productos WHERE id IN (" . implode(',', $productos_ids) . ")";
        $resultado = $conexion->query($query);

        foreach ($resultado as $row) {
            $producto_id = $row['id'];

            // Buscar la cantidad de este producto en el carrito
            $cantidad = 0;
            foreach ($_SESSION['carrito'] as $item) {
                if ($item['id'] == $producto_id) {
                    $cantidad = $item['cantidad'];
                    break;
                }
            }

            echo "<div class='menu-pl-item'>";
            echo "<h3>" . $row['nombre'] . "</h3>";
            echo "<div class='prices'>";
            echo "<span>$" . number_format($row['precio'] * $cantidad, 2) . "</span>";
            echo "</div>";
            echo "<p>Cantidad: " . $cantidad . "</p>";
            echo "<img src='" . htmlspecialchars($row['imagen']) . "' alt='Imagen del producto' style='max-width: 200px;'><br>";
            echo "<model-viewer src='" . htmlspecialchars($row['modelo3d']) . "' style='width: 200px; height: 200px;'></model-viewer><br>";

            // Agregar formulario con botón de eliminar como imagen
            echo "<form action='carrito.php' method='post' style='margin-top: -0.5cm;'>";
            echo "<input type='hidden' name='eliminar_producto' value='" . $producto_id . "'>";
            echo "<button type='submit' style='background: none; border: none; cursor: pointer; width: 40px; height: 40px;'>";
            echo "<img src='img/eliminar.jpg' alt='Eliminar producto' style='max-width: 110%; max-height: 110%;'>";
            echo "</button>";
            echo "</form>";

            echo "</div>"; // Cerrar el div del producto
        }

        $conexion->close();
        echo "</div>"; // Cerrar el contenedor
    }

    echo "<form action='proceso_de_compra.php' method='post' id='form-realizar-pedido'>";
    echo "<input type='image' src='img/comprar.jpg' alt='Realizar Pedido' style='max-width: 120px; max-height: 40px;'>";
    echo "</form>";
    ?>

</body>

</html>
