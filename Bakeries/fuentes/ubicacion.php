<?php
/**
 * Archivo donde se mostrarán mediante jquery datos meterorologicos y distancia entre nuestra localizacion y la empresa
 */

//iniciamos las variables de sesion
session_start();

//incluimos el archivo funciones.php
include('assets/funciones.php');

//incluyo la cabecera de la página
include('assets/cabecera.php');
?>

<main>
    <!--div donde se mostrara los datos meterológicos y la distancia (api-tiempo.js)-->
    <div class="api-tiempo">
        <h2 id="dist"></h2>
        <h2 id="temp"></h2>
        <h2 id="tiempo"></h2>
        <h2 id="vel"></h2>
    </div>

    <!--div que muestra la ubicacion de la empresa-->
    <div class="mapa">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d784.6491182697795!2d-0.
            8010386098286595!3d38.12632131414324!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.
            1!3m3!1m2!1s0xd63a4dc446e4aa9%3A0x4f7e23beae98d022!2sRestaurante%20Mart%C3%ADn!5e0!3m2!1ses!2ses!4v1737722794042!5m2!1ses!2ses"
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <!--muestro fecha y hora (date.js)-->
    <h2 class="fecha"></h2>
    <h3 class="hora"></h3>
</main>

<?php
//incluyo el pie de página
include('assets/pie.php');
?>