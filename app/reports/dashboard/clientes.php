<?php
require('../../helpers/report.php');
require('../../models/clientes.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Listado de clientes por género');

// Se instancia el módelo Clientes para obtener los datos.
$cliente = new Clientes;
// Se verifica si existen registros (categorías) para mostrar, de lo contrario se imprime un mensaje.
if ($dataClientes = $cliente->readAll()) {
    //Se establece el color del texto
    $pdf->SetTextColor(255);
    // Se establece un color de relleno para mostrar el nombre de la Puntuación.
    $pdf->SetFillColor(38, 50, 56);
    // Se establece la fuente para el nombre de la Puntuación.
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, utf8_decode('Masculino'), 1, 1, 'C', 1);
    //Se asigna el valor al modelo
    $cliente->setGenero('M');
    //Se obtienen los datos
    if ($dataClienteMasculino = $cliente->clientsByGender()) {
        //Se establece el color del texto
        $pdf->SetTextColor(0);
        // Se establece un color de relleno para mostrar el nombre de la Puntuación.
        $pdf->SetFillColor(225, 225, 225);
        // Se establece la fuente para el nombre de la Puntuación.
        $pdf->SetFont('Arial', 'B', 12);
        // Se imprimen las celdas con los encabezados.
        $pdf->Cell(70, 10, utf8_decode('Cliente'), 1, 0, 'C', 1);
        $pdf->Cell(30, 10, utf8_decode('Dui'), 1, 0, 'C', 1);
        $pdf->Cell(45, 10, utf8_decode('Alias'), 1, 0, 'C', 1);
        $pdf->Cell(41, 10, utf8_decode('Telefono'), 1, 1, 'C', 1);
        // Se recorren los registros ($dataComments) fila por fila ($rowComment).
        // Se establece la fuente para el nombre de la Puntuación.
        $pdf->SetFont('Arial', '', 12);
        foreach ($dataClienteMasculino as $rowMasculino) {
            //Se imprimen las celdas
            $pdf->Cell(70, 10, utf8_decode($rowMasculino['cliente']), 1, 0, 'C');
            $pdf->Cell(30, 10, utf8_decode($rowMasculino['dui_c']), 1, 0, 'C');
            $pdf->Cell(45, 10, utf8_decode($rowMasculino['alias_c']), 1, 0, 'C');
            $pdf->Cell(41, 10, utf8_decode($rowMasculino['telefono_c']), 1, 1, 'C');
        }
    } else {
        $pdf->Cell(0, 10, utf8_decode('No hay clientes para mostrar'), 1, 1);
    }

    //Se establece el color del texto
    $pdf->SetTextColor(255);
    // Se establece un color de relleno para mostrar el nombre de la Puntuación.
    $pdf->SetFillColor(38, 50, 56);
    // Se establece la fuente para el nombre de la Puntuación.
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, utf8_decode('Femenino'), 1, 1, 'C', 1);
    //Se asigna el valor al modelo
    $cliente->setGenero('F');
    //Se obtienen los datos
    if ($dataClienteFemenino = $cliente->clientsByGender()) {
        //Se establece el color del texto
        $pdf->SetTextColor(0);
        // Se establece un color de relleno para mostrar el nombre de la Puntuación.
        $pdf->SetFillColor(225, 225, 225);
        // Se establece la fuente para el nombre de la Puntuación.
        $pdf->SetFont('Arial', 'B', 12);
        // Se imprimen las celdas con los encabezados.
        $pdf->Cell(70, 10, utf8_decode('Cliente'), 1, 0, 'C', 1);
        $pdf->Cell(30, 10, utf8_decode('Dui'), 1, 0, 'C', 1);
        $pdf->Cell(45, 10, utf8_decode('Alias'), 1, 0, 'C', 1);
        $pdf->Cell(41, 10, utf8_decode('Telefono'), 1, 1, 'C', 1);
        // Se establece la fuente para el nombre de la Puntuación.
        $pdf->SetFont('Arial', '', 12);
        // Se recorren los registros ($dataComments) fila por fila ($rowComment).
        foreach ($dataClienteFemenino as $rowFemenino) {
            //Se imprimen las celdas
            $pdf->Cell(70, 10, utf8_decode($rowFemenino['cliente']), 1, 0, 'C');
            $pdf->Cell(30, 10, utf8_decode($rowFemenino['dui_c']), 1, 0, 'C');
            $pdf->Cell(45, 10, utf8_decode($rowFemenino['alias_c']), 1, 0, 'C');
            $pdf->Cell(41, 10, utf8_decode($rowFemenino['telefono_c']), 1, 1, 'C');
        }
    } else {
        $pdf->Cell(0, 10, utf8_decode('No hay clientes para mostrar'), 1, 1);
    }
    

} else {
    $pdf->Cell(0, 10, utf8_decode('No hay clientes para mostrar'), 1, 1);
}

// Se envía el documento al navegador y se llama al método Footer()
$pdf->Output();
