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
                        <input class="hide" type="number" id="id_usuario" name="id_usuario" />
                        <div class="row">
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">person</i>
                                <input id="nombres" type="text" name="nombres" class="validate" required />
                                <label for="nombres">Nombres</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">person</i>
                                <input id="apellidos" type="text" name="apellidos" class="validate" required />
                                <label for="apellidos">Apellidos</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">email</i>
                                <input id="correo" type="email" name="correo" class="validate" required />
                                <label for="correo">Correo</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">person_pin</i>
                                <input id="alias" type="text" name="alias" class="validate" required />
                                <label for="alias">Alias</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">security</i>
                                <input id="clave1" type="password" name="clave1" class="validate" required />
                                <label for="clave1">Clave</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">security</i>
                                <input id="clave2" type="password" name="clave2" class="validate" required />
                                <label for="clave2">Confirmar clave</label>
                            </div>
                            <div class="input-field col s6">
                                <select id="tipo_usuario" name="tipo_usuario">
                                </select>
                                <label>Tipo de usuario</label>
                            </div>
                            <div class="input-field col s6">
                                <select id="especialidad" name="especialidad">
                                </select>
                                <label>Especialidad</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">phone</i>
                                <input id="telefono" type="text" name="telefono" class="validate" required />
                                <label for="telefono">Telefono</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">perm_identity</i>
                                <input id="dui_u" type="text" name="dui_u" placeholder="00000000-0" pattern="[0-9]{8}[-][0-9]{1}" class="validate" required />
                                <label for="dui_u">DUI</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">attach_money</i>
                                <input id="sueldo" type="text" name="sueldo" class="validate" required />
                                <label for="sueldo">Sueldo</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">cake</i>
                                <input id="fecha_nacimiento" type="date" name="fecha_nacimiento" class="validate" required />
                                <label for="fecha_nacimiento">Fecha de nacimiento</label>
                            </div>
                            <div class="col s12 m6">
                                <p>
                                <div class="switch">
                                    <span>Estado:</span>
                                    <label>
                                        <i class="material-icons">lock_outline</i>
                                        <input id="estado_usuario" type="checkbox" name="estado_usuario" checked />
                                        <span class="lever"></span>
                                        <i class="material-icons">lock_open</i>
                                    </label>
                                </div>
                                </p>
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