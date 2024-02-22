<?php
// Incluir la conexión a la base de datos si no lo has hecho ya
include 'informacion_bd.php';

// Obtener los datos del cliente desde la base de datos (ajusta según tu estructura)
$sql_cliente = "SELECT nombre, apellidos, telefono, correo FROM compradores ORDER BY id DESC LIMIT 1";
$result_cliente = $conexion->query($sql_cliente);

// Obtener los detalles de la compra desde la base de datos (ajusta según tu estructura)
$sql_detalles_compra = "SELECT direccion, ciudad, estado, codigo_postal, no_tarjeta_credito, fecha_expiracion, ccv FROM detalles_compra ORDER BY id DESC LIMIT 1";
$result_detalles_compra = $conexion->query($sql_detalles_compra);

if ($result_cliente->num_rows > 0 && $result_detalles_compra->num_rows > 0) {
    $cliente = $result_cliente->fetch_assoc();
    $detalles_compra = $result_detalles_compra->fetch_assoc();

    // Crear el PDF
    require('tcpdf/tcpdf.php');
    $pdf = new TCPDF();
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->AddPage();

    // Contenido del comprobante
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 10, 'Comprobante de Compra', 0, 1, 'C');

    // Datos del cliente
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 10, 'Cliente: ' . $cliente['nombre'] . ' ' . $cliente['apellidos'], 0, 1);
    $pdf->Cell(0, 10, 'Teléfono: ' . $cliente['telefono'], 0, 1);
    $pdf->Cell(0, 10, 'Correo: ' . $cliente['correo'], 0, 1);

    // Detalles de la compra
    $pdf->Cell(0, 10, 'Detalles de la Compra', 0, 1, 'C');
    $pdf->Ln();
    $pdf->Cell(80, 10, 'Dirección:', 0);
    $pdf->Cell(0, 10, $detalles_compra['direccion'], 0, 1);
    $pdf->Cell(80, 10, 'Ciudad:', 0);
    $pdf->Cell(0, 10, $detalles_compra['ciudad'], 0, 1);
    $pdf->Cell(80, 10, 'Estado:', 0);
    $pdf->Cell(0, 10, $detalles_compra['estado'], 0, 1);
    $pdf->Cell(80, 10, 'Código Postal:', 0);
    $pdf->Cell(0, 10, $detalles_compra['codigo_postal'], 0, 1);
    $pdf->Cell(80, 10, 'Tarjeta de Crédito:', 0);
    $pdf->Cell(0, 10, $detalles_compra['no_tarjeta_credito'], 0, 1);
    $pdf->Cell(80, 10, 'Fecha de Expiración:', 0);
    $pdf->Cell(0, 10, $detalles_compra['fecha_expiracion'], 0, 1);
    $pdf->Cell(80, 10, 'CCV:', 0);
    $pdf->Cell(0, 10, $detalles_compra['ccv'], 0, 1);

    // Guardar el PDF en el servidor
    $pdf_path = __DIR__ . "/comprobante.pdf"; // Ruta absoluta al directorio actual
    $pdf->Output($pdf_path, 'F');

    // Cerrar el objeto TCPDF
    $pdf->close();

    // Al finalizar la generación del PDF, redirigir a la página de descarga
    header('Location: descargar_comprobante.php?pdf=' . urlencode($pdf_path));
    exit;
} else {
    echo "Error: No se obtuvieron datos del cliente o detalles de la compra.";
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
