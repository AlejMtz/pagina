// Variable para rastrear el estado actual de los estilos
let colorBlindMode = false;

// Función para cambiar los colores para personas con daltonismo o restaurar los colores originales
function toggleColorBlindMode() {
    // Verificar el estado actual y alternar entre los estilos
    if (colorBlindMode) {
        // Restaurar los estilos originales
        document.body.style.backgroundColor = ''; // Restaurar el color de fondo original
        document.body.style.color = ''; // Restaurar el color del texto original

        // Restaurar los colores de los botones
        var buttons = document.querySelectorAll('.btn-1');
        buttons.forEach(function(button) {
            button.style.backgroundColor = ''; // Restaurar el color de fondo original
            button.style.color = ''; // Restaurar el color del texto original
        });

        // Restaurar los colores de los enlaces
        var links = document.querySelectorAll('a');
        links.forEach(function(link) {
            link.style.color = ''; // Restaurar el color del enlace original
        });

        // Restaurar los colores de los encabezados
        var headings = document.querySelectorAll('h1, h2, h3, h4, h5, h6');
        headings.forEach(function(heading) {
            heading.style.color = ''; // Restaurar el color del encabezado original
        });

        // Restaurar los colores de fondo de los elementos de clase 'general-txt'
        var generalTxtElements = document.querySelectorAll('.general-txt');
        generalTxtElements.forEach(function(element) {
            element.style.backgroundColor = ''; // Restaurar el color de fondo original
        });

        // Actualizar el estado a falso (estilos originales)
        colorBlindMode = false;
    } else {
        // Cambiar los estilos para personas con daltonismo

        // Cambiar el color de fondo de la página a un tono que funcione mejor para personas con daltonismo
        document.body.style.backgroundColor = 'lightgray';

        // Cambiar el color del texto a negro para mejorar la legibilidad
        document.body.style.color = 'black';

        // Cambiar los colores de los botones
        var buttons = document.querySelectorAll('.btn-1');
        buttons.forEach(function(button) {
            button.style.backgroundColor = '#4CAF50'; // Color de fondo verde
            button.style.color = 'white'; // Color del texto blanco
        });

 

        // Cambiar los colores de los enlaces
        var links = document.querySelectorAll('a');
        links.forEach(function(link) {
            link.style.color = '#0000EE'; // Color del enlace azul
        });

        // Cambiar los colores de los encabezados
        var headings = document.querySelectorAll('h1, h2, h3, h4, h5, h6');
        headings.forEach(function(heading) {
            heading.style.color = '#FFA500'; // Color naranja para los encabezados
        });

        // Cambiar los colores de fondo de los elementos de clase 'general-txt'
        var generalTxtElements = document.querySelectorAll('.general-txt');
        generalTxtElements.forEach(function(element) {
            element.style.backgroundColor = '#FFFFFF'; // Color de fondo blanco
        });

        // Actualizar el estado a true (estilos para personas con daltonismo)
        colorBlindMode = true;
    }
}

// Manejador de eventos para el botón de cambio de colores para daltonismo
document.getElementById("colorBlindButton").addEventListener("click", toggleColorBlindMode);
