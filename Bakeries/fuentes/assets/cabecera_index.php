<?php
/** 
 * Archivo que contiene los enlaces de css, js y menú de navegacion para el archivo index 
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bakeries</title>

    <!--LINKS FONTAWESOME-->
    <script src="https://kit.fontawesome.com/05535acec9.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="fuentes/assets/css/fontawesome.css">

    <!--LINKS FANCYBOX-->
    <script type="text/javascript" src="fuentes/assets/fancybox/fancybox.umd.js"></script>
    <link rel="stylesheet" href="fuentes/assets/fancybox/fancybox.css">

    <!--LINKS JQUERY-->
    <script type="text/javascript" src="fuentes/assets/js/jquery-3.7.1.min.js"></script>

    <!--LINKS CSS-->
    <link rel="stylesheet" href="fuentes/assets/css/main.css">
    <link rel="stylesheet" href="fuentes/assets/css/listado.css">
    <link rel="stylesheet" href="fuentes/assets/css/form.css">
    <link rel="stylesheet" href="fuentes/assets/css/table.css">
    <link rel="stylesheet" href="fuentes/assets/css/producto.css">
    <link rel="stylesheet" href="fuentes/assets/css/header.css">
    <link rel="stylesheet" href="fuentes/assets/css/footer.css">
    <link rel="stylesheet" href="fuentes/assets/css/slideshow.css">
    <link rel="stylesheet" href="fuentes/assets/css/cuenta.css">

    <!--LINKS JS-->
    <script type="text/javascript" src="fuentes/assets/js/menu.js"></script>
    <script type="text/javascript" src="fuentes/assets/js/regex-login.js"></script>
    <script type="text/javascript" src="fuentes/assets/js/regex-registro.js"></script>
    <script type="text/javascript" src="fuentes/assets/js/regex-modif-usu.js"></script>
    <script type="text/javascript" src="fuentes/assets/js/api-tiempo.js"></script>
    <script type="text/javascript" src="fuentes/assets/js/slideshow.js"></script>
    <script type="text/javascript" src="fuentes/assets/js/date.js"></script>
    <script type="text/javascript" src="fuentes/assets/js/foro.js"></script>
</head>

<header>
    <nav class="hdr-nav">
        <!--LOGO-->
        <div class="hdr-1">
            <a href="index.php"><img class="logo" src="fuentes/assets/img/logo.png"></a>
        </div>

        <!--MENÚ ADMIN-->
        <div class="hdr-2">
            <div class="hdr-admin">
                <?php
                //compruebo que tenga el rol admin para mostrar este menú
                if (isset($_SESSION['rol'])) {

                    echo '<i id="menu-icon" class="fa-solid fa-bars"></i>';

                    if ($_SESSION['rol'] == 'admin') {
                        echo '<ul id="menu">';
                        echo '<li><a href="fuentes/alta.php">Añadir producto</a></li>';
                        echo '<li><a href="fuentes/listado_pdf.php">Lista de productos</a></li>';
                        echo '<li><a href="fuentes/listado_modif.php">Control de productos</a></li>';
                        echo '</ul>';
                    }
                }
                ?>
            </div>
        </div>

        <!--INICIO DE SESIÓN Y CARRITO-->
        <div class="hdr-3">
            <div class="hdr-session">
                <a class="a-sesion" href="fuentes/cuenta_usuario.php"><i class="fa-solid fa-user"></i>
                    <?php
                    //si el usuario inició sesión lo indica con el nombre de usuario si no pone "Iniciar sesión"
                    if (isset($_SESSION['rol']))
                        echo '<p>' . $_SESSION['nom_usu'] . '</p>';
                    else
                        echo '<p>Iniciar sesión</p>';
                    ?>
                </a>
            </div>

            <div class="hdr-carrito">
                <!--Muestro la cantidad de producto que hay en el carrito-->
                <a href="fuentes/mostrar_carrito.php"><i class="fa-solid fa-cart-shopping"></i>
                    <p>(
                        <?php
                        if (empty($_SESSION['carrito'])) {
                            echo 0;
                        } else
                            echo count($_SESSION['carrito']);
                        ?>)
                    </p>
                </a>
            </div>
        </div>
    </nav>
</header>

<body>