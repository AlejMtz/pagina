<?php
// Conexión a la base de datos (ajusta los detalles de conexión según tu configuración)
$mysqli = new mysqli("localhost", "root", "", "agendas");

// Verifica la conexión
if ($mysqli->connect_error) {
    die("Error en la conexión a la base de datos: " . $mysqli->connect_error);
}

// Recibe los datos del cliente y los productos
$data = json_decode(file_get_contents('php://input'), true);
$cliente = $data['cliente'];
$productos = $data['productos'];

// Inserta los datos en la tabla "pedidos"
foreach ($productos as $producto) {
    $sql = "INSERT INTO pedidos (nombre_cliente, apellidos_cliente, telefono_cliente, correo_cliente, nombre_producto, precio_producto)
            VALUES ('" . $cliente['nombre'] . "', '" . $cliente['apellidos'] . "', '" . $cliente['telefono'] . "', '" . $cliente['email'] . "', '" . $producto['name'] . "', " . $producto['price'] . ")";
    $mysqli->query($sql);
}

$total = array_reduce($productos, function ($carry, $producto) {
    return $carry + $producto['price'];
}, 0);

// Configurar las cabeceras para indicar que el contenido es un PDF
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="comprobante.pdf"');

// Crear el contenido del comprobante en HTML (personalízalo según tus necesidades)
$comprobanteHTML = "
<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Comprobante de Compra</title>
    <!-- Estilos CSS para el comprobante -->
    <style>
        /* Estilo para el título principal */
        h1 {
            font-size: 24px; /* Aumenta el tamaño de la fuente según tus preferencias */
        }

        /* Estilo para los párrafos */
        p {
            font-size: 16px; /* Aumenta el tamaño de la fuente según tus preferencias */
        }

        /* Estilo para los títulos secundarios */
        h2 {
            font-size: 20px; /* Aumenta el tamaño de la fuente según tus preferencias */
        }

        /* Estilo para la lista de productos */
        ul {
            font-size: 14px; /* Aumenta el tamaño de la fuente según tus preferencias */
        }
    </style>
</head>
<body>
    <br>
    <br>
    <br>
    <h1>Comprobante de Compra</h1>
    <p>Cliente: {$cliente['nombre']} {$cliente['apellidos']}</p>
    <h2>Productos Comprados:</h2>
    <ul>
";
foreach ($productos as $producto) {
    $comprobanteHTML .= "<li>{$producto['name']} - {$producto['price']}</li>";
}
$comprobanteHTML .= "
    </ul>
    <p>Total: {$total}</p>
    <p>Direccion de Entrega: {$cliente['email']}</p>
    <p>El tiempo de llegada esta estimado entre 1 a 5 dias despues de la compra<p>
</body>
</html>
";


// Utilizar la biblioteca TCPDF para generar el PDF
require('tcpdf/tcpdf.php');
$pdf = new TCPDF();
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->AddPage();
$pdf->writeHTML($comprobanteHTML);
$pdf->Image('img/icono.jpg', 150, 30, 40, 0, 'JPG', '', '', true, 150);
$pdf->Image('img/encabezado.jpg', 0, 0, 210, 30, 'JPG', '', '', true, 150);

// Generar el PDF y mostrarlo en el navegador
//$pdf->Output('comprobante.pdf', 'I'); // 'I' muestra el PDF en el navegador, 'D' lo descarga
$pdfPath = dirname(__FILE__).'/comprobante.pdf'; // Cambia esto a la ubicación donde deseas guardar el PDF en el servidor
$pdf->Output($pdfPath, 'F'); // 'F' guarda el PDF en el servidor

// Cierra la conexión a la base de datos
$mysqli->close();

$response = [
    'total' => $total,
    'pdf_url' => 'comprobante.pdf', // Incluye la URL del PDF en la respuesta
];
echo json_encode($response);
?>