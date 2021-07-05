<?php
// Se incluye la clase con las plantillas del documento.
require_once('../../app/helpers/header_template.php');
// Se imprime la plantilla del encabezado enviando el título de la página web.
Public_Page::headerTemplate('Iniciar sesión');
?>
<head>
    
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="shotcut icon" href="favicon.ico" type="image/x-icon">
</head>

<!-- Contenedor para mostrar el formulario de inicio de sesión -->
<div class="container">
    <!-- Título del contenido principal -->
    <h4 class="center-align indigo-text">Iniciar sesión</h4>
    <!-- Formulario para iniciar sesión -->
    <form method="post" id="session-form">
        <div class="row">
            <div class="input-field col s12 m4 offset-m4">
                <i class="material-icons prefix">email</i>
                <input type="text" id="usuario" name="usuario" class="validate" required/>
                <label for="usuario">Usuario</label>
            </div>
            <div class="input-field col s12 m4 offset-m4">
                <i class="material-icons prefix">security</i>
                <input type="password" id="clave" name="clave" class="validate" required/>
                <label for="clave">Clave</label>
            </div>
        </div>
        <div class="row center-align">
            <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Ingresar"><i class="material-icons">send</i></button>
        </div>
    </form>
</div>
<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Public_Page::footerTemplate('login.js');
?>