<?php
/*
 *Archivo que muestra los datos de un unico producto previamente selecionado por el usuario (por id)
 */

//iniciamos la sesion
session_start();

//incluimos archivos funciones y carrito
include('assets/funciones.php');
include('assets/carrito.php');

//incluimos la cabecera
include('assets/cabecera.php');

//cmprobamos si se ha indicado un producto
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = 1; //si no mostramos este por defecto
}

//consulta para recoger los datos del producto seleccionado
$consultaProducto = conexion()->query("SELECT * FROM productos WHERE id_producto = '$id'");

//recorremos los datos
while ($producto = $consultaProducto->fetch_assoc()) {

    //recogemos la url de la img 'recortada' (./fuentes/) para poder verla desde este archivo
    $img = substr($producto['imagen_producto'], 10);
    ?>
    <main>
        <!--Producto-->
        <div class="producto">
            <div class="img_producto"><img src="<?php echo $img; ?>" class="img"></div>

            <div class="nombre">
                <h2><?php echo $producto['nombre_producto']; ?></h2>
            </div>

            <div class="descripcion">
                <h3>Descripción</h3><?php echo $producto['descripcion']; ?>
            </div>

            <div class="precio"><?php echo $producto['precio'] . ' €'; ?></div>

            <div class="btn-carrito">
                <form action="" method="post">
                    <!--Valores del producto seleccoionado para añadir al carrito (encriptado)-->
                    <input type="hidden" name="id" id="id"
                        value="<?php echo openssl_encrypt($producto['id_producto'], COD, KEY); ?>">
                    <input type="hidden" name="nombre" id="nombre"
                        value="<?php echo openssl_encrypt($producto['nombre_producto'], COD, KEY); ?>">
                    <input type="hidden" name="precio" id="precio"
                        value="<?php echo openssl_encrypt($producto['precio'], COD, KEY); ?>">
                    <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1, COD, KEY); ?>">

                    <button type="submit" name="carrito" value="agregar" class="card-btn">Añadir al carrito</button>
                </form>
            </div>
        </div>
    </main>
<?php } //FIN while
//desconexion bbdd
desconexion(conexion());

//incluimos el pie 
include('assets/pie.php');
?>