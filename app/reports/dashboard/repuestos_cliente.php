<?php
//Se verifica el id
if (isset($_GET['id'])) {
    //requerimos los documentos necesarios
    require('../../helpers/report.php');
    require('../../models/clientes.php');
    // Se instancia el módelo Reseñas para procesar los datos.
    $cliente = new Clientes();
    //Verificar si el id es correcto
    if ($cliente->setId($_GET['id'])) {
        //Recuperando informacion del cliente
        if ($dataCliente = $cliente->readOne()) {
            // Se instancia la plantilla
            $pdf = new Report();
            // Se inicia el reporte con el encabezado del documento.
            $pdf->startReport('Repuestos de citas de '.$dataCliente['nombres_c'].' '.$dataCliente['apellidos_c']);
            //Capturando datos
            if ($dataRepuestos = $cliente->clientsReplacements()) {
                 //Se establece el color del texto
                $pdf->SetTextColor(0);
                // Se establece un color de relleno para mostrar el nombre de la Puntuación.
                $pdf->SetFillColor(225, 225, 225);
                // Se establece la fuente para el nombre de la Puntuación.
                $pdf->SetFont('Arial', 'B', 12);
                // Se imprimen las celdas con los encabezados.
                $pdf->Cell(100, 10, utf8_decode('Repuesto'), 1, 0, 'C', 1);
                $pdf->Cell(0, 10, utf8_decode('Empleado'), 1, 1, 'C', 1);
                $pdf->SetFont('Arial', '', 12);
                //Recorremos los datos
                foreach ($dataRepuestos as $rowRepuestos) {
                    //Se imprimen las celdas
                    $pdf->Cell(100, 10, utf8_decode($rowRepuestos['repuesto']), 1, 0, 'C');
                    $pdf->Cell(0, 10, utf8_decode($rowRepuestos['empleado']), 1, 1, 'C');
                }
            } else {
                $pdf->Cell(0, 10, utf8_decode('Este cliente no ha realizado ninguna cita.'), 1, 1);
            }
            // Se envía el documento al navegador y se llama al método Footer()
            $pdf->Output();
        } else {
            //header('location: ../../../views/dashboard/clientes.php');
        }        
    } else {
        //header('location: ../../../views/dashboard/clientes.php');
    }    
} else {
    //header('location: ../../../views/dashboard/clientes.php');
}

?>