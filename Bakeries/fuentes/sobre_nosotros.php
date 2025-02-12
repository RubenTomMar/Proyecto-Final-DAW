<?php
/**
 * Archivo donde mostramos un poco de info sobre lo que es Bakeries
 * Slideshow (Fancybox)
 * Foro
 */

//inicio las variables de sesion
session_start();

//añado el archivo funciones.php
include('assets/funciones.php');

//incluyo la cabecera de la página
include('assets/cabecera.php');
?>

<main>
    <!--GALERIA-->
    <h1>BAKERIES</h1>
    <div id="slideshow">
        <a href="assets/img/horno.jpg" data-fancybox="gallery" title="horno">
            <img src="assets/img/horno.jpg" alt="horno">
        </a>
        <a class=".fancybox" href="assets/img/panadero.jpg" data-fancybox="gallery" title="panadero">
            <img src="assets/img/panadero.jpg" alt="panadero">
        </a>
        <a class=".fancybox" href="assets/img/trigo.jpg" data-fancybox="gallery" title="trigo">
            <img src="assets/img/trigo.jpg" alt="trigo">
        </a>
    </div>

    <!--INFO BAKERIES-->
    <div class="info">
        <p>
            Bakeries es la panaderia de todo la vida pero desde la comodidad de tu casa, 
            disfruta de nuestros panes hechos artesanalmente par acompañar a tus comidas.
            Nuestra gama de productos está preparada para todo tipos de paladares, desde lo más dulce a lo más salado.
            Bakeries solo un click y a tu mesa.
        </p>
    </div>

    <!--FORO--> <!--TO DO-->
    <form action="" method="post" id="form-foro" class="form">
        <label for="titulo">Título</label>
        <input type="text" id="titulo" name="titulo" required><br>
        <label for="contenido">Comentario:</label>
        <textarea id="msj" name="msj" rows="5" placeholder="Escribe aquí tu comentario"></textarea>
        <button type="submit" name="comentar" id="comentar">Comentar</button>
    </form>

    <!--Se añaden aqui los comentarios-->
    <div id="foro"></div>
</main>

<?php
//incluyo el pie de página
include('assets/pie.php');
?>