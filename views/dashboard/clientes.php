<?php
// Se incluye la clase con las plantillas del documento.
require_once('../../app/helpers/private_header_template.php');
// Se imprime la plantilla del encabezado enviando el título de la página web.
Dashboard_Page::headerTemplate('Mantenimiento Clientes');
?>
<!--Pagina clientes-->
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
                                <label for="search">Buscar cliente...</label>
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
            <a href="../../app/reports/dashboard/clientes.php" target="_blank" class="btn waves-effect cyan darken-1 tooltipped" data-tooltip="Reporte de clientes"><i class="material-icons">assignment</i></a>

        </div>
        <!--Encabezado tablas-->
        <table class="responsive-table highlight">
            <thead>
                <tr>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>DUI</th>
                    <th>Correo electronico</th>
                    <th>Alias</th>
                    <th>Telefono</th>
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
                        <input class="hide" type="number" id="id_cliente" name="id_cliente" />
                        <div class="row">
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">account_box</i>
                                <input type="text" id="nombres_cliente" name="nombres_cliente" pattern="[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]{1,50}" class="validate" required />
                                <label for="nombres_cliente">Nombres</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">account_box</i>
                                <input type="text" id="apellidos_cliente" name="apellidos_cliente" pattern="[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]{1,50}" class="validate" required />
                                <label for="apellidos_cliente">Apellidos</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">how_to_reg</i>
                                <input type="text" id="dui_cliente" name="dui_cliente" placeholder="00000000-0" pattern="[0-9]{8}[-][0-9]{1}" class="validate" required />
                                <label for="dui_cliente">DUI</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">email</i>
                                <input type="email" id="correo_cliente" name="correo_cliente" maxlength="100" class="validate" required />
                                <label for="correo_cliente">Correo electrónico</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">face</i>
                                <input type="text" id="alias" name="alias" maxlength="200" class="validate" required />
                                <label for="alias">Alias</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">perm_identity</i>
                                <select id="cb_genero" name="cb_genero">
                                    <option value="" disabled selected>Seleccionar...</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
                                <label>Género</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">security</i>
                                <input type="password" id="clave_cliente" name="clave_cliente" class="validate" required />
                                <label for="clave_cliente">Clave</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">security</i>
                                <input type="password" id="confirmar_clave" name="confirmar_clave" class="validate" required />
                                <label for="confirmar_clave">Confirmar clave</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">phone</i>
                                <input type="text" id="telefono_cliente" name="telefono_cliente" placeholder="0000-0000" pattern="[2,6,7]{1}[0-9]{3}[-][0-9]{4}" class="validate" required />
                                <label for="telefono_cliente">Teléfono</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">cake</i>
                                <input type="date" id="nacimiento_cliente" name="nacimiento_cliente" class="validate" required />
                                <label for="nacimiento_cliente">Nacimiento</label>
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

    <div id="grafica-modal" class="modal">
        <div class="modal-content">
            <!-- Título para la caja de dialogo -->
            <h4 id="modal-title" class="center-align">Gráfica de cliente</h4>
            <div class="row">
                <div class="col s12" id="contenedor">
                </div>
            </div>
        </div>
    </div>

    <!-- Importación del archivo para generar gráficas en tiempo real. Para más información https://www.chartjs.org/ -->
    <script type="text/javascript" src="../../resource/js/chart.js"></script>

    <?php
    // Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
    Dashboard_Page::footerTemplate('clientes.js');
    ?>