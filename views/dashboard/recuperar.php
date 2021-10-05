<?php
// Se incluye la clase con las plantillas del documento.
require_once('../../app/helpers/private_header_template.php');
require_once('../../app/helpers/database.php');
// Se imprime la plantilla del encabezado enviando el título de la página web.
Dashboard_Page::headerTemplate('Recuperar contraseña');
?>
<!-- Contenedor para mostrar el formulario de inicio de sesión -->
<<div class="container">
    <div class="row">
        <h3 class="center-align">Verificar Email</h3>
        <h5 class="center">Ingrese el correo electrónico con el que se registro en nuestro sistema</h5>
        <form method="post" id="password-form">
            <div class="row">

                <div class="input-field col s12 m6 offset-m3">
                    <i class="material-icons prefix">mail</i>
                    <input id="txtCorreo" type="email" name="txtCorreo" class="validate" required  autocomplete="off"/>
                    <label for="clave_actual">Correo</label>
                </div>
            </div>
            <div class="row center-align">
                <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar"><i class="material-icons">check</i></button>
            </div>
        </form>
    </div>
    </div>
    <?php
    // Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
    Dashboard_Page::footerTemplate('verificar_contra.js');
    ?>