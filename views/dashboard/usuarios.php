<?php
// Se incluye la clase con las plantillas del documento.
require_once('../../app/helpers/private_header_template.php');
// Se imprime la plantilla del encabezado enviando el título de la página web.
Dashboard_Page::headerTemplate('Mantenimiento Usuarios');
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
                                <label for="search">Buscar usuario...</label>
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
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Correo</th>
                    <th>Tipo de usuario</th>
                    <th>Alias</th>
                    <th>Telefono</th>
                    <th>DUI</th>
                    <th>Estado</th>
                    <th>Sueldo</th>
                    <th>Especialidad</th>
                    <th>Fecha de nacimiento</th>
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
                                <input id="nombres_usuario" type="text" name="nombres_usuario" class="validate" required />
                                <label for="nombres_usuario">Nombres</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">person</i>
                                <input id="apellidos_usuario" type="text" name="apellidos_usuario" class="validate" required />
                                <label for="apellidos_usuario">Apellidos</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">email</i>
                                <input id="correo_usuario" type="email" name="correo_usuario" class="validate" required />
                                <label for="correo_usuario">Correo</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">person_pin</i>
                                <input id="alias_usuario" type="text" name="alias_usuario" class="validate" required />
                                <label for="alias_usuario">Alias</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">security</i>
                                <input id="clave_usuario" type="password" name="clave_usuario" class="validate" required />
                                <label for="clave_usuario">Clave</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">security</i>
                                <input id="confirmar_clave" type="password" name="confirmar_clave" class="validate" required />
                                <label for="confirmar_clave">Confirmar clave</label>
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
    Dashboard_Page::footerTemplate('usuarios.js');
    ?>