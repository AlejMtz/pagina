<?php
// Recuperar el nombre del archivo PDF desde los parámetros GET
if (isset($_GET['pdf'])) {
    $pdf_path = $_GET['pdf'];

    // Descargar el PDF
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="comprobante.pdf"');
    readfile($pdf_path);

    // Puedes agregar lógica adicional aquí, como eliminar el archivo temporal después de la descarga
} else {
    echo "Error: No se especificó un archivo PDF para descargar.";
}

// Redirigir a la página del carrito después de la descarga
$redirect_url = 'index.html'; // Cambia esto con la URL correcta de tu página del carrito
header('Location: ' . $redirect_url);
exit;
?>
