<?php
// Se verifica si existe el parámetro id en la url, de lo contrario se direcciona a la página web de origen.
if (isset($_GET['id'])) {
    require('../../helpers/report.php');
    require('../../models/clientes.php');

    // Se instancia el módelo Clientes para procesar los datos.
    $cliente = new Clientes;

    // Se verifica si el parámetro es un valor correcto, de lo contrario se direcciona a la página web de origen.
    if ($cliente->setId($_GET['id'])) {
        // Se verifica si la categoría del parametro existe, de lo contrario se direcciona a la página web de origen.
        if ($rowCliente = $cliente->readOne()) {
            // Se instancia la clase para crear el reporte.
            $pdf = new Report;
            // Se inicia el reporte con el encabezado del documento.
            $pdf->startReport('Citas del cliente '.$rowCliente['nombres_c']);
            // Se verifica si existen registros (productos) para mostrar, de lo contrario se imprime un mensaje.
            if ($dataCita = $cliente->rptCitasCliente()) {
                // Se establece un color de relleno para los encabezados.
                $pdf->SetFillColor(225);
                // Se establece la fuente para los encabezados.
                $pdf->SetFont('Times', 'B', 11);
                // Se imprimen las celdas con los encabezados.
                $pdf->Cell(46, 10, utf8_decode('Fecha'), 1, 0, 'C', 1);
                $pdf->Cell(46, 10, utf8_decode('Hora'), 1, 0, 'C', 1);
                $pdf->Cell(46, 10, utf8_decode('Razón de la cita'), 1, 0, 'C', 1);
                $pdf->Cell(46, 10, utf8_decode('Estado'), 1, 1, 'C', 1);
                // Se establece la fuente para los datos de los productos.
                $pdf->SetFont('Times', '', 11);
                // Se recorren los registros ($dataCita) fila por fila ($rowCita).
                foreach ($dataCita as $rowCita) {
                    // Se imprimen las celdas con los datos de la cita.
                    $pdf->Cell(46, 10, utf8_decode($rowCita['fecha_cita']), 1, 0);
                    $pdf->Cell(46, 10,  utf8_decode($rowCita['hora']), 1, 0);
                    $pdf->Cell(46, 10,  utf8_decode($rowCita['razon']), 1, 0);
                    $pdf->Cell(46, 10,  utf8_decode($rowCita['estado_cita']), 1, 1);
                }
            } else {
                $pdf->Cell(0, 10, utf8_decode('No hay citas programadas para este cliente'), 1, 1);
            }
            // Se envía el documento al navegador y se llama al método Footer()
            $pdf->Output();
        } else {
            header('location: ../../../views/dashboard/clientes.php');
        }
    } else {
        header('location: ../../../views/dashboard/clientes.php');
    }
} else {
    header('location: ../../../views/dashboard/clientes.php');
}
?>