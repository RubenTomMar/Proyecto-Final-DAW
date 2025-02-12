<?php
/**
 * Archivo que muestra una tabla con los tipos seleccionados
 * También puedes descargar en pdf
 */

//inicimos sesion
session_start();

//incluimos fichero funciones
include("assets/funciones.php");

//comprobamos que el usuario tenga un rol asignado
if (!isset($_SESSION['rol'])) {
    header("Location:../index.php");
}

//comprobamos si tiene permisos (rol 'admin')
if (!permisos()) {
    header("Location:../index.php");
}

//incluimos cabecera
include("assets/cabecera.php");
?>
<main>
    <!--Formulario de Orden, Categoria y Procedencia-->
    <form action="listado_pdf.php" method="post" id="form-orden" class="form-orden">
        <!--Select Orden-->
        <label for="orden">Ordenar por</label>

        <select name="orden" id="orden">
            <option value="nombre_producto" selected>Nombre</option>
            <option value="precio">Precio</option>
        </select>

        <!--Select Categoria-->
        <label for="procedencia">Procedencia</label>

        <select name="procedencia" id="procedencia">
            <option value="alicante" selected>Alicante</option>
            <option value="valencia">Valencia</option>
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

    <?php
    //Comprobamos que el metodo sea 'post'
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        //si se pulsa el boton 'buscar'
        if (isset($_POST['buscar'])) {

            //variables con los datos del form
            $orden = $_POST['orden'];
            $procedencia = $_POST['procedencia'];
            $categoria = $_POST['categoria'];

            //guardamos las variables en variables de sesion (pdf)
            $_SESSION['orden'] = $orden;
            $_SESSION['procedencia'] = $procedencia;
            $_SESSION['categoria'] = $categoria;

            //consulta sacar datos especificos (orden, categoria y procedencia)
            $consultaOrden = conexion()->query("SELECT * FROM productos WHERE categoria = '$categoria' AND procedencia = '$procedencia' ORDER BY $orden");
            ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th  class="col-categoria">CATEGORÍA</th>
                    <th>PRECIO</th>
                    <th  class="col-procedencia">PROCEDENCIA</th>
                    <th>CANTIDAD</th>
                    <th>DESCRIPCIÓN</th>
                </tr>
                <?php
                //recorremos la ddbb de la consulta y mostramos los datos dentro de la tabla
                while ($productos = $consultaOrden->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $productos['id_producto']; ?></td>
                        <td><?php echo $productos['nombre_producto']; ?></td>
                        <td  class="col-categoria"><?php echo $productos['categoria']; ?></td>
                        <td><?php echo $productos['precio']; ?></td>
                        <td  class="col-procedencia"><?php echo $productos['procedencia']; ?></td>
                        <td><?php echo $productos['cantidad']; ?></td>
                        <td><?php echo $productos['descripcion']; ?></td>
                    </tr>
                <?php }// FIN while ?>
            </table>

            <!--Formulario para descargar tabla (descarga_pdf.php)-->
            <form action='descarga_pdf.php' method='post'>

                <input type='submit' name='descargar' value='Descargar en PDF'>

            </form>

            <?php
            //desconexion a la bbdd
            desconexion(conexion());
        } //FIN boton buscar
    } //FIN request method post
    ?>
</main>
<?php
//incluimos el pie de pagina
include("assets/pie.php");
?>