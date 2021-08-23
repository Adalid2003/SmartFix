<?php
require('../../helpers/report.php');
require('../../models/automoviles.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Listado de automoviles por marca');

// Se instancia el módelo Categorías para obtener los datos.
$automoviles = new Automoviles;
// Se verifica si existen registros (categorías) para mostrar, de lo contrario se imprime un mensaje.
if ($dataAutomoviles = $automoviles->readAll()) {
    foreach ($dataAutomoviles as $rowAutomoviles) {

        // Se establece un color de relleno para los encabezados.
        $pdf->SetFillColor(225);
        // Se establece la fuente para los encabezados.
        $pdf->SetFont('Times', 'B', 11);
        // Se imprime una celda con el nombre de la categoría.
        $pdf->Cell(0, 10, utf8_decode('Marca: ' . $rowAutomoviles['marca']), 1, 1, 'C', 1);
        if ($automoviles->setId($rowAutomoviles['id_automovil'])) {
            // Se verifica si existen registros (productos) para mostrar, de lo contrario se imprime un mensaje.
            if ($dataAutomoviles = $automoviles->readAutomovilRpt()) {
                // Se imprimen las celdas con los encabezados.
                $pdf->Cell(60, 10, utf8_decode('Modelo del automovil'), 1, 0, 'C', 1);
                $pdf->Cell(30, 10, utf8_decode('Color'), 1, 0, 'C', 1);
                $pdf->Cell(50, 10, utf8_decode('Numero de placa'), 1, 0, 'C', 1);
                $pdf->Cell(46, 10, utf8_decode('Dueño del automovil'), 1, 1, 'C', 1);
                // Se establece la fuente para los datos de los productos.
                $pdf->SetFont('Times', '', 11);
                // Se recorren los registros ($dataProductos) fila por fila ($rowProducto).
                foreach ($dataAutomoviles as $rowAutomoviles) {
                    // Se imprimen las celdas con los datos de los productos.
                    $pdf->Cell(60, 10, utf8_decode($rowAutomoviles['modelo']), 1, 0);
                    $pdf->Cell(30, 10, utf8_decode($rowAutomoviles['color']), 1, 0);
                    $pdf->Cell(50, 10, utf8_decode($rowAutomoviles['placa']), 1, 0);
                    $pdf->Cell(46, 10, utf8_decode($rowAutomoviles['nombres_c']), 1, 1);
                }
            } else {
                $pdf->Cell(0, 10, utf8_decode('No hay compras realizadas en esta fecha'), 1, 1);
            }
        }
    }
} else {
    $pdf->Cell(0, 10, utf8_decode('No hay compras para mostrar'), 1, 1);
}

// Se envía el documento al navegador y se llama al método Footer()
$pdf->Output();
