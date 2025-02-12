<?php
/**
 * Se muestra con paginacion una serie de productos segun su categoria o todos en general
 */

//iniciamos sesion
session_start();

//incluimos los ficheros funciones y carrito
include('assets/funciones.php');
include('assets/carrito.php');

//incluimos la cabecera
include('assets/cabecera.php');
?>

<main>
    <!--Formulario de Orden, Categoria-->
    <form action="listado_productos.php" method="post" id="form-orden" class="form-orden">

        <!--Select Orden-->
        <label for="orden">Ordenar por</label>

        <select name="orden" id="orden">
            <option value="nombre_producto" selected>Nombre</option>
            <option value="precio">Precio</option>
        </select>

        <!--Select Procedencia-->
        <label for="categoria">Categoría</label>

        <select name="categoria" id="categoria">
            <option value="panes" selected>Panes</option>
            <option value="bolleria">Bollería</option>
            <option value="salado">Salado</option>
            <option value="pasteles">Pasteles</option>
        </select>

        <input type="submit" name="buscar" value="Buscar">
    </form>

    <div class="titulo">
        <h2>
            <?php
            //segun si se pulsa el boton o no se muestra o 'NUESTROS PRODUCTOS'
            if (!isset($_POST['buscar'])) {
                echo 'NUESTROS PRODUCTOS';
            } else { // o la categoria que esté buscando el usuario (en mayusculas)
                echo strtoupper($_POST['categoria']);
            }
            ?>
        </h2>
        <hr>
    </div>

    <div class="listado-productos">
        <?php
        //si NO se pulsa el boton 'buscar' muestro todos los productos
        if (!isset($_POST['buscar'])) {

            //numero de productos que mostare por pagina
            $numProductosPorPagina = 15;

            //comprobamos si tiene valor la pagina
            if (isset($_GET['pagina'])) {

                //si lo tiene recibe el valor de la url
                $pagina = $_GET['pagina'];
            } else {
                //si no tiene se le pone 1 por defecto
                $pagina = 1;
            }

            //variable que usaremos en la consulta para el LIMIT
            //se calcula mediante el valor de la pagina menos 1 y esto se multiplica por el num de productos a mostrar
            $limiteInicial = ($pagina - 1) * $numProductosPorPagina;

            //consuta en la que indicamos la cantidad de productos que mostramos (LIMIT)
            //EJEMPLO $pagina = 1 -> $limiteInicial = (1 - 1) * 15 -> $limiteInicial = 0
            //LIMIT 0, 15 
            //entonces se mostrarán los 15 primeros productos                                                      
            $consultaLimite = conexion()->query("SELECT * FROM productos LIMIT $limiteInicial, $numProductosPorPagina");

            //muestro los productos de la bbdd
            while ($producto = $consultaLimite->fetch_assoc()) {

                //recogemos la url de la img 'recortada' (./fuentes/) para poder verla desde este archivo
                $img = substr($producto['imagen_producto'], 10);
                ?>
                <!--Si clikea el usuario sobre la card le lleva  auna página (mostrar_producto.php) donde puede ver el producto clikado-->
                <a href="<?php echo 'mostrar_producto.php?id=' . $producto['id_producto']; ?>">

                    <!--Card producto-->
                    <div class="card">

                        <img class="card-img" src="<?php echo $img; ?>" alt="<?php echo $producto['nombre_producto']; ?>" />

                        <div class="card-body">

                            <h5 class="card-title"><?php echo $producto['nombre_producto'] ?></h5>

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
            <?php } //FIN while

            //consulta que usamos para saber la cantidad de producto que tenemos
            $consultaSimple = conexion()->query('SELECT * FROM productos');

            //calculamos el total de productos
            $numProductosTotales = mysqli_num_rows($consultaSimple);

            //calculamos cuantas páginas tendremos en total
            //para ello dividimos el num de productos en la bbdd entre los productos que mostramos por página
            //y usamos ceil para que sean numero enteros y no decimales
            $numPaginasTotales = ceil($numProductosTotales / $numProductosPorPagina);

        } else { //en caso de que se pulse el boton 'buscar'
        
            //variables con los datos del form buscar
            $orden = $_POST['orden'];
            $categoria = $_POST['categoria'];

            //consulta con los valores de busqueda
            $consultaOrden = conexion()->query("SELECT * FROM productos WHERE categoria = '$categoria' ORDER BY '$orden'");

            //muestro los productos de la bbdd
            while ($producto = $consultaOrden->fetch_assoc()) {

                //recogemos la url de la img 'recortada' (./fuentes/) para poder verla desde este archivo
                $img = substr($producto['imagen_producto'], 10);
                ?>
                <!--Si clikea el usuario sobre la card le lleva  auna página (mostrar_producto.php) donde puede ver el producto clikado-->
                <a href="<?php echo 'mostrar_producto.php?id=' . $producto['id_producto']; ?>">

                    <!--Card producto-->
                    <div class="card">

                        <img class="card-img" src="<?php echo $img; ?>" alt="<?php echo $producto['nombre_producto']; ?>" />

                        <div class="card-body">

                            <h5 class="card-title"><?php echo $producto['nombre_producto'] ?></h5>

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

            <?php } //FIN while
        } //FIN else boton buscar
        ?>
    </div>
    <?php
    //solo se muestra la paginacion si se pulsa el boton
    if (!isset($_POST['buscar'])) {
        ?>
        <!--Manejo de la paginacion-->
        <div class="paginas">
            <!--Referencia a la primera página-->
            <a href="listado_productos.php?pagina=1"><i class="fa-solid fa-chevron-left"></i></a>
            <?php
            //usamos un bucle for para mostrar las paginas
            for ($i = 1; $i <= $numPaginasTotales; $i++) {
                ?>
                <!--Mostramos todas las páginas-->
                <a href="<?php echo 'listado_productos.php?pagina=' . $i; ?>"><?php echo $i ?></a>
                <?php
            }
            ?>
            <!--Referencia a la ultima página-->
            <a href="<?php echo 'listado_productos.php?pagina=' . $numPaginasTotales; ?>"><i
                    class="fa-solid fa-chevron-right"></i></a>
        </div>
    <?php } ?>
</main>
<?php
//desconexion a la bbdd
desconexion(conexion());

//incluimos el pie
include('assets/pie.php');
?>