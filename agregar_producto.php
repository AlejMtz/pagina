

<?php
// Conectar a la base de datos (debes completar con tus propias credenciales)
$conexion = new mysqli("localhost", "root", "", "agendas");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error en la conexión a la base de datos: " . $conexion->connect_error);
}

// Procesar la información del formulario
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];

// Guardar la imagen en una carpeta (ajusta la ruta según tu estructura de archivos)
$imagen_path = "img/" . basename($_FILES["imagen"]["name"]);

// Verificar y crear la carpeta si no existe
if (!file_exists("img")) {
    mkdir("img", 0777, true);
}

move_uploaded_file($_FILES["imagen"]["tmp_name"], $imagen_path);

// Guardar el modelo 3D en una carpeta (ajusta la ruta según tu estructura de archivos)
$modelo3d_path = "modelos3d/" . basename($_FILES["modelo3d"]["name"]);

// Verificar y crear la carpeta si no existe
if (!file_exists("modelos3d")) {
    mkdir("modelos3d", 0777, true);
}

move_uploaded_file($_FILES["modelo3d"]["tmp_name"], $modelo3d_path);

// Insertar datos en la base de datos
$query = "INSERT INTO productos (nombre, descripcion, precio, stock, imagen, modelo3d) 
          VALUES ('$nombre', '$descripcion', $precio, $stock, '$imagen_path', '$modelo3d_path')";

if ($conexion->query($query) === TRUE) {
    echo "Producto agregado con éxito.";
    // Redirigir a la página de administración con el mensaje
header("Location: admin.php?mensaje=" . urlencode("Producto agregado con éxito."));
exit();
} else {
    echo "Error al agregar el producto: " . $conexion->error;
}


// Redirigir a la página de administración con el mensaje
header("Location: admin.php?mensaje=" . urlencode($mensaje));
exit();

// Cerrar la conexión
$conexion->close();
?>

