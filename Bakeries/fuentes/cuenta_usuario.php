<?php
/**
 * Fichero con los datos del usuario
 * Puede modificar estos datos
 */

//iniciamos variables de sesión
session_start();

//incluimos ficheros funciones y carrito
include('assets/funciones.php');
include('assets/carrito.php');

//incluyo la cabecera
include('assets/cabecera.php');

//si no está logeado le lleva al login
if (!isset($_SESSION['rol'])) {
    header('location:login.php');
}

?>
<main>
    <!--Datos del usuario-->
    <div class="datos-usuario">
        <?php
        //variable de sesion con el id del usario logeado para la consulta
        $id_usu = $_SESSION['id_usu'];

        //consulta de todos los datos del usuario logeado
        $consultaDatosUsuario = conexion()->query("SELECT * FROM usuarios WHERE id_usuario = '$id_usu'");

        //recorremos el resultado de la consulta para sacar los valores
        while ($datos = $consultaDatosUsuario->fetch_assoc()) {

            //recogemos el valor de la imagen recortado
            $img = substr($datos['imagen_usuario'], 10);
            ?>

            <!--Mostramos los valores del usuario-->

            <!--Img del usuario-->
            <div class="img-usu">
                <img src="<?php echo $img; ?>" alt="imagen del usuario">
            </div>

            <!--Nombre de usuario-->
            <div class="nom-usu"><?php echo $datos['nombre_usuario']; ?></div>

            <!--Batos varios del usuario-->
            <div class="datos-usu">

                <p><b>Nombres y apellidos:</b> <?php echo $datos['nombre'] . ' ' . $datos['apellidos']; ?> </p>

                <p><b>Dirección:</b> <?php echo $datos['direccion']; ?></p>

                <p><b>Correo electrónico:</b> <?php echo $datos['mail']; ?></p>

                <p><b>Número de teléfono:</b> <?php echo $datos['telefono']; ?></p>

            </div>
        </div>

        <!--Form con la opcion de modificar los datos y cerrar la sesion-->
        <form action="" method="post" class="form form-cuenta-usu">
            <!--Valores hidden para mostrar en el placeholder-->
            <input type="hidden" name="img_usu" value="<?php echo $img_usu; ?>">
            <input type="hidden" name="nom_usu" value="<?php echo $datos['nombre_usuario']; ?>">
            <input type="hidden" name="nombre" value="<?php echo $datos['nombre']; ?>">
            <input type="hidden" name="apellidos" value="<?php echo $datos['apellidos']; ?>">
            <input type="hidden" name="direccion" value="<?php echo $datos['direccion']; ?>">
            <input type="hidden" name="mail" value="<?php echo $datos['mail']; ?>">
            <input type="hidden" name="telefono" value="<?php echo $datos['telefono']; ?>">
            <!--Boton modificar datos usuario-->
            <button name="modif_datos_usu" id="btn-modif_datos_usu">Modificar mis datos</button>

            <!--Boton cerrar sesion-->
            <button name="cerrar_sesion" id="btn-cerrar-sesion">Cerrar sesión</button>
        </form>

        <?php
        } //FIN while
        
        //comprobamos que el metodo sea post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //en caso que se pulse el boton de 'cerrar sesion', cierra la sesion
            if (isset($_POST['cerrar_sesion'])) {

                //borro todas las variables de sesion
                session_destroy();
            }

            //en caso que se pulse el boton de 'modificar mis datos'
            if (isset($_POST['modif_datos_usu'])) {

                //variables con los datos del usuario (placeholder)
                $img_usuario = $_POST['img_usu'];
                $nom_usuario = $_POST['nom_usu'];
                $nombre = $_POST['nombre'];
                $apellidos = $_POST['apellidos'];
                $direccion = $_POST['direccion'];
                $mail = $_POST['mail'];
                $telefono = $_POST['telefono'];
                ?>

            <!--Formulario de modificación de datos del usuario-->
            <p><b><i>*Importante - todos los campos han de estar rellenados</i></b></p>
            <form action="" method="post" enctype="multipart/form-data" id="form-modif-usu" class="form form-modif-usu">
                <label for="imagen_usuario">Imagen de usuario</label>
                <input type="file" name="imagen_usuario" id="imagen-usuario">

                <label for="nombre_usuario">Nombre de usuario</label>
                <input type="text" name="nombre_usuario" id="nombre-usuario" placeholder="<?php echo $nom_usuario; ?>">

                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="<?php echo $nombre; ?>">

                <label for="apellidos">Apellidos</label>
                <input type="text" name="apellidos" id="apellidos" placeholder="<?php echo $apellidos; ?>">

                <label for="direccion">Direccion</label>
                <input type="text" name="direccion" id="direccion" placeholder="<?php echo $direccion; ?>">

                <label for="mail">Correo electrónico</label>
                <input type="text" name="mail" id="mail" placeholder="<?php echo $mail; ?>">

                <label for="telefono">Teléfono</label>
                <input type="text" name="telefono" id="telefono" placeholder="<?php echo $telefono; ?>">

                <button name="guardar" id="modif-usu">Guardar</button>
                <button name="cancelar" id="cancelar-modif-usu">Cancelar</button>
            </form>

            <?php
            } //FIN boton modificar datos usuario
        
            //si se pulsa el boton 'guardar' (form modif)
            if (isset($_POST['guardar'])) {

                //variable con el id de usuario
                $id_usuario = $_SESSION['id_usu'];

                /*Recojo imagen*/

                //Nombre de nuestro archivo
                $file = $_FILES["imagen_usuario"]["name"];

                //Variable validadora
                $validator = 1;

                //Extensión de nuestro archivo
                $file_type = $_FILES["imagen_usuario"]["type"];

                //Ruta temporal a donde se carga el archivo 
                $url_temp = $_FILES["imagen_usuario"]["tmp_name"];

                //Ruta absoluta hasta el archivo en ejecución
                $url_insert = dirname(__FILE__) . "/assets/img"; //Carpeta donde subiremos nuestros archivos
        
                //Ruta donde se guardara el archivo, usamos str_replace para reemplazar los "\" por "/"
                $url_target = str_replace('\\', '/', $url_insert) . '/' . $file;

                //Si la carpeta no existe, la creamos
                if (!file_exists($url_insert)) {
                    mkdir($url_insert, 0777, true);
                }

                //Validamos el tamaño del archivo
                $file_size = $_FILES["imagen_usuario"]["size"];
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
                $url_imagen_usuario = "." . substr($url_target, 24);

                //variables con los datos del formulario de modificacion
                $nombre_usuario = $_POST['nombre_usuario'];
                $nombre = $_POST['nombre'];
                $apellidos = $_POST['apellidos'];
                $direccion = $_POST['direccion'];
                $mail = $_POST['mail'];
                $telefono = $_POST['telefono'];

                //comprovamos que no haya campos vacios
                if (!empty($nombre_usuario) && !empty($nombre) && !empty($apellidos) && !empty($direccion) && !empty($mail) && !empty($telefono) && !empty($url_imagen_producto)) {

                    //Modificamos por los valores indicados
                    $query = "UPDATE usuarios SET nombre_usuario = '$nombre_usuario', nombre = '$nombre', apellidos = '$apellidos', 
                    direccion = '$direccion', mail = '$mail', telefono = '$telefono', imagen_usuario = '$url_imagen_usuario' 
                    WHERE id_usuario = $id_usuario";

                    $consultaModificacion = conexion()->query($query);
                } else {
                    //mensaje de error campos vacios
                    echo '<p class="err">No pueden haber campos vacios.</p>';
                } //FIN campos vacios
            } //FIN boton 'guardar'
        } //FIN REQUEST_METHOD
        ?>
</main>
<?php
//desconexion bbdd
desconexion(conexion());

//incluyo el pie de página
include('assets/pie.php');
?>