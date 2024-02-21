<?php
// Conectar a la base de datos (debes completar con tus propias credenciales)
$conexion = new mysqli("localhost", "root", "", "agendas");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error en la conexión a la base de datos: " . $conexion->connect_error);
}

// Realizar una consulta para obtener los productos
$query = "SELECT * FROM productos";
$resultado = $conexion->query($query);

if ($resultado->num_rows > 0) {
    // Incluir las bibliotecas de Three.js y GLTFLoader
    echo "<script src='https://threejs.org/build/three.js'></script>";
    echo "<script src='https://threejs.org/examples/js/loaders/GLTFLoader.js'></script>";

    // Mostrar la información de los productos
    while ($row = $resultado->fetch_assoc()) {
        echo "<h3>" . $row['nombre'] . "</h3>";
        echo "<p>Descripción: " . $row['descripcion'] . "</p>";
        echo "<p>Precio: $" . $row['precio'] . "</p>";
        echo "<img src='" . $row['imagen'] . "' alt='Imagen del producto' style='max-width: 200px;'><br>";

        // Renderizar el modelo 3D con Three.js
        echo "<div id='modelo3d_" . $row['id'] . "' style='width: 200px; height: 200px;'></div>";
        echo "<script>
                  var scene = new THREE.Scene();
                  var camera = new THREE.PerspectiveCamera(75, 1, 0.1, 1000);
                  var renderer = new THREE.WebGLRenderer();

                  document.getElementById('modelo3d_" . $row['id'] . "').appendChild(renderer.domElement);

                  var loader = new THREE.GLTFLoader();
                  loader.load('" . $row['modelo3d'] . "', function (gltf) {
                    scene.add(gltf.scene);
                  });

                  camera.position.z = 5;

                  function animate() {
                    requestAnimationFrame(animate);
                    renderer.render(scene, camera);
                  }

                  animate();
               </script><br>";
    }
} else {
    echo "No hay productos disponibles.";
}

// Cerrar la conexión
$conexion->close();
?>
