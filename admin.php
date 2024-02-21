<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Producto</title>
</head>
<body>

<h2>Agregar Producto</h2>

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
    <model-viewer id="modelo3dPreview" style="width: 200px; height: 200px;"></model-viewer><br>

    <button type="submit">Agregar Producto</button>
</form>


<!-- Agregamos botones para modificar y eliminar -->
<div id="botonesModificarEliminar" style="margin-top: 20px;">
    <button type="button" onclick="modificarProducto()">Modificar Producto</button>
    <button type="button" onclick="eliminarProducto()">Eliminar Producto</button>
</div>


<!-- Agregamos un elemento para mostrar el mensaje -->
<div id="mensaje" style="display: none; background-color: #4CAF50; color: white; padding: 10px; text-align: center;">
    <?php
        // Mostrar el mensaje si existe en la URL
        if (isset($_GET['mensaje'])) {
            echo htmlspecialchars($_GET['mensaje']);
        }
    ?>
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
  var preview = document.getElementById('modelo3dPreview');

  if (input.files && input.files[0]) {
    var modelUrl = URL.createObjectURL(input.files[0]);
    console.log(modelUrl);

    createBlobFromURL(modelUrl).then((blob) => {
      preview.setAttribute('src', blob);
      preview.style.display = 'block';
    });
  }
}

function createBlobFromURL(url) {
  return new Promise((resolve, reject) => {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);
    xhr.responseType = 'arraybuffer';

    xhr.onload = function() {
      if (xhr.status === 200) {
        const arrayBuffer = xhr.response;
        const blob = new Blob([arrayBuffer], { type: 'model/gltf-binary' });
        resolve(blob);
      } else {
        reject(new Error('Error al cargar el archivo'));
      }
    };

    xhr.send();
  });
}




</script>

</body>
</html>
