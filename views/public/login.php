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
    <form method="post" id="session-form" autocomplete="off">
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
            <p>
            <a href="../../views/public/recuperar.php">He olvidado mi contraseña</a>
        </div>
        <div class="row center-align">
            <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Ingresar"><i class="material-icons">send</i></button>
        </div>
    </form>
    <p class="center-align indigo-text">¿Aun no tienes una cuenta? <a href="../../views/public/registrarse.php">REGISTRATE AHORA</a></p>
</div>

<!-- Modal Structure -->
<div id="cambiarContraseña" class="modal">
        <form method="post" id="cambiarcontraseña-form" autocomplete="off">
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
<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Public_Page::footerTemplate('login.js');
?>