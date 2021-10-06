<?php
// Se incluye la clase con las plantillas del documento.
require_once('../../app/helpers/private_header_template.php');
// Se imprime la plantilla del encabezado enviando el título de la página web.
Dashboard_Page::headerTemplate('Registrar primer usuario');
?>

<!-- Formulario para registrar al primer usuario del dashboard -->
<form method="post" id="register-form"  autocomplete="off">
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
        <div class="input-field col s6">
            <select id="especialidad" name="especialidad">
            </select>
            <label>Especialidad</label>
        </div>
    </div>
    <div class="row center-align">
        <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Registrar"><i class="material-icons">send</i></button>
    </div>
</form>

<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Dashboard_Page::footerTemplate('register.js');
?>