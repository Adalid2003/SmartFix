<?php
include("../../app/helpers/header_template.php");
?>
<h1 class="center blue-grey-text">Agenda tu cita ahora mismo</h1>
<div class="row">
        <!--Seleccionar fecha de cita-->
        <div class="col s12 14 offset-14">
            <div class="card">
            <div class="card-action white white-text">
                    <div class="card-content"></div>
                    <div class="form-field">
                        <label for="fecha">Seleccione el dia que quiere agendar su cita</label>
                        <input type="date" id="date">
                    </div><br>
                    <!--Boton agendar-->
                    <div class="form-field center-align">
                        <button class="btn-large blue-grey darken-4">Agendar</button>
                    </div><br>
                    <!--Imprimir comprobante-->
                    <div class="form-field center-align">
                        <button class="btn-large blue-grey darken-4">Imprimir comprobante de cita</button>
                    </div><br>
            </div>
            </div>
<?php
include("../../app/helpers/footer_template.php");
?>