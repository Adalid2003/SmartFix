<?php
// Se incluye la clase con las plantillas del documento.
require_once('../../app/helpers/private_header_template.php');
// Se imprime la plantilla del encabezado enviando el título de la página web.
Dashboard_Page::headerTemplate('Mantenimiento Reparaciones');
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
                                <label for="search">Buscar reparación...</label>
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
        </div>
        <!--Encabezado tablas-->
        <table class="responsive-table highlight">
            <thead>
                <tr>
                    <th>Cita</th>
                    <th>Estado reparación</th>
                    <th>Usuario</th>
                    <th>Repuesto</th>
                    <th>Precio del repuesto</th>
                    <th>Mano de obra</th>
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
                        <input class="hide" type="number" id="id_reparacion" name="id_reparacion" />
                        <div class="row">
                            <div class="input-field col s6">
                                <select id="cita" name="cita" class="validate">
                                </select>
                                <label>Seleccione la cita programada</label>
                            </div>
                            <div class="input-field col s6">
                                <select id="estado" name="estado" class="validate">
                                </select>
                                <label>Seleccione el estado de la reparación</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">attach_money</i>
                                <input id="repuesto" type="text" name="repuesto" class="validate" required />
                                <label for="repuesto">Repuesto</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">attach_money</i>
                                <input id="precio_repuesto" type="text" name="precio_repuesto" class="validate" required />
                                <label for="precio_repuesto">Precio del repuesto</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">attach_money</i>
                                <input id="obra" type="text" name="obra" class="validate" required />
                                <label for="obra">Mano de obra</label>
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
    Dashboard_Page::footerTemplate('reparaciones.js');
    ?>