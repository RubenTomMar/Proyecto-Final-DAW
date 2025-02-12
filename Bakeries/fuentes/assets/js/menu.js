/**
 * Archivo para el header version movil
 */
$(document).ready(function () { //nos aseguramos que la pagina haya cargado
    //cuando se pulse el icono del menú movil
    //el menu se ocultará o aparecerá dependiendo en el estado que esté
    $("#menu-icon").click(function () {
        $('#menu').toggle();
    });
});