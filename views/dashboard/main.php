<?php
// Se incluye la clase con las plantillas del documento.
require_once('../../app/helpers/private_header_template.php');
// Se imprime la plantilla del encabezado enviando el título de la página web.
Dashboard_Page::headerTemplate('Bienvenido');
?>

<!-- Se muestra un saludo de acuerdo con la hora del cliente -->
<div class="row">
    <h4 class="center-align blue-text" id="greeting"></h4>
</div>

<!-- Se muestran las gráficas de acuerdo con algunos datos disponibles en la base de datos -->
<div class="row">
    <div class="col s12 m6">
        <!-- Se muestra una gráfica de barra con top 10 de clientes con mas automoviles -->
        <canvas id="chart1"></canvas>
    </div>
    <div class="col s12 m6" style="width: 800px;">
        <canvas id="citasGrafica"></canvas>
    </div>
</div>
<div class="row">
    <div class="col s12 m6" id="graficaparam">
        <p style="text-align: center;">Porcentaje de citas por estado del mes</p>
        <a id="btn_seleccionarmes" href="#seleccionarMes" class="btn modal-trigger waves-effect blue tooltipped" data-tooltip="Seleccionar mes"><i class="material-icons">visibility</i></a>
        <div id="citasPorcentajediv" style="width: 800px;">
            <canvas id="citasPorcentaje"></canvas>
        </div>
    </div>
</div>

<div id="seleccionarMes" class="modal">
    <div class="modal-content">
        <h4>Seleccionar mes</h4>
        <!--Encabezado tablas-->
        <table class="responsive-table highlight">
            <thead>
                <tr>
                    <th>Mes</th>
                    <th>Citas</th>
                    <th class="actions-column">Acción</th>
                </tr>
            </thead>
            <tbody id="tbody-rows">
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
    </div>
</div>

<!-- Importación del archivo para generar gráficas en tiempo real. Para más información https://www.chartjs.org/ -->
<script type="text/javascript" src="../../resource/js/chart.js"></script>

<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Dashboard_Page::footerTemplate('main.js');
?>