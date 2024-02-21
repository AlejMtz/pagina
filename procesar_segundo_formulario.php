<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar si se recibieron todos los campos requeridos
    $campos_requeridos = array('direccion', 'ciudad', 'estado', 'codigo', 'card-num', 'expire', 'security');

    foreach ($campos_requeridos as $campo) {
        if (!isset($_POST[$campo]) || empty($_POST[$campo])) {
            die("<p>No se recibió el campo requerido: {$campo}</p>");
        }
    }

    // Obtener los datos del formulario
    $direccion = $_POST['direccion'];
    $ciudad = $_POST['ciudad'];
    $estado = $_POST['estado'];
    $codigo = $_POST['codigo'];
    $no_tarjeta_credito = $_POST['card-num'];
    $fecha_expiracion = $_POST['expire'];
    $ccv = $_POST['security'];

    // Conectar a la base de datos (reemplaza con tus propias credenciales)
    $conexion = new mysqli("localhost", "root", "", "agendas");

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión a la base de datos: " . $conexion->connect_error);
    }

    // Preparar la consulta SQL para insertar datos en la tabla 'detalles_compra'
    $query = "INSERT INTO detalles_compra (direccion, ciudad, estado, codigo_postal, no_tarjeta_credito, fecha_expiracion, ccv) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($query);

    // Verificar si la preparación de la consulta fue exitosa
    if ($stmt) {
        // Vincular parámetros y ejecutar la consulta
        $stmt->bind_param("sssssss", $direccion, $ciudad, $estado, $codigo, $no_tarjeta_credito, $fecha_expiracion, $ccv);
        $stmt->execute();

        // Verificar si la inserción fue exitosa
        if ($stmt->affected_rows > 0) {
            // Cerrar la consulta preparada
            $stmt->close();
        
            // Redirigir a la página de comprobante
            header('Location: generar_comprobante.php');
            exit;  // Asegúrate de salir después de redirigir para evitar ejecución adicional
        } else {
            echo "<p>Error al guardar los datos del segundo formulario: " . htmlspecialchars($stmt->error) . "</p>";
        }
    } else {
        echo "<p>Error en la preparación de la consulta: " . htmlspecialchars($conexion->error) . "</p>";
    }

    // Cerrar la conexión a la base de datos si está abierta
    if ($conexion->ping()) {
        $conexion->close();
    }
} else {
    echo "<p>No se recibió una solicitud POST válida.</p>";
}
?>
