<?php
// Datos de conexión a la base de datos
$host = "localhost"; // Cambia esto según tu configuración
$usuario = "root"; // Cambia esto según tu configuración
$contrasena = ""; // Cambia esto según tu configuración
$base_de_datos = "tu_base_de_datos"; // Cambia esto según tu configuración

// Crear la conexión
$conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error en la conexión a la base de datos: " . $conexion->connect_error);
}
?>
