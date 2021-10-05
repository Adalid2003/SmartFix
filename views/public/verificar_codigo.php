<?php
// Se incluye la clase con las plantillas del documento.
require_once('../../app/helpers/header_template.php');
require_once('../../app/helpers/database.php');
// Se imprime la plantilla del encabezado enviando el título de la página web.
Public_Page::headerTemplate('Recuperar contraseña');
?>

<div class="container">
    <div class="row">
        <h3 class="center-align">Verificar Código</h3>
        <h5>Se ha enviado un correo con el código de verificación a la cuenta de correo electrónico ingresada anteriormente</h5>
        <form method="post" id="password-form">
            <div class="row">
                <div class="input-field col s12 m6 offset-m3">
                    <i class="material-icons prefix">security</i>
                    <input id="txtCodigo" type="number" name="txtCodigo" class="validate" required/>
                    <label for="clave_actual">Código</label>
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
    Public_page::footerTemplate('verificar_codigo.js');
?>