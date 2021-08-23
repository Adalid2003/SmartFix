<?php
// Se incluye la clase con las plantillas del documento.
require_once('../../app/helpers/header_template.php');
// Se imprime la plantilla del encabezado enviando el título de la página web.
Public_Page::headerTemplate('Citas');
?>
<h1 class="center blue-grey-text">Agenda tu cita ahora mismo</h1>
<div class="row">
    <!--Seleccionar fecha de cita-->
    <div class="col s12 14 offset-14">
        <form method="post" id="save-form" enctype="multipart/form-data">
            <div class="row">
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">date_range</i>
                    <input type="date" id="fecha" name="fecha" class="validate" required />
                    <label for="fecha">Seleccione la fecha de su cita</label>
                </div>
                <div class="input-field col s6">
                    <select id="hora" name="hora" class="validate">
                    </select>
                    <label>Seleccione la hora de su cita</label>
                </div>
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">report</i>
                    <input type="text" id="razon" name="razon" maxlength="100" class="validate" required />
                    <label for="razon">Razón de la cita</label>
                </div>
            </div>
            <!--Boton agendar-->
            <div class="row center-align">
                <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="cita"><i class="material-icons">today</i></button>
            </div>
    </div>
    <?php
    // Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
    Public_Page::footerTemplate('cita.js');
    ?>