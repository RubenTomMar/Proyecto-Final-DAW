<?php
/**
 * En este archivo se genera un pdf con los datos
 * que el usuario a buscado en listado_pdf.php
 * y asi poder descargarlos
 */

//iniciamos sesion
session_start();

//incluimos los ficheros funcienes y carrito
include('assets/funciones.php');
include('./assets/fpdf/fpdf.php');

//compruebo si el usuario tiene permisos
if (!permisos()) {
    header("Location:../index.php");
}

//variables con los datos de las variables de sesion recogidos de listado_pdf.php
$orden = $_SESSION['orden'];
$categoria = $_SESSION['categoria'];
$procedencia = $_SESSION['procedencia'];

//compruebo que esten definidas las variables
if (isset($orden) && isset($categoria) && isset($procedencia)) {

    //consulta recogida de los datos segun lo que buscara el usuario
    $consultaOrden = conexion()->query("SELECT * FROM productos WHERE categoria = '$categoria' AND procedencia = '$procedencia' ORDER BY '$orden'");

    //si hay mínimo una consulta genero el pdf
    if (mysqli_num_rows($consultaOrden) >= 1) {

        //Creo la cabecera y el pie de pagina de los pdf
        class PDF extends FPDF
        {
            // Cabecera de la página
            function Header()
            {
                // Fuente de la cabecera
                $this->SetFont('Arial', 'B', 20);
                // Color de la celda y texto
                $this->SetFillColor(30, 30, 30);
                $this->SetTextColor(255, 255, 255);
                // Título
                $this->Cell(5);
                $this->Cell(180, 20, strtoupper($_SESSION['categoria']), 1, 0, 'C', 1);
                // Logo
                $this->Image('assets/img/logo.png', 16, 11, 18, 18);
                // Salto de línea
                $this->Ln(25);
            }

            // Pie de página
            function Footer()
            {
                // Posición: a 1,5 cm del final
                $this->SetY(-15);
                // Fuente del pie
                $this->SetFont('Arial', 'I', 8);
                // Número de página
                $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
            }
        }

        // Creación del objeto de la clase heredada
        $pdf = new PDF();

        ob_start(); //para prevenir un posible error al mostrar el pdf
        $pdf->AddPage(); //se crea la pagina
        $pdf->AliasNbPages(); //se cuanta el numero de cartas

        // Fuente de los titulos de cada columna
        $pdf->SetFont('Arial', 'B', 15);
        // Color de las celdas y texto
        $pdf->SetFillColor(30, 30, 30);
        $pdf->SetTextColor(255, 255, 255);
        // Celdas titulo
        $pdf->Cell(5);
        $pdf->Cell(15, 10, 'ID', 1, 0, 'C', 1);
        $pdf->Cell(55, 10, 'NOMBRE', 1, 0, 'C', 1);
        $pdf->Cell(30, 10, 'PRECIO ', 1, 0, 'C', 1);
        $pdf->Cell(30, 10, 'CANTIDAD', 1, 0, 'C', 1);
        $pdf->Cell(50, 10, 'PROCEDENCIA', 1, 0, 'C', 1);
        // Salto de línea
        $pdf->Ln();

        // Recojo los datos de la consulta para mostrarlos
        while ($productos = $consultaOrden->fetch_assoc()) {

            // Fuente de las celdas 
            $pdf->SetFont('Arial', '', 15);
            $pdf->SetFillColor(30, 30, 30);
            $pdf->SetTextColor(0, 0, 0);

            // Celdas con los datos 
            $pdf->Cell(5);
            $pdf->Cell(15, 10, $productos['id_producto'], 1, 0, 'C');
            $pdf->Cell(55, 10, utf8_decode($productos['nombre_producto']), 1, 0, 'C');
            $pdf->Cell(30, 10, $productos['precio'], 1, 0, 'C');
            $pdf->Cell(30, 10, $productos['cantidad'], 1, 0, 'C');
            $pdf->Cell(50, 10, utf8_decode($productos['procedencia']), 1, 0, 'C');
            // Salto de línea
            $pdf->Ln();
        }

        $pdf->Output(); // Salida del pdf
        ob_end_flush(); //para prevenir un posible error al mostrar el pdf

    } else {

        // Al no haber ningún producto a mostrar devuleve a listado_pdf.php
        header('Location:listado_pdf.php');
    }

    // Desconecto de la bbdd
    desconexion(conexion());
} else {

    // En caso de que las variables esten vacias devuleve a listado_pdf.php
    header('Location:listado_pdf.php');
}
?>