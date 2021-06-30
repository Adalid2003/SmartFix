<?php
include("../../app/helpers/private_header_template.php");
?>
<title>Reportes</title>
<h5 class="blue-grey-text center-align">Reportes</h5>
<!--Se crean las cartas-->
<div class="row">
    <div class="col s12 m6">
        <div class="card blue-grey darken-4">
            <div class="card-content white-text">
                <span class="card-title">Reporte de total ganado al mes</span>
                <p>Reporte que muestra las diferentes ventas que hubieron en el mes</p>
            </div>
            <div class="card-action">
                <a href="#" class="white-text">GENERAR</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s12 m6">
            <div class="card blue-grey darken-4">
                <div class="card-content white-text">
                    <span class="card-title">Reporte de citas por fecha</span>
                    <p>Reporte que muestra las citas que se han realizado por fecha.</p>
                </div>
                <div class="card-action">
                    <a href="#" class="white-text">GENERAR</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col s12 m6">
                <div class="card blue-grey darken-4">
                    <div class="card-content white-text">
                        <span class="card-title">Reporte de salarios</span>
                        <p>Reporte que muestra la cantidad que hay que pagar en salarios.</p>
                    </div>
                    <div class="card-action">
                        <a href="#" class="white-text">GENERAR</a>
                    </div>
                </div>
            </div>
<?php
include("../../app/helpers/footer_template.php");
?>