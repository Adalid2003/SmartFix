<?php
//Se verifica el id
if (isset($_GET['id'])) {
    //requerimos los documentos necesarios
    require('../../helpers/report.php');
    require('../../models/usuarios.php');
    // Se instancia el módelo Reseñas para procesar los datos.
    $usuarios = new Usuarios();
    //Verificar si el id es correcto
    if ($usuarios->setId($_GET['id'])) {
        //Recuperando informacion del cliente
        if ($dataUsuario = $usuarios->readDetalleUserRpt()) {
            // Se instancia la plantilla
            $pdf = new Report();
            // Se inicia el reporte con el encabezado del documento.
            $pdf->startReport('Datos del usuario '.$dataUsuario['nombres_u'].' '.$dataUsuario['apellidos']);
            //Capturando datos
            if ($dataInfo = $usuarios->userInfo()) {
                 //Se establece el color del texto
                $pdf->SetTextColor(0);
                // Se establece un color de relleno para mostrar el nombre de la Puntuación.
                $pdf->SetFillColor(225, 225, 225);
                // Se establece la fuente para el nombre de la Puntuación.
                $pdf->SetFont('Arial', 'B', 12);
                // Se imprimen las celdas con los encabezados.
                $pdf->Cell(18, 10, utf8_decode('Nombres'), 1, 0, 'C', 1);
                $pdf->Cell(18, 10, utf8_decode('Apellidos'), 1, 1, 'C', 1);
                $pdf->SetFont('Arial', '', 12);
                //Recorremos los datos
                foreach ($dataInfo as $rowInfo) {
                    //Se imprimen las celdas
                    $pdf->Cell(100, 10, utf8_decode($rowInfo['nombes_u']), 1, 0, 'C');
                    $pdf->Cell(0, 10, utf8_decode($rowInfo['apellidos']), 1, 1, 'C');
                }
            } else {
                $pdf->Cell(0, 10, utf8_decode('Este cliente no ha realizado ninguna cita.'), 1, 1);
            }
            // Se envía el documento al navegador y se llama al método Footer()
            //$pdf->Output();
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