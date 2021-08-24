<?php
// Se verifica si existe el parámetro id en la url, de lo contrario se direcciona a la página web de origen.
if (isset($_GET['id'])) {
    require('../../helpers/report.php');
    require('../../models/reparaciones.php');

    // Se instancia el módelo Clientes para procesar los datos.
    $reparacion = new Reparacion;

    // Se verifica si el parámetro es un valor correcto, de lo contrario se direcciona a la página web de origen.
    if ($reparacion->setId($_GET['id'])) {
        // Se verifica si la categoría del parametro existe, de lo contrario se direcciona a la página web de origen.
        if ($rowReparacion = $reparacion->readOne()) {
            // Se instancia la clase para crear el reporte.
            $pdf = new Report;
            // Se inicia el reporte con el encabezado del documento.

            $pdf->startReport('Factura');

            // Se establece un color de relleno para los encabezados.
            $pdf->SetFillColor(225);
            // Se establece la fuente para los encabezados.
            $pdf->SetFont('Times', 'B', 11);

            $pdf->Cell(46, 10, utf8_decode('Codigo de factura'), 0, 0, 'L', 0);
            $pdf->Cell(46, 10, utf8_decode($rowReparacion['id_detalle_rep']), 0, 1, 'L', 0);
            $pdf->Ln();
            // Se verifica si existen registros (productos) para mostrar, de lo contrario se imprime un mensaje.
            if ($dataReparacion = $reparacion->factura()) {
                $pdf->Cell(40, 10, utf8_decode('Placa del automovil'), 1, 0, 'C', 1);
                $pdf->Cell(40, 10, utf8_decode('Repuesto'), 1, 0, 'C', 1);
                $pdf->Cell(35, 10, utf8_decode('Precio del respuesto'), 1, 0, 'C', 1);
                $pdf->Cell(36, 10, utf8_decode('Mano de obra'), 1, 1, 'C', 1);
                // Se establece la fuente para los datos de los productos.
                $pdf->SetFont('Times', '', 11);
                // Se recorren los registros ($dataCita) fila por fila ($rowCita).
                foreach ($dataReparacion as $rowReparacion) {
                    // Se imprimen las celdas con los datos de la cita.
                    $pdf->Cell(40, 10, utf8_decode($rowReparacion['placa']), 1, 0);
                    $pdf->Cell(40, 10, utf8_decode($rowReparacion['repuesto']), 1, 0);
                    $pdf->Cell(35, 10,  utf8_decode($rowReparacion['precio_repuesto']), 1, 0);
                    $pdf->Cell(36, 10,  utf8_decode($rowReparacion['mano_obra']), 1, 1);
                }
                $pdf->Ln();
                $pdf->Cell(46, 10, utf8_decode('Total a pagar:     $'), 0, 0, 'L', 0);
                $pdf->Cell(46, 10, utf8_decode($rowReparacion['suma']), 0, 1, 'L', 0);
                $pdf->Output();
            } else {
                $pdf->Cell(0, 10, utf8_decode('No hay reparaciones a pagar para este cliente'), 1, 1);
            }
            // Se envía el documento al navegador y se llama al método Footer()
        } else {
            header('location: ../../../views/dashboard/reparaciones.php');
        }
    } else {
        header('location: ../../../views/dashboard/reparaciones.php');
    }
} else {
    header('location: ../../../views/dashboard/reparaciones.php');
}
