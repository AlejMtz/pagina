<?php
if (isset($_GET['pdf'])) {
    $pdf_path = $_GET['pdf'];

    // Descargar el PDF
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="comprobante.pdf"');
    readfile($pdf_path);

    // Puedes agregar lógica adicional aquí, como eliminar el archivo temporal después de la descarga

    // Redirigir a la página del carrito después de la descarga
    header('Location: carrito.php');
    exit;
} else {
    echo "Error: No se especificó un archivo PDF para descargar.";
}
?>
