<?php
/**
 * Fichero en el que un usuario puede registrarse si no tiene una cuenta
 */

//iniciamos variables de sesión
session_start();

//incluimos ficheros funciones.php y carrito.php
include('assets/funciones.php');
include('assets/carrito.php');

//incluyo la cabecera
include('assets/cabecera.php');
?>

<main>
    <!--Formulario de Registro-->
    <form action="registro.php" method="post" id="form-registro" class="form">

        <label for="nombre_usuario">Nombre de usuario</label>
        <input type="text" name="nombre_usuario" id="nombre-usuario"
            placeholder="El nombre con el que quieres que el resto de usuarios te vean">

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" placeholder="Tu nombre">

        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" id="apellidos" placeholder="Tu/s apellido/s">

        <label for="mail">Correo electrónico</label>
        <input type="text" name="mail" id="mail" placeholder="usuario@gmail.com">

        <label for="clave">Contraseña</label>
        <input type="password" name="clave" id="clave"
            placeholder="Mínimo de 8 caracteres, 1 mayúscula, 1 número y un caracter">

        <label for="direccion">Direccion</label>
        <input type="text" name="direccion" id="direccion" placeholder="C/ Los Alamos nº10">

        <label for="telefono">Teléfono</label>
        <input type="text" name="telefono" id="telefono" placeholder="123456789">

        <button name="registrarse" id="registrarse">Registrarse</button>
    </form>

    <?php
    //comprobamos que el método sea post
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        //comprobamos que se pulse el boton 'registrarse'
        if (isset($_POST['registrarse'])) {

            //variables con los datos del nuevo usario
            //imagen por defecto editable en cuanta_usuario.php (la pagina donde el usario puede consultar sus datos)
            $imagen_usuario = './fuentes/assets/img/defect_img.png';
            $nombre_usuario = $_POST['nombre_usuario'];
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $mail = $_POST['mail'];
            $clave = $_POST['clave'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];

            //comprobamos que los campos no estén vacios
            if (!empty($nombre_usuario) && !empty($nombre) && !empty($apellidos) && !empty($mail) && !empty($clave) && !empty($direccion) && !empty($telefono)) {

                //comprobamos si existe el correo introducido
                if (!existeMail($mail)) {

                    //comprobamos que no haya un nombre de usuario igual
                    if (!existeUsuario($nombre_usuario)) {

                        //query consulta para insertar el nuevo usuario
                        //rol = normal (por defecto)
                        $query = "INSERT INTO usuarios (nombre_usuario, nombre, mail, clave, direccion, telefono, rol, imagen_usuario, apellidos) 
                        VALUES ('$nombre_usuario', '$nombre', '$mail', '$clave', '$direccion', '$telefono', 'normal', '$imagen_usuario', '$apellidos')";

                        $consultaNuevoUsuario = conexion()->query($query);

                        //si tiene efecto la consulta...
                        if ($consultaNuevoUsuario) {

                            //creo otra consulta para crear las variables de sesión para logear al usuario automáticamnete
                            $consultaSesion = conexion()->query("SELECT * FROM usuarios WHERE mail = '$mail' AND clave = '$clave'");

                            //recojo las variables de sesion
                            while ($datos = $consultaSesion->fetch_assoc()) {
                                $_SESSION['id_usu'] = $datos['id_usuario'];
                                $_SESSION['nom_usu'] = $datos['nombre_usuario'];
                                $_SESSION['rol'] = $datos['rol'];
                            }

                            //deconexion bbdd
                            desconexion(conexion());

                            //redirijo al index
                            header('Locaton: ../index.php');
                        }
                    } else { //FIN existe nombre de usuario
                        echo '<p class="err">Hay alguin con este nombre de usuario, pruebe con otro<p>';
                    }
                } else { //FIN existe email
                    echo '<p class="err">Ya hay una cuenta con este correo electrónico.</p>';
                }
            } else { //FIN campos vacios
                echo '<p class="err">Hay campos vacios.</p>';
            }
        } //FIN pulsar boton 'registrarse'
    } //FIN method post
    ?>
</main>

<?php
//incluyo el pie de página
include('assets/pie.php');
?>