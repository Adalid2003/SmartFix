<?php
// Se incluye la clase con las plantillas del documento.
require_once('../../app/helpers/header_template.php');
// Se imprime la plantilla del encabezado enviando el título de la página web.
Public_Page::headerTemplate('Actividad de inicio de sesión');
?>
<h1 class="center blue-grey-text">Historial de inicio de sesión</h1>
<!-- Se hace la tabla responsiva -->
<table class="responsive-table highlight">
  <thead>
    <tr>
      <th>Dispositivo</th>
      <th>Fecha</th>
      <th>Hora</th>
    </tr>
  </thead>
  <tbody id="tbody-rows">
  </tbody>
</table>
    <?php
    // Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
    Public_Page::footerTemplate('historial.js');
    ?>