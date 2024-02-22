<?php
$con = mysqli_connect("localhost", "root", "", "agendas") or die ("Error");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <link rel="icon" href="img/icono.jpg">
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/3.4.0/model-viewer.min.js"></script>
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
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-image: url("img/encabezado.jpg");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            height: 50vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            position: relative;
        }

        header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        h1 {
            text-align: center;
            font-size: 2em;
            z-index: 1;
            color: white;
            font-size: 80px;
            font-weight: 800;
            text-transform: uppercase;
            position: relative;
            animation: moveLogo 5s infinite linear;
            text-shadow: -2px -2px 0 black, 2px -2px 0 black, -2px 2px 0 black, 2px 2px 0 black;
        }

        @keyframes moveLogo {
            0% {
                left: 0;
            }
            50% {
                left: 20px;
            }
            100% {
                left: 0;
            }
        }

        form {
        text-align: center;
        background-color:  lightgrey;
        padding: 15px;
        border-radius: 15px;
        width: 30%;
        margin-top: 1cm; /* Ajusta el espacio vertical según tus necesidades */
        border: 2px solid transparent;
        transition: background-color 0.3s ease;
        position: relative;
        z-index: 1;
        margin-left: 3%; /* Ajusta el margen izquierdo según tus necesidades */
    }

    form label {
        color: black;
        font-size: 20px; /* Ajusta el tamaño de la fuente de las etiquetas según tus necesidades */
        font-weight: 10;
        display: block;
        margin-bottom: 8px; /* Ajusta el espacio entre etiquetas según tus necesidades */
    }

    form input,
    form textarea {
        width: 100%;
        padding: 8px; /* Ajusta el relleno de los campos de entrada según tus necesidades */
        margin-bottom: 8px; /* Ajusta el espacio entre campos según tus necesidades */
        box-sizing: border-box;
    }

    form button {
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 10px auto; /* Centra el botón horizontalmente y ajusta el espacio vertical según tus necesidades */
        padding: 12px 16px;
        border: none;
        cursor: pointer;
        color: white;
        border-radius: 5px;
        background-color: springgreen;
        font-size: 16px;
    }

    #imagenPreview {
        max-width: 100%; /* Ajusta el ancho máximo de la imagen previa según tus necesidades */
        display: none;
    }

    model-viewer {
        display: block;
        max-width: 100%;
    }

    h2 {
        font-size: 30px; 
        margin-top: 1cm; 
        margin-left: 8%; 
    }


    .table-responsive table th,
    .table-responsive table td {
    font-size: 14px; /* Ajusta el tamaño del texto según tus necesidades */
    }

    .table-container {
    width: 60%;
    margin-top: 1cm;
    display: inline-block;
    vertical-align: top;
}

.table-responsive {
    overflow-x: auto;
    background-color: lightgrey; /* Cambiado a gris claro */
    padding: 15px;
    border-radius: 15px;
    margin-left: 35%;
    margin-top: -20.7cm;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

th, td {
    padding: 10px;
    text-align: center;
    border: 1px solid black;
}

th {
    background-color: black;
    color: white;
}

        </style>
</head>
<body>

<header>
        <h1>Administrador</h1>
    </header>
    

<h2>Agregar Producto</h2>

<div style="text-align: center; margin-top: -2cm; margin-left: 25%;">
    <h2>Modificar Producto</h2>
</div>

<form id="productForm" enctype="multipart/form-data" action="agregar_producto.php" method="post">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required><br>

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="descripcion" required></textarea><br>

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="precio" step="0.01" required><br>

    <label for="stock">Stock:</label>
    <input type="number" id="stock" name="stock" step="1" required><br>

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" name="imagen" accept="image/*" onchange="previewImage()"><br>
    <img id="imagenPreview" alt="Imagen previa" style="max-width: 200px; display: none;"><br>

    <label for="modelo3d">Modelo 3D (.glb):</label>
<input type="file" id="modelo3d" name="modelo3d" accept=".glb" onchange="previewModel()"><br>
<model-viewer id="modelo"
              alt="Modelo 3D"
              shadow-intensity="2"
              camera-controls
              auto-rotate
              ar
              ar-modes="scene-viewer quick-look"
              src=""
              ios-src=""
              poster=""
></model-viewer>
    <button type="submit">Agregar Producto</button>
</form>

</div>

<div>
  <div
    class="table-responsive"
  >
    <table
      class="table table-primary"
    >
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">NOMBRE</th>
          <th scope="col">DESCRIPCION</th>
          <th scope="col">PRECIO</th>
          <th scope="col">STOCK</th>
          <th scope="col">IMAGEN</th>
          <th scope="col">MODELO 3D</th>
          <th scope="col">EDITAR</th>
          <th scope="col">ELIMINAR</th>
        </tr>

        <?php
        $consulta = "SELECT * FROM productos";
        $ejecutar = mysqli_query($con,$consulta);

        $i=0;

        while($fila=mysqli_fetch_array($ejecutar)){
          $id=$fila['id'];
          $nombre=$fila['nombre'];
          $descripcion=$fila['descripcion'];
          $precio=$fila['precio'];
          $stock=$fila['stock'];
          $imagen=$fila['imagen'];
          $modelo3d=$fila['modelo3d'];

          $i++;

        ?>
        
        <tr aling=center>

            <td><?php echo $id; ?> </td>
            <td><?php echo $nombre; ?></td>
            <td><?php echo $descripcion; ?></td>
            <td><?php echo $precio; ?></td>
            <td><?php echo $stock; ?></td>
            <td><?php echo $imagen; ?></td>
            <td><?php echo $modelo3d; ?></td>
            <td><a href="admin.php?editar=<?php echo $id; ?>">Editar</a></td>
            <td><a href="admin.php?borrar=<?php echo $id; ?>">Borrar</a></td>

        </tr>
        <?php } ?>

        <?php
        if(isset($_GET['editar'])){
          include("edicion.php");
        }
    
        if(isset($_GET['borrar'])){
          $borrar_id = $_GET['borrar'];
          $borrar = "DELETE FROM productos WHERE id='$borrar_id'";
          $ejecutar = mysqli_query($con,$borrar);
    
          if($ejecutar){
            echo "<script>alert('PRODUCTO ELIMINADO!')</script>";
            echo "<script>window.open('admin.php','_self')</script>";
          }
        }
        ?>

      </thead>
    </table>

  </div>
  
</div>

<script>
   // Función para mostrar el mensaje y recargar la página después de 2 segundos
   function mostrarMensajeYRecargar(mensaje) {
        var mensajeElement = document.getElementById('mensaje');
        mensajeElement.innerHTML = mensaje;
        mensajeElement.style.display = 'block';

        // Desaparecer el mensaje después de 2 segundos
        setTimeout(function () {
            mensajeElement.style.display = 'none';
        }, 2000);

        // Recargar la página solo si hay un mensaje
        if (mensaje) {
            // Recargar la página después de 2.5 segundos (0.5 segundos después de desaparecer el mensaje)
            setTimeout(function () {
                location.reload();
            }, 2500);
        }
    }
</script>

<script>
    function previewImage() {
        var input = document.getElementById('imagen');
        var preview = document.getElementById('imagenPreview');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewModel() {
        var input = document.getElementById('modelo3d');
        var viewer = document.getElementById('modelo');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                // Establecer el atributo src del modelo 3D
                viewer.src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


</script>


</body>
</html>
