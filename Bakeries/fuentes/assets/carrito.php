<?php
/**
 * En este archivo es donde se manejan todas las acciones del carrito de compra
 */

//compruebo que se hay pulsado el boton de 'añadir al carrito'
if (isset($_POST['carrito'])) {

    //compruebo el caso del boton carrito
    switch ($_POST['carrito']) {

        //BOTON AÑADIR PRODUCTO AL CARRITO//
        case 'agregar':

            //desencripto el valor, compruebo que es numérico y lo guardo en una veriable (ID)
            if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {

                $id = openssl_decrypt($_POST['id'], COD, KEY);
            }

            //desencripto el valor, compruebo que es string y lo guardo en una veriable (NOMBRE)
            if (is_string(openssl_decrypt($_POST['nombre'], COD, KEY))) {

                $nombre = openssl_decrypt($_POST['nombre'], COD, KEY);
            }

            //desencripto el valor, compruebo que es numérico y lo guardo en una veriable (PRECIO)
            if (is_numeric(openssl_decrypt($_POST['precio'], COD, KEY))) {

                $precio = openssl_decrypt($_POST['precio'], COD, KEY);
            }

            //desencripto el valor, compruebo que es numérico y lo guardo en una veriable (CANTIDAD)
            if (is_numeric(openssl_decrypt($_POST['cantidad'], COD, KEY))) {

                $cantidad = openssl_decrypt($_POST['cantidad'], COD, KEY);
            }

            //si NO está iniciada la var de sesion 'carrito'
            if (!isset($_SESSION['carrito'])) {

                //creo un array asociativo con los valores del producto
                $producto = array(
                    'id' => $id,
                    'nombre' => $nombre,
                    'cantidad' => $cantidad,
                    'precio' => $precio
                );

                //creo la sesion 'carrito' con los valores de el/los productos seleccionados
                $_SESSION['carrito'][0] = $producto;

            //si sí existe la var sesion 'carrito'
            } else {

                //array con toods los 'id' del carrito
                $id_productos = array_column($_SESSION['carrito'], 'id');

                //compruebo si el producto que envia tiene un id igual a un producto ya añadido
                if (in_array($id, $id_productos)) {

                    //mensaje para que el usuario sepa que el producto seleccionado ya está en su carrito
                    echo '<script>alert("Ese producto ya se encuentra en su carrito");</script>';

                    //en caso de que no esté el producto se agrega
                } else {

                    //cuento los productos para despues poder introducir más en la sesion 'carrito'
                    $num_productos = count($_SESSION['carrito']);

                    $producto = array(
                        'id' => $id,
                        'nombre' => $nombre,
                        'cantidad' => $cantidad,
                        'precio' => $precio
                    );

                    //asigno los productos dentro de la sesion
                    $_SESSION['carrito'][$num_productos] = $producto;
                }
            }

            break; //FIN agragar producto al carrito

        //BOTON ELIMINAR PRODUCTO DEL CARRITO//
        case 'eliminar':

            //desencripto el valor, compruebo que es numérico
            if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {

                //lo guardo en una veriable
                $id = openssl_decrypt($_POST['id'], COD, KEY);

                //busco el id en la bariable de sesión 'carrito'
                foreach ($_SESSION['carrito'] as $indice => $producto) {

                    //compara el id de la variable con el guardado en el carrito
                    if ($producto['id'] == $id) {

                        //si encuentra ese id lo borra de la sesion 'carrito'
                        unset($_SESSION['carrito'][$indice]);
                        //echo '<script>alert("Elemento borrado");</script>'; !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
                        $_SESSION['carrito'] = array_values($_SESSION["carrito"]);
                    }
                }
            }

            break; //FIN eliminar producto del carrito

        //BOTON PAGAR PRODUCTO DEL CARRITO//
        case 'pagar':

            foreach ($_SESSION['carrito'] as $indice => $producto) {

                $id_producto = $_SESSION['carrito'][$indice]['id'];
                $nombre = $_SESSION['carrito'][$indice]['nombre'];
                $cantidad = $_SESSION['carrito'][$indice]['cantidad'];
                $precio = $_SESSION['carrito'][$indice]['precio'];

                $id_usuario = $_SESSION['id_usu'];
                $fecha = date('d-m-Y');

                $consultaPedido = conexion()->query("INSERT INTO pedidos (id_usuario, id_producto, nombre_producto, cantidad, precio, fecha)
                VALUES ('$id_usuario', '$id_producto', '$nombre', '$cantidad', '$precio', '$fecha')");
            }

            //borro la variable de sesion 'carrito'
            unset($_SESSION['carrito']);

            break; //FIN pagar producto/s del carrito
    }
}
?>