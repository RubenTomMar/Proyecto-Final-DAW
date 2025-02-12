<?php
/**
 * Archivo con diferentes funciones usadas por toda la webapp
 */

//calve y codigo de encriptacion para inputs hidden
define('KEY', 'bakeries');
define('COD', 'AES-128-ECB');

//funcion de conexion a la bbdd
function conexion()
{
    //conexion mediante (host, username, password, bbddname)
    $conexion = new mysqli('44.219.88.100', 'bakeries', '123', 'bakeries');

    return $conexion;
}

//funcion de desconexion a la bbdd
function desconexion($conexion)
{
    //cerramos la conexion co la bbdd
    $conexion->close();
}

//funcion que comprueba que el usuario tiene un rol y le da permisos al rol 'admin'
function permisos()
{
    //comprovamos si esta la sesion iniciada
    if (isset($_SESSION['rol'])) {

        //da permiso
        if ($_SESSION['rol'] == 'admin') {

            return true;
        } else { //no da permiso
            return false;
        }
    }
} //FIN funcion permisos

//funcion compruebo si un producto ya existe en la bbdd
function existeProducto($nombre, $procedencia, $categoria)
{ //valores recogidos para la comparacion

    //consulta del producto con esos datos enviados
    $query = "SELECT * FROM productos WHERE nombre_producto = '$nombre' AND procedencia = '$procedencia' AND categoria = '$categoria'";
    $consultaExisteProducto = conexion()->query($query);

    //si devuelve una fila existe el producto
    if (mysqli_num_rows($consultaExisteProducto) == 1) {

        return true;
    } else {
        return false;
    }
} //FIN funcion existeProducto

//funcion para comprobar si ya existe el nombre de usuario
function existeUsuario($nombre_usuario)
{
    //consulta del usuario con el dato enviado
    $query = "SELECT * FROM usuarios WHERE nombre_usuario = '$nombre_usuario'";
    $consultaExisteUsuario = conexion()->query($query);

    //si devuelve una fila existe el nombre de usuario
    if (mysqli_num_rows($consultaExisteUsuario) == 1) {

        return true;
    } else {
        return false;
    }
} //FIN funcion existeUsuario

//funcion para comprobar si ya existe el mail del usuario
function existeMail($mail)
{
    //consulta del mail del usuario con el dato enviado
    $query = "SELECT * FROM usuarios WHERE mail = '$mail'";
    $consultaExisteMail = conexion()->query($query);

    //si devuelve una fila existe el mail del usuario
    if (mysqli_num_rows($consultaExisteMail) == 1) {

        return true;
    } else {
        return false;
    }
} //FIN funcione existeMail
?>