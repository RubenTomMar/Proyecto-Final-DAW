<?php
/**
 * Fichero que muestra una tabla del carrito de la compra del ususario
 * El usuaario tiene que loguearse para ver el carrito
 */

//iniciamos sesión
session_start();

//incluimos ficheros funciones y carrito
include('assets/funciones.php');
include('assets/carrito.php');

//incluyo la cabecera
include('assets/cabecera.php');

//en caso de no haber iniciado la sesion se le redirige al login
if (!isset($_SESSION['id_usu'])) {
    header('Location:login.php');
}
?>
<main>
    <h3>Tu carrito</h3>
    <?php
    //compruebo que exista contenido en el carrito (sesión 'carrito')
    //si existe contenido a mostrar
    if (!empty($_SESSION['carrito'])) {
        ?>

        <!--se muestra el carrito por una tabla-->
        <table class="table table-light table-bordered">

            <tr>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Total</th>
                <th>--</th>
            </tr>

            <?php
            //variable que contará el total a pagar
            $precio_total = 0;

            //se muestran los productos añadidos en la sesion 'carrito'
            foreach ($_SESSION['carrito'] as $indice => $producto) {
                ?>

                <tr>
                    <!--valores de los productos-->
                    <td><?php echo $producto['nombre']; ?></td>
                    <td><?php echo $producto['cantidad']; ?></td>
                    <td><?php echo $producto['precio']; ?></td>
                    <!--calculo valor precio por cantidad de artículos-->
                    <td>
                        <?php echo number_format($producto['cantidad'] * $producto['precio'], 2); ?>
                    </td>

                    <!--BOTÓN ELIMINAR producto CARRITO-->
                    <td>
                        <form action="" method="post">

                            <!--envio el id del producto a eliminar-->
                            <input type="hidden" name="id" id="id"
                                value="<?php echo openssl_encrypt($producto['id'], COD, KEY); ?>">

                            <!--sucede en carrito.php-->
                            <button class="btn-eliminar-carrito" name="carrito" value="eliminar">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                
                <?php
                //se calcula el precio total sumando así mismo el precio de cada producto por la cantidad del mismo 
                $precio_total = $precio_total + ($producto['cantidad'] * $producto['precio']);
            } //FIN foreach
            ?>

            <!--Parte de la tabla con el total a pagar-->
            <tr>
                <td>
                    <h3>Total</h3>
                </td>
                <td>
                    <!--Saco el total del carrito (max. dos decimales)-->
                    <h3><?php echo number_format($precio_total, 2); ?></h3>
                </td>
                <td></td>
            </tr>

            <!--Botón para pagar-->
            <tr>
                <td>
                    <form action="" method="post">

                        <?php $id_usuario = $_SESSION['id_usu']; ?>
                        <!--envio el id del usuario-->
                        <input type="hidden" name="id_usu" id="id_usu"
                            value="<?php echo openssl_encrypt($id_usuario, COD, KEY); ?>">

                        <!--sucede en carrito.php-->
                        <button class="btn-pagar" name="carrito" value="pagar">Pagar</button>

                    </form>
                </td>
            </tr>
        </table>
    <?php } else {
        //mesaje carrito vacio
        echo "<p>No hay productos en el carrito</p>";
    }
    ?>
</main>
<?php
//incluimos el pie de pagina
include('assets/pie.php');
?>