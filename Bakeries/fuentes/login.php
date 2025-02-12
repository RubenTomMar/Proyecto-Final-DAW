<?php
/**
 * Archivo de login del usuario
 * En caso de no esncontrarse dicho usuario tambien es posible registrarse
 */

//añado las sesiones
session_start();

//incluimos fichero funciones y carrito
include('assets/funciones.php');
include('assets/carrito.php');

//incluyo la cabecera
include('assets/cabecera.php');

//en caso de haber iniciado sesion ya no es necesario el login
if (isset($_SESSION['rol'])) {

    //redirige al index.php
    header('location:../index.php');
}
?>
<main>
    <!--Formulario de login-->
    <h2>Iniciar sesión</h2>
    <form action="login.php" method="post" id="form-login" class="form">
        <label for="mail">Correo electrónico </label>
        <input type="email" name="mail" id="mail">

        <label for="clave">Contraseña</label>
        <input type="password" name="clave" id="clave">

        <input type="submit" name="iniciar" id="iniciar" value="Iniciar Sesión">
    </form>

    <!--Lleva a registro.php-->
    <a class="registro" href="registro.php">¿No tiene una cuenta? Registrarse ahora</a>

    <?php
    //compruebo que el metodo del formulario sea post
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        //compruebo que se haya pulsado el boton de iniciar sesion
        if (isset($_POST['iniciar'])) {

            //guardo los valores del formulario en variables
            $mail = $_POST['mail'];
            $clave = $_POST['clave'];

            //compruebo que las variables no esten vacias
            if (!empty($mail) && !empty($clave)) {

                //consulta para comprobar si el usuario existe
                $consultaUsuario = conexion()->query("SELECT * FROM usuarios WHERE mail = '$mail' AND clave = '$clave'");

                //si devuelve 1 es que existe
                if (mysqli_num_rows($consultaUsuario) == 1) {

                    //recojo valores asociados de la bbdd
                    while ($dato = $consultaUsuario->fetch_assoc()) {

                        //guardo los valores en variables
                        $id_usu = $dato['id_usuario'];
                        $nom_usu = $dato['nombre_usuario'];
                        $rol = $dato['rol'];

                        //creo las variables de sesion con los valores del usaurio logeado
                        $_SESSION['id_usu'] = $id_usu;
                        $_SESSION['nom_usu'] = $nom_usu;
                        $_SESSION['rol'] = $rol;
                    } //FIN while

                    //redirijo al index
                    header('location:cuenta_usuario.php');
                } else { //en caso de no encontrar un usaurio con esos datos muestro un mensaje de error
                    echo '<p class="err">No existe este usuario.</p>';
                }
            } else { //en caso de qie los campos estén vacios salta este error
    
                //mensaje de error
                echo '<p class="err">No pueden haber campos vacios.</p>';
            } //FIN campos vacios
        } //FIN boton 'iniciar'
    } //FIN method post
    ?>
</main>
<?php
//desconexion bbdd
desconexion(conexion());

//incluyo el pie de página
include('assets/pie.php');
?>