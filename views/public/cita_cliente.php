<?php
// Se incluye la clase con las plantillas del documento.
require_once('../../app/helpers/header_template.php');
// Se imprime la plantilla del encabezado enviando el título de la página web.
Public_Page::headerTemplate('Citas');
?>
<h1 class="center blue-grey-text">Tus Citas</h1>
<table class="responsive-table highlight">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Estado de la cita</th>
                    <th>Razón de la cita</th>
                </tr>
            </thead>

            <tbody id="tbody-rows">
            </tbody>
        </table>
        <tbody>
    <?php
    // Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
    Public_Page::footerTemplate('cita_cliente.js');
    ?>