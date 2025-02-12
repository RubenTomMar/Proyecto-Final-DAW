-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-02-2025 a las 23:08:01
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bakeries`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(50) NOT NULL,
  `id_usuario` int(50) NOT NULL,
  `id_producto` int(50) NOT NULL,
  `nombre_producto` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `cantidad` int(10) NOT NULL,
  `precio` varchar(4) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` varchar(15) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `precio` decimal(3,2) NOT NULL,
  `procedencia` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `categoria` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `cantidad` int(3) NOT NULL,
  `descripcion` text COLLATE utf8_spanish2_ci NOT NULL,
  `imagen_producto` varchar(255) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre_producto`, `precio`, `procedencia`, `categoria`, `cantidad`, `descripcion`, `imagen_producto`) VALUES
(1, 'Chapata', '2.00', 'alicante', 'panes', 33, 'Disfruta de nuestro auténtico pan de chapata, con su corteza crujiente y miga suave. Perfecto para acompañar tus comidas o para preparar deliciosos sándwiches.', './fuentes/assets/img/chapata.jpg'),
(2, 'Magdalena', '1.50', 'valencia', 'bolleria', 50, 'Nuestras magdalenas son un clásico irresistible. Esponjosas y ligeras, son ideales para un desayuno o merienda, acompañadas de un buen café o té.', './fuentes/assets/img/magdalenas.jpg'),
(3, 'Magdalena de bizcocho', '2.00', 'alicante', 'bolleria', 33, 'Una variante más densa y sabrosa, la magdalena de bizcocho es perfecta para los amantes de los sabores intensos. Su textura suave y su dulzura equilibrada la convierten en un placer para cualquier ocasión.', './fuentes/assets/img/magdalena_de_bizcocho.jpg'),
(4, 'Barra de pan', '1.00', 'alicante', 'panes', 33, 'La barra de pan es un básico en cualquier mesa. Con su corteza dorada y su interior esponjoso, es ideal para acompañar tus comidas o disfrutar con un poco de aceite de oliva.', './fuentes/assets/img/barra_pan.jpg'),
(5, 'Torta', '2.00', 'alicante', 'salado', 33, 'Nuestra torta salada es una opción deliciosa y versátil. Rellena de ingredientes frescos y sabrosos, es perfecta para un almuerzo ligero o una cena informal.', './fuentes/assets/img/torta.jpg'),
(6, 'Cruasán', '1.50', 'valencia', 'bolleria', 33, 'Déjate seducir por nuestros cruasanes, hojaldrados y mantecosos. Perfectos para un desayuno elegante o un capricho a cualquier hora del día.', './fuentes/assets/img/cruasan.jpg'),
(7, 'Campera', '2.00', 'valencia', 'panes', 33, 'La campera es un pan tradicional, ideal para disfrutar con embutidos o quesos. Su textura suave y su sabor auténtico la hacen un acompañante perfecto para cualquier comida.', './fuentes/assets/img/campera.jpg'),
(8, 'Rústica', '2.50', 'alicante', 'panes', 33, 'Nuestro pan rústico es elaborado con ingredientes de alta calidad, ofreciendo un sabor robusto y una textura crujiente. Ideal para quienes buscan un pan con carácter.', './fuentes/assets/img/rustica.jpg'),
(9, 'Baguette', '1.50', 'valencia', 'panes', 33, 'La baguette es un clásico francés que no puede faltar. Con su corteza crujiente y su miga aireada, es perfecta para hacer sándwiches o disfrutar con un poco de mantequilla.', './fuentes/assets/img/baguette.jpg'),
(10, 'Empanadilla', '1.00', 'alicante', 'salado', 33, 'Disfruta de nuestra empanadilla de atún, tomate y huevo, una combinación deliciosa y jugosa. Perfecta para un aperitivo o un almuerzo rápido, ¡te encantará su sabor!', './fuentes/assets/img/empanadilla_atun.jpg'),
(11, 'Empanadilla York queso', '1.00', 'valencia', 'salado', 33, 'La empanadilla de jamón york y queso es un clásico que nunca falla. Con su masa crujiente y su relleno cremoso, es ideal para cualquier momento del día.', './fuentes/assets/img/empanadilla_york_queso.jpg'),
(12, 'Napolitana York queso', '1.50', 'alicante', 'salado', 33, 'Nuestra napolitana de jamón york y queso es una opción sabrosa y reconfortante. Ideal para un desayuno o merienda, su combinación de sabores te hará sonreír en cada bocado.', './fuentes/assets/img/napo_york_queso.jpg'),
(13, 'Napolitana de chocolate', '1.50', 'alicante', 'bolleria', 33, 'Déjate llevar por la dulzura de nuestra napolitana de chocolate. Con su masa hojaldrada y un generoso relleno de chocolate, es el capricho perfecto para los amantes del dulce.', './fuentes/assets/img/napo_choco.jpg'),
(14, 'Napolitana de crema', '1.50', 'valencia', 'bolleria', 33, 'La napolitana de crema es un deleite suave y dulce. Con su relleno cremoso y su masa crujiente, es perfecta para disfrutar en cualquier momento del día.', './fuentes/assets/img/napo_crema.jpg'),
(15, 'Torta de migas', '2.00', 'alicante', 'salado', 33, 'Disfruta de nuestra deliciosa torta de migas, un plato salado tradicional que combina migas de pan. Perfecta para un almuerzo reconfortante o una cena ligera. ¡Sabor auténtico en cada bocado!', './fuentes/assets/img/torta_migas.jpg'),
(16, 'Tarta de queso', '4.50', 'alicante', 'pasteles', 33, 'La tarta de queso es un clásico que nunca pasa de moda. Cremosa y deliciosa, con una base crujiente, es el postre perfecto para cualquier celebración o simplemente para darte un gusto.', './fuentes/assets/img/tarta_queso.jpg'),
(17, 'Tarta de frutas', '3.50', 'alicante', 'pasteles', 33, 'Nuestra tarta de frutas es un festín visual y gustativo. Con una base de masa crujiente y una variedad de frutas frescas, es un postre ligero y refrescante que encantará a todos.', './fuentes/assets/img/tarta_frutas.jpg'),
(18, 'Tarta de la abuela', '2.50', 'valencia', 'pasteles', 33, 'La tarta de la abuela es un homenaje a los sabores caseros. Con su mezcla de ingredientes frescos y un toque de nostalgia, es el postre ideal para disfrutar en familia y recordar los buenos momentos.', './fuentes/assets/img/tarta_choco.jpg'),
(19, 'Tarta de calabaza', '3.00', 'alicante', 'pasteles', 33, 'Saborea la exquisita tarta de calabaza, elaborada con puré de calabaza y especias aromáticas. Su textura cremosa y su dulzura sutil la convierten en el postre ideal para cualquier ocasión, especialmente en otoño. ¡Un clásico que no te puedes perder!', './fuentes/assets/img/tarta_calabaza.jpg'),
(20, 'Tarta de manzana', '4.00', 'valencia', 'pasteles', 33, 'Prueba nuestra irresistible tarta de manzana, hecha con manzanas frescas y un toque de canela. Con su crujiente masa y su relleno jugoso, es el postre perfecto para disfrutar solo o acompañado de helado. ¡Un deleite para los amantes de la manzana!', './fuentes/assets/img/tarta_manzana.jpg'),
(30, 'Pan pizza', '2.00', 'alicante', 'salado', 40, '', './fuentes/assets/img/pan_pizza.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(10) NOT NULL,
  `nombre_usuario` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `mail` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `clave` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `direccion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` int(9) NOT NULL,
  `rol` varchar(6) COLLATE utf8_spanish2_ci NOT NULL,
  `imagen_usuario` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `nombre`, `mail`, `clave`, `direccion`, `telefono`, `rol`, `imagen_usuario`, `apellidos`) VALUES
(1, 'RubenTM2', 'Rubén', 'rubentm2@outlook.es', 'ruben123.', 'c/ Las palomas nº20', 123123987, 'admin', './fuentes/assets/img/horno.jpg', 'Tomás Martínez'),
(2, 'Manuel345', 'Manuel', 'manuel123@hotmail.co', 'manuel123.', 'C/ Los Limoneros Nº11 1ºB', 987654321, 'normal', '[value-9]', 'García Torres'),
(4, 'AndreaPS', 'Andrea', 'andreaperezsantos@gmail.com', '1234APS_', 'mi calle', 321321321, 'normal', './fuentes/assets/img/defect_img.png', 'Pérez Santos'),
(5, 'Gael', 'Gael', 'gaelgg@gmail.com', '4321Gael!', 'casa', 123321321, 'normal', './fuentes/assets/img/defect_img.png', 'García García');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
