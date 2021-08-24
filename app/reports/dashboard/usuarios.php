<?php
require('../../helpers/report.php');
require('../../models/usuarios.php');


// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Listado de usuarios por especialidad');

// Se instancia el módelo Categorías para obtener los datos.
$usuarios = new Usuarios;
// Se verifica si existen registros (categorías) para mostrar, de lo contrario se imprime un mensaje.
if ($dataEspecialidad = $usuarios->readAllEsp()) {
    foreach ($dataEspecialidad as $rowEspecialidad) {

            // Se establece un color de relleno para los encabezados.
            $pdf->SetFillColor(225);
            // Se establece la fuente para los encabezados.
            $pdf->SetFont('Times', 'B', 11);
            // Se imprime una celda con el nombre de la categoría.
            $pdf->Cell(0, 10, utf8_decode('Especialidad: ' . $rowEspecialidad['especialidad']), 1, 1, 'C', 1);
            // Se imprimen las celdas con los encabezados.
            $pdf->Cell(62, 10, utf8_decode('Nombres'), 1, 0,'C', 1);
            $pdf->Cell(62, 10, utf8_decode('Apellidos'), 1, 0, 'C', 1 );
            $pdf->Cell(62, 10, utf8_decode('Alias'), 1, 1, 'C', 1);
            $pdf->SetFillColor(255, 255, 0);

             // Se verifica si existen registros (productos) para mostrar, de lo contrario se imprime un mensaje.
        if ($dataUsuarios = $usuarios->readUsuariosRpt($rowEspecialidad['id_especialidad'])) {
            // Se establece la fuente para los datos de los productos.
            $pdf->SetFont('Times', '', 11);
            // Se recorren los registros ($dataProductos) fila por fila ($rowProducto).
            foreach ($dataUsuarios as $rowUsuarios) {
                // Se imprimen las celdas con los datos de los productos.
                
                $pdf->Cell(62, 10, utf8_decode($rowUsuarios['nombres_u']), 1, 0);
                $pdf->Cell(62, 10, utf8_decode($rowUsuarios['apellidos']), 1, 0);
                $pdf->Cell(62, 10, utf8_decode($rowUsuarios['alias_u']), 1, 1);
            }
        } else {
            $pdf->Cell(0, 10, utf8_decode('No hay usuarios para esta especialidad'), 1, 1);
        }
    }
} else {
    $pdf->Cell(0, 10, utf8_decode('No hay datos para este reporte'), 1, 1);
}

// Se envía el documento al navegador y se llama al método Footer()
$pdf->Output();
