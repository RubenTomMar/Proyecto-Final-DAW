<?php
/**
 * Archivo en el que el usuario admin podrá eliminar y modificar los productos que ve en la tabla
 */

//inicializamos la sesion
session_start();

//incluimos el fichero de funciones
include('assets/funciones.php');

//comprobamos que el usuario haya iniciado sesion
if (!isset($_SESSION['rol'])) {
    header('Location:../index.php');
}

//comprobamos que el rol del usuario se 'admin'
if (!permisos()) {
    header('Location:../index.php');
}

//incluimos la cabecera
include('assets/cabecera.php');

//numero de productos que mostare por pagina
$numProductosPorPagina = 5;

//comprobamos si tiene valor la pagina
if (isset($_GET['pagina'])) {

    //si lo tiene recibe el valor de la url
    $pagina = $_GET['pagina'];
} else {
    //si no tiene se le pone 1 por defecto
    $pagina = 1;
}

//variable que usaremos en la consulta para la orden LIMIT
//se calcula meduiante el valor de la pagina menos uno y esto se multiplica por el num de productos a mostrar
$limiteInicial = ($pagina - 1) * $numProductosPorPagina;

//consuta en la que indicamos la cantidad de productos que mostramos (LIMIT)
$consultaLimite = conexion()->query("SELECT * FROM productos LIMIT $limiteInicial, $numProductosPorPagina");
?>

<main>
    <!--Tabla de productos MIRAR EL OCULTAR-->
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th class="col-categoria">Categoría</th>
            <th>Precio</th>
            <th class="col-procedencia">Procedencia</th>
            <th>Cantidad</th>
            <th class="col-descripcion">Descripción</th>
            <th>Modificar</th>
            <th>Eliminar</th>
        </tr>
        <?php
        //recorremos la tabla y recogemos valores
        while ($producto = $consultaLimite->fetch_assoc()) {
            ?>
            <!--Valores de la bbdd mostrados en la tabla-->
            <tr>
                <td><?php echo $producto['id_producto']; ?></td>
                <td><?php echo $producto['nombre_producto']; ?></td>
                <td class="col-categoria"><?php echo $producto['categoria']; ?></td>
                <td><?php echo $producto['precio']; ?></td>
                <td class="col-procedencia"><?php echo $producto['procedencia']; ?></td>
                <td><?php echo $producto['cantidad']; ?></td>
                <td class="col-descripcion"><?php echo $producto['descripcion']; ?></td>

                <td>
                    <!--Nos mostrará un from de modificacion del producto de la tabla al pulsarlo-->
                    <form action="" method="post">
                        <!--Valores de la bbdd que utilizaremos para el form de modificar-->
                        <input type="hidden" name="id_producto" id="id_producto"
                            value="<?php echo $producto['id_producto']; ?>">
                        <input type="hidden" name="nombre_producto" id="nombre_producto"
                            value="<?php echo $producto['nombre_producto']; ?>">
                        <input type="hidden" name="precio" id="precio" value="<?php echo $producto['precio']; ?>">
                        <input type="hidden" name="procedencia" id="procedencia"
                            value="<?php echo $producto['procedencia']; ?>">
                        <input type="hidden" name="categoria" id="categoria" value="<?php echo $producto['categoria']; ?>">
                        <input type="hidden" name="cantidad" id="cantidad" value="<?php echo $producto['cantidad']; ?>">
                        <input type="hidden" name="descripcion" id="descripcion"
                            value="<?php echo $producto['descripcion']; ?>">
                        <!--Boton modificar-->
                        <button type="submit" name="modificar" id="modificar" class="modificar">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                    </form>
                </td>
                <td>
                    <!--Eliminará el producto de la bbdd al pulsarlo-->
                    <form action="" method="post">
                        <!--Valores para eliminar el producto-->
                        <input type="hidden" name="id_eliminar" id="id_eliminar"
                            value="<?php echo $producto['id_producto']; ?>">
                        <!--Boton eliminar-->
                        <button type="submit" name="eliminar" id="eliminar" class="eliminar">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            <?php
        } //FIN while 
        ?>
    </table>
    <p><b><i>*IMPORTANTE - Al pulsar el boton de eliminar el producto será eliminado en ese instante</i></b></p>
    <?php

    //consulta que usamos para saber la cantidad de producto que tenemos
    $consultaSimple = conexion()->query('SELECT * FROM productos');

    //calculamos el total de productos
    $numProductosTotales = mysqli_num_rows($consultaSimple);

    //calculamos cuantas páginas tendremos en total
    //para ello dividimos el num de productos en la bbdd entre los productos que mostramos por página
    //y usamos ceil para que sean numero enteros y no decimales
    $numPaginasTotales = ceil($numProductosTotales / $numProductosPorPagina);
    ?>
    <!--Manejo de la paginacion-->
    <div class="paginas">
        <!--Referencia a la primera página-->
        <a href="listado_modif.php?pagina=1"><i class="fa-solid fa-chevron-left"></i></a>
        <?php
        //usamos un bucle for para mostrar las paginas
        for ($i = 1; $i <= $numPaginasTotales; $i++) {
            ?>
            <!--Mostramos todas las páginas-->
            <a href="<?php echo 'listado_modif.php?pagina=' . $i; ?>"><?php echo $i ?></a>
            <?php
        }
        ?>
        <!--Referencia a la ultima página-->
        <a href="<?php echo 'listado_modif.php?pagina=' . $numPaginasTotales; ?>"><i
                class="fa-solid fa-chevron-right"></i></a>
    </div>

    <?php

    //comprobamos que el metodo sea post
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        //si se pulsa el boton modificar
        if (isset($_POST['modificar'])) {

            //variables del producto a modificar que apareceran en el placeholder
            $id = $_POST['id_producto'];
            $nombre = $_POST['nombre_producto'];
            $precio = $_POST['precio'];
            $procedencia = $_POST['procedencia'];
            $cantidad = $_POST['cantidad'];
            $descripcion = $_POST['descripcion'];

            //formulario modificacion
            echo '<h2>Modificando producto producto ' . $nombre . ' (id: ' . $id . ')</h2>
            <form action="" method="post" enctype="multipart/form-data" id="form-modif-prod" class="form">';

            //input con el valor del id del producto (oculto), necesario para la consulta modificacion
            echo '<input type="hidden" name="id_producto" id="id_producto" value="' . $id . '">

                <label for="nombre_producto">Nombre</label>
                <input type="text" name="nombre_producto" id="nombre_producto" placeholder="' . $nombre . '">

                <label for="precio">Precio (€)</label>
                <input type="number" name="precio" id="precio" placeholder="' . $precio . '">

                <label for="procedencia">Procedencia</label>
                <input type="text" name="procedencia" id="procedencia" placeholder="' . $procedencia . '">

                <label for="categoria">Categoría</label>

                <select name="categoria" id="categoria">
                    <option value="panes" selected>Panes</option>
                    <option value="bolleria">Bollería</option>
                    <option value="salado">Salado</option>
                    <option value="pasteles">Pasteles</option>
                </select>

                <label for="cantidad">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad" placeholder="' . $cantidad . '">

                <label for="descripcion">Descripción</label>
                <input type="text" name="descripcion" id="descripcion" placeholder="' . $descripcion . '">

                <label for="img_producto">Imagen del Producto</label>
                <input type="file" name="img_producto" id="img_producto">

                <button name="guardar" id="guardar">Guardar</button>
                <button name="cancelar" id="cancelar">Cancelar</button>
            </form>';
        }

        //si se pulsa el boton 'guardar' (form modif)
        if (isset($_POST['guardar'])) {

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
                //mensaje de error de archivo muy pesado
                echo "<p class='err'>El archivo es muy pesado</p>";
                $validator = 0;
            }

            //Validamos la extensión del archivo
            $allowed_files = ['image/jpg', 'image/jpeg', 'image/png']; //tipos de archivo validos
    
            if (!in_array($file_type, $allowed_files)) {
                //mensaje error si el tipo de archivo no es valido
                echo "<p class='err'>Solo se permiten imágenes tipo JPG, JPEG, PNG</p>";
                $validator = 0;
            }

            //movemos el archivo de la carpeta temporal a la carpeta objetivo y verificamos si fue exitoso
            if ($validator == 1) {
                if (move_uploaded_file($url_temp, $url_target)) {
                    //mensaje de error todo ok
                    echo "<p class='ok'>El archivo " . htmlspecialchars(basename($file)) . " ha sido cargado con éxito.</p>";
                } else {
                    //mensaje de error si no se pudo cargar el archivo
                    echo "<p class='err'>Ha habido un error al cargar tu archivo.</p>";
                }
            } else {
                //mensaje de error si ela rchivo no pudo cargarse
                echo "<p class='err'>Error: el archivo no se ha cargado</p>";
            }

            //url para poder mostrar la imagen por la web
            $url_imagen_producto = "." . substr($url_target, 24);

            //variables con los datos del formulario de modificacion
            $id = $_POST['id_producto'];
            $nombre = $_POST['nombre_producto'];
            $precio = $_POST['precio'];
            $procedencia = $_POST['procedencia'];
            $cantidad = $_POST['cantidad'];
            $descripcion = $_POST['descripcion'];

            //si no estan los campos vacios
            if(!empty($nombre) && !empty($precio) && !empty($procedencia) && !empty($cantidad) && !empty($descripcion)) {

            //Modificamos por los valores indicados
            $query = "UPDATE productos SET nombre_producto = '$nombre', precio = '$precio', procedencia = '$procedencia', 
            cantidad = '$cantidad', descripcion = '$descripcion', imagen_producto = '$url_imagen_producto' 
            WHERE id_producto = '$id'";

            $consultaModificacion = conexion()->query($query);
            } else  {
                //mensaje campos vacios
                echo '<p class="err">No pueden haber campos vacios.</p>';
            } //FIN campos vacios
        } //FIN voton guardar

        //si se pulsa el boton eliminar
        if (isset($_POST['eliminar'])) {

            //id del producto que se va a eliminar
            $id = $_POST['id_eliminar'];

            //consulta de eliminacion del producto seleccionado (tras confirmacion)
            $consultaEliminar = conexion()->query("DELETE FROM productos WHERE id_producto = $id");

            //si la consulta tiene exito mostramos un mensaje de que ha ido bien
            if ($consultaEliminar) {
                //mensaje todo ok
                echo '<p class="ok">El producto se ha eliminado correctamente.</p>';;
            } else {
                //mensaje de que algo ha ido mal
                echo '<p class="err">Algo fue mal, no se pudo eliminar el producto.</p>';
            }
        } //FIN boton eliminar
    } //FIN REQUEST_METHOD
    ?>
</main>
<?php
//desconexion bbdd
desconexion(conexion());

//incluimos pie de pagina
include('assets/pie.php');
?>