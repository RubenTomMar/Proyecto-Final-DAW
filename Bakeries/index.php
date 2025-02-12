<?php
/**
 * Fichero con la pagina principal de la webapp donde se muestran varios productos 
 */

//iniciamos las variabels de sesion
session_start();

//incluimos ficheros funciones.php y carrito.php
include('fuentes/assets/funciones.php');
include('fuentes/assets/carrito.php');

//incluyo la cabecera
include('fuentes/assets/cabecera_index.php');
?>

<main>
    <div class="productos">
        <div class="titulo">
            <h2>NUEVOS PRODUCTOS <a class="ver-mas" href="fuentes/listado_productos.php">Ver más</a></h2>
            <hr>
        </div>

        <!--Card de Productos General-->
        <div class="lista-productos">

            <?php
            //consulta simple para mostrar ultimos productos añadidos
            $consulta_producto = conexion()->query("SELECT * FROM productos ORDER BY id_producto DESC LIMIT 4");

            //muestro los productos de la bbdd
            while ($producto = $consulta_producto->fetch_assoc()) {
                ?>
                <!--Si clikea el usuario sobre la card le lleva  auna página (mostrar_producto.php) donde puede ver el producto clikado-->
                <a href="<?php echo 'fuentes/mostrar_producto.php?id=' . $producto['id_producto']; ?>">

                    <!--Card producto-->
                    <div class="card">

                        <img class="card-img" src="<?php echo $producto['imagen_producto']; ?>"
                            alt="<?php echo $producto['nombre_producto']; ?>" />

                        <div class="card-body">

                            <p class="card-title"><?php echo $producto['nombre_producto'] ?></p>

                            <p class="card-text"><?php echo $producto['precio'] ?></p>

                            <form action="" method="post">
                                <!--Valores del producto seleccoionado para añadir al carrito (encriptado)-->
                                <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['id_producto'], COD, KEY);
                                ; ?>">
                                <input type="hidden" name="nombre" id="nombre"
                                    value="<?php echo openssl_encrypt($producto['nombre_producto'], COD, KEY); ?>">
                                <input type="hidden" name="precio" id="precio"
                                    value="<?php echo openssl_encrypt($producto['precio'], COD, KEY); ?>">
                                <input type="hidden" name="cantidad" id="cantidad"
                                    value="<?php echo openssl_encrypt(1, COD, KEY); ?>">

                                <button name="carrito" value="agregar" class="card-btn">Añadir al carrito</button>
                            </form>
                        </div>
                    </div>
                </a>
            <?php } //FIN while ?>
        </div>

        <div class="titulo">
            <h2>PANES</h2>
            <hr>
        </div>

        <!--Card de Productos Panes-->
        <div class="lista-productos">

            <?php
            //consulta simple para mostrar los productos que sean panes
            $consulta_producto = conexion()->query("SELECT * FROM productos WHERE categoria = 'panes' ORDER BY id_producto ASC LIMIT 4");

            //muestro los productos de la bbdd
            while ($producto = $consulta_producto->fetch_assoc()) {
                ?>
                <!--Si clikea el usuario sobre la card le lleva  auna página (mostrar_producto.php) donde puede ver el producto clikado-->
                <a href="<?php echo 'fuentes/mostrar_producto.php?id=' . $producto['id_producto']; ?>">

                    <!--Card producto-->
                    <div class="card">

                        <img class="card-img" src="<?php echo $producto['imagen_producto']; ?>"
                            alt="<?php echo $producto['nombre_producto']; ?>" />

                        <div class="card-body">

                            <h5 class="card-title"><?php echo $producto['nombre_producto'] ?></h5>

                            <p class="card-text"><?php echo $producto['precio'] ?></p>

                            <form action="" method="post">
                                <!--Valores del producto seleccoionado para añadir al carrito (encriptado)-->
                                <input type="hidden" name="id" id="id"
                                    value="<?php echo openssl_encrypt($producto['id_producto'], COD, KEY); ?>">
                                <input type="hidden" name="nombre" id="nombre"
                                    value="<?php echo openssl_encrypt($producto['nombre_producto'], COD, KEY); ?>">
                                <input type="hidden" name="precio" id="precio"
                                    value="<?php echo openssl_encrypt($producto['precio'], COD, KEY); ?>">
                                <input type="hidden" name="cantidad" id="cantidad"
                                    value="<?php echo openssl_encrypt(1, COD, KEY); ?>">

                                <button type="submit" name="carrito" value="agregar" class="card-btn">Añadir al
                                    carrito</button>
                            </form>
                        </div>
                    </div>
                </a>
            <?php } //FIN while ?>
        </div>

        <div class="titulo">
            <h2>TARTAS & PASTELES</h2>
            <hr>
        </div>

        <!--Card de Productos Pasteles-->
        <div class="lista-productos">

            <?php
            //consulta simple para mostrar los productos que sean pasteles 
            $consulta_producto = conexion()->query("SELECT * FROM productos WHERE categoria = 'pasteles' ORDER BY id_producto ASC LIMIT 4");

            //muestro los productos de la bbdd
            while ($producto = $consulta_producto->fetch_assoc()) {
                ?>
                <!--Si clikea el usuario sobre la card le lleva  auna página (mostrar_producto.php) donde puede ver el producto clikado-->
                <a href="<?php echo 'fuentes/mostrar_producto.php?id=' . $producto['id_producto']; ?>">

                    <!--Card producto-->
                    <div class="card">

                        <img class="card-img" src="<?php echo $producto['imagen_producto']; ?>"
                            alt="<?php echo $producto['nombre_producto']; ?>" />

                        <div class="card-body">

                            <h5 class="card-title"><?php echo $producto['nombre_producto'] ?></h5>

                            <p class="card-text"><?php echo $producto['precio'] ?></p>

                            <form action="" method="post">
                                <!--Valores del producto seleccoionado para añadir al carrito (encriptado)-->
                                <input type="hidden" name="id" id="id"
                                    value="<?php echo openssl_encrypt($producto['id_producto'], COD, KEY); ?>">
                                <input type="hidden" name="nombre" id="nombre"
                                    value="<?php echo openssl_encrypt($producto['nombre_producto'], COD, KEY); ?>">
                                <input type="hidden" name="precio" id="precio"
                                    value="<?php echo openssl_encrypt($producto['precio'], COD, KEY); ?>">
                                <input type="hidden" name="cantidad" id="cantidad"
                                    value="<?php echo openssl_encrypt(1, COD, KEY); ?>">

                                <button type="submit" name="carrito" value="agregar" class="card-btn">Añadir al
                                    carrito</button>
                            </form>
                        </div>
                    </div>
                </a>
            <?php } //FIN while
            //desconecyamos bbdd
            desconexion(conexion());
            ?>
        </div>
    </div>
</main>
<?php
//incluyo el pie de página
include('fuentes/assets/pie_index.php');
?>