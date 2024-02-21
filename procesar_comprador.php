<?php
session_start();

// Limpiar el carrito después de realizar el pedido
unset($_SESSION['carrito']);

echo "<h2>Proceso de Compra</h2>";
echo "<p>¡Gracias por realizar tu pedido!</p>";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar si se recibieron todos los campos requeridos
    if (isset($_POST['nombre']) && isset($_POST['apellidos']) && isset($_POST['telefono']) && isset($_POST['email'])) {
        // Obtener los datos del formulario
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];

        // Conectar a la base de datos (reemplaza con tus propias credenciales)
        $conexion = new mysqli("localhost", "root", "", "agendas");

        // Verificar la conexión
        if ($conexion->connect_error) {
            die("Error en la conexión a la base de datos: " . $conexion->connect_error);
        }

        // Obtener la fecha actual en el formato de la base de datos (YYYY-MM-DD)
        $fecha_registro = date("Y-m-d");

        // Preparar la consulta SQL para insertar datos en la tabla 'compradores'
        $query = "INSERT INTO compradores (nombre, apellidos, telefono, correo, fecha_registro) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($query);

        // Verificar si la preparación de la consulta fue exitosa
        if ($stmt) {
            // Vincular parámetros y ejecutar la consulta
            $stmt->bind_param("sssss", $nombre, $apellidos, $telefono, $email, $fecha_registro);
            $stmt->execute();

            // Verificar si la inserción fue exitosa
            if ($stmt->affected_rows > 0) {
                echo "<p>¡Datos guardados correctamente en la base de datos!</p>";

                // Redireccionar al segundo formulario
                header("Location: mostrar_formulario2.php");
                exit();
            } else {
                echo "<p>Error al guardar los datos del comprador: " . $stmt->error . "</p>";
            }

            // Cerrar la consulta preparada
            $stmt->close();
        } else {
            echo "<p>Error en la preparación de la consulta: " . $conexion->error . "</p>";
        }

        // Cerrar la conexión a la base de datos
        $conexion->close();
    } else {
        echo "<p>No se recibieron todos los campos requeridos.</p>";
    }
}
?>
