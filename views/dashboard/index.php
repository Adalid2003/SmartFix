<?php
// Se incluye la clase con las plantillas del documento.
require_once('../../app/helpers/private_header_template.php');
// Se imprime la plantilla del encabezado enviando el título de la página web.
Dashboard_Page::headerTemplate('Iniciar sesión');
?>

<div class="container">
    <div class="row">
        <!-- Formulario para iniciar sesión -->
        <form method="post" id="session-form">
            <div class="input-field col s12 m6 offset-m3">
                <i class="material-icons prefix">person_pin</i>
                <input id="alias" type="text" name="alias" class="validate" required />
                <label for="alias">Alias</label>
            </div>
            <div class="input-field col s12 m6 offset-m3">
                <i class="material-icons prefix">security</i>
                <input id="clave" type="password" name="clave" class="validate" required />
                <label for="clave">Clave</label>
            </div>
            <div class="col s12 center-align">
                <a href="recuperar.php">He olvidado mi contraseña</a>
            </div>
            <div class="col s12 center-align">
                <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Ingresar"><i class="material-icons">send</i></button>
            </div>

        </form>
    </div>
    <!-- Modal Structure -->
    <div id="cambiarContraseña" class="modal">
        <form method="post" id="cambiarcontraseña-form">
            <div class="modal-content">
                <h4>Actualizar Contraseña</h4>
                <p>Han pasado 90 dias desde la última vez que actualizaste tu contraseña, para poder iniciar sesión, debes actualizarla.</p>
                <div class="row">
                    <div class="input-field col s12 m6">
                        <i class="material-icons prefix">vpn_key</i>
                        <input id="txtNuevaContraseña" type="password" name="txtNuevaContraseña" class="validate" required />
                        <label for="txtNuevaContraseña">Nueva Contraseña</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <i class="material-icons prefix">security</i>
                        <input id="txtConfirmarContraseña" type="password" name="txtConfirmarContraseña" class="validate" required />
                        <label for="txtConfirmarContraseña">Confirmar Contraseña</label>
                    </div>
                </div>
                <div class="row" style="display: flex; align-items: center; justify-content: center;">
                    <p>
                        <label>
                            <input type="checkbox" id="mostrar" onchange="showHidePassword('mostrar','txtNuevaContraseña','txtConfirmarContraseña')"/>
                            <span>Mostrar Contraseña</span>
                        </label>
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="modal-close waves-effect waves-green btn-flat">Guardar Cambios</button>
            </div>
        </form>
    </div>

</div>

<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Dashboard_Page::footerTemplate('index.js');
?>