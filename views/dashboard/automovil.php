<?php
// Se incluye la clase con las plantillas del documento.
require_once('../../app/helpers/private_header_template.php');
// Se imprime la plantilla del encabezado enviando el título de la página web.
Dashboard_Page::headerTemplate('Mantenimiento Automoviles');
?>
<div class="row">
    <div class="col s12 14 offset-14">
        <div class="container">
            <div class="container center">

                <div class="row center-align">
                    <form method="post" id="search-form">
                        <div class="col s12">
                            <div class="input-field col s4 m6 valing-wrapper">
                                <i class="material-icons prefix ">search</i>
                                <input type="text" id="search" name="search" required />
                                <label for="search">Buscar automovil...</label>
                            </div>
                            <div class="input-field col s6 m4 right-align">
                                <button type="submit" class="btn waves-effect  light-blue darken-4 waves-light btn-medium" data-tooltip="Buscar"><i class="material-icons"></i>Buscar</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="input-field col s6 m4">
            <a href="#" onclick="openCreateDialog()" class="btn waves-effect cyan darken-1 tooltipped" data-tooltip="Crear"><i class="material-icons">add</i></a>
            <a href="../../app/reports/dashboard/automoviles.php" target="_blank" class="btn waves-effect amber tooltipped" data-tooltip="Reporte de automoviles por marca"><i class="material-icons">assignment</i></a>
        </div>
        <table class="responsive-table highlight">
            <thead>
                <tr>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Color</th>
                    <th>Numero motor</th>
                    <th>Clase</th>
                    <th>Detalle</th>
                    <th>Placa</th>
                    <th>Cliente</th>
                    <th class="actions-column">Acción</th>
                </tr>
            </thead>

            <tbody id="tbody-rows">
            </tbody>
        </table>
        <tbody>
            <!-- Componente Modal para mostrar una caja de dialogo -->
            <div id="save-modal" class="modal">
                <div class="modal-content">
                    <!-- Título para la caja de dialogo -->
                    <h4 id="modal-title" class="center-align"></h4>
                    <!-- Formulario para crear o actualizar un registro -->
                    <form method="post" id="save-form">
                        <!-- Campo oculto para asignar el id del registro al momento de modificar -->
                        <input class="hide" type="number" id="id_automovil" name="id_automovil" />
                        <div class="row">
                            <div class="input-field col s6">
                                <select onchange="cargarModelos()" id="marca" name="marca">
                                </select>
                                <label>Marca del vehiculo</label>
                            </div>
                            <div class="input-field col s6">
                                <select id="modelo" name="modelo">
                                </select>
                                <label>Modelo del vehiculo</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">color_lens</i>
                                <input id="color" type="text" name="color" class="validate" required />
                                <label for="color">Color del vehiculo</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">filter_1</i>
                                <input id="motor" type="text" name="motor" class="validate" required />
                                <label for="motor">Numero de motor</label>
                            </div>
                            <div class="input-field col s6">
                                <select id="clase" name="clase">
                                </select>
                                <label>Clase del vehiculo</label>
                            </div>
                            <div class="input-field col s6">
                                <select id="detalle" name="detalle">
                                </select>
                                <label>Detalle de reparacion</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">broken_image</i>
                                <input id="placa" type="text" name="placa" class="validate" required />
                                <label for="placa">Numero de placa</label>
                            </div>
                            <div class="input-field col s6">
                                <select id="cliente" name="cliente">
                                </select>
                                <label>Cliente</label>
                            </div>
                        </div>
                        <div class="row center-align">
                            <a href="#" class="btn waves-effect grey tooltipped modal-close" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a>
                            <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar"><i class="material-icons">save</i></button>
                        </div>
                    </form>
                </div>
            </div>

    </div>
    <?php
    // Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
    Dashboard_Page::footerTemplate('automoviles.js');
    ?>