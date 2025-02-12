<?php
/**
 * Archivo que muestra un formuario para añadir un producto a la bbdd
 */

//iniciamos la sesión
session_start();

//incluimos el archivo funciones
include("assets/funciones.php");

//si tiene la sesion iniciada
if (!isset($_SESSION['rol'])) {
   header("Location:../index.php");
}

//compruebo si tiene permiso de administrador
if (!permisos()) {
   header("Location:../index.php");
}

//incluyo el pie de página
include('assets/cabecera.php');
?>
<main>
   <h2>Añadir producto a la base de datos</h2>
   <!--FORM AÑADIR PRODUCTO-->
   <form action="alta.php" method="post" enctype="multipart/form-data" id="form" class="form">

      <label for="nombre_producto">Nombre</label>
      <input type="text" name="nombre_producto" id="nombre_producto" placeholder="Barra de pan">

      <label for="precio">Precio (€)</label>
      <input type="number" name="precio" id="precio" placeholder="1.00">

      <label for="procedencia">Procedencia</label>
      <input type="text" name="procedencia" id="procedencia" placeholder="Alicante">

      <!--CATEGORIA-->
      <label for="categoria">Categoría</label>

      <select name="categoria" id="categoria">
         <option value="panes" selected>Panes</option>
         <option value="bolleria">Bollería</option>
         <option value="salado">Salado</option>
         <option value="pasteles">Pasteles</option>
      </select>

      <label for="cantidad">Cantidad</label>
      <input type="number" name="cantidad" id="cantidad" placeholder="100">

      <label for="descripcion">Descripción</label>
      <input type="text" name="descripcion" id="descripcion" placeholder="Descripción del producto...">

      <!--IMG-->
      <input type="file" name="img" id="img">

      <input type="submit" name="alta" id="alta" value="Añadir producto">

   </form>
   <?php
   //comprobamos de que el metodo sea post
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      //somprobamos si se pulsa el boton 'alta'
      if (isset($_POST['alta'])) {

         //variables con los datos del form
         $nombre_producto = $_POST['nombre_producto'];
         $precio = $_POST['precio'];
         $procedencia = $_POST['procedencia'];
         $categoria = $_POST['categoria'];
         $cantidad = $_POST['cantidad'];
         $descripcion = $_POST['descripcion'];

         /*Recojo imagen*/

         //Nombre de nuestro archivo
         $file = $_FILES["img"]["name"];

         //Variable validadora
         $validator = 1;

         //Extensión de nuestro archivo
         $file_type = $_FILES["img"]["type"];

         //Ruta temporal a donde se carga el archivo 
         $url_temp = $_FILES["img"]["tmp_name"];

         //Ruta absoluta hasta el archivo en ejecución
         $url_insert = dirname(__FILE__) . "/assets/img"; //Carpeta donde subiremos nuestros archivos
   
         //Ruta donde se guardara el archivo, usamos str_replace para reemplazar los "\" por "/"
         $url_target = str_replace('\\', '/', $url_insert) . '/' . $file;

         //Si la carpeta no existe, la creamos
         if (!file_exists($url_insert)) {
            mkdir($url_insert, 0777, true);
         }

         //Validamos el tamaño del archivo
         $file_size = $_FILES["img"]["size"];
         if ($file_size > 1000000) {
            echo '<p class="err">El archivo es muy pesado</p>';
            $validator = 0;
         }

         //Validamos la extensión del archivo
         //tipos de archivo validos
         $allowed_files = ['image/jpg', 'image/jpeg', 'image/png'];

         if (!in_array($file_type, $allowed_files)) {
            //mensaje error tipo archivo
            echo '<p class="err">Solo se permiten imágenes tipo JPG, JPEG, PNG</p>';
            $validator = 0;
         }

         //movemos el archivo de la carpeta temporal a la carpeta objetivo y verificamos si fue exitoso
         if ($validator == 1) {
            if (move_uploaded_file($url_temp, $url_target)) {
               //mensaje si fue todo correcto
               echo '<p class="ok">El archivo ' . htmlspecialchars(basename($file)) . ' ha sido cargado con éxito.</p>';
            } else {
               //mensaje de error si no se pudo cargar el archivo
               echo '<p class="err">Ha habido un error al cargar tu archivo.</p>';
            }
         } else {
            //mensaje error si no se pudo cargar el archivo
            echo '<p class="err">Error: el archivo no se ha cargado</p>';
         }

         //url para poder mostrar la imagen por la web
         $url_imagen_producto = "." . substr($url_target, 24);

         //si no hay campos vacios
         if (!empty($nombre_producto) && !empty($precio) && !empty($procedencia) && !empty($categoria) && !empty($cantidad) && !empty($descripcion) && !empty($url_imagen_producto)) {

            //comprobamos si el producto ya existe
            if (!existeProducto($nombre_producto, $procedencia, $categoria)) {

               //query de añadir producto
               $query = "INSERT INTO productos (nombre_producto, precio, procedencia, categoria, cantidad, descripcion, imagen_producto) 
            VALUES ('$nombre_producto', '$precio', '$procedencia', '$categoria', '$cantidad', '$descripcion', '$url_imagen_producto')";

               $consultaAlta = conexion()->query($query);

               //mensaje si se ha añadido correctamente el producto
               echo "<p class='ok'>Se ha añadido el producto correctamente.</p";

               //desconectamos
               desconexion(conexion());
            } else {
               //mensaje de error si ya existe ese producto
               echo "<p class='err'>Ese producto ya existe.</p>";
            } //FIN existeProducto
         } else {
            //mensaje de error si hay campos vacios
            echo "<p class='err'>No pueden haber campos vacios.</p>";
         } //FIN campos vacios
      } //FIN pulsar boton 'alta'
   } //FIN methos post
   ?>
</main>
<?php
//incluyo el pie de página
include('assets/pie.php');
?>