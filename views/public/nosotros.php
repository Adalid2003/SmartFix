<?php
// Se incluye la clase con las plantillas del documento.
require_once('../../app/helpers/header_template.php');
// Se imprime la plantilla del encabezado enviando el título de la página web.
Public_Page::headerTemplate('Iniciar sesión');
?>
<!--Comienzo seccion quienes somos-->
<h4 class="center blue-grey-text">Sobre nosotros</h4>
<<ul class="collapsible">
    <!--Informacion Relevante-->
    <li>
        <div class="collapsible-header"><i class="material-icons">filter_drama</i>¿Que servicios brindamos?</div>
        <div class="collapsible-body"><span>Los servicios que ofrecen son mecánica general, reparación de trasmisión automático, ajustes de motor, reparación de falla eléctrica, diagnostico por computadoras, carga de aire acondicionado y reparación de falla de computadora</span></div>
    </li>
    <!--Informacion Relevante-->
    <li>
        <div class="collapsible-header"><i class="material-icons">map</i>¿Donde estamos ubicados?</div>
        <div class="collapsible-body"><span> <span>Estamos ubicados sobre la Avenida España N°1329 barrio San Miguelito, San Salvador</span><iframe class="center-align" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d242.25492835636075!2d-89.18997468445325!3d13.713673866987712!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f633097d0cf4a61%3A0xff0f02714859306c!2sAvenida%20Espa%C3%B1a%201329%2C%20San%20Salvador!5e0!3m2!1ses!2ssv!4v1618262948341!5m2!1ses!2ssv" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>.</span></div>
    </li>
    <!--Informacion Relevante-->
    <li>
        <div class="collapsible-header"><i class="material-icons">directions_car</i>¿Que tipos de vehiculos arreglamos?</div>
        <div class="collapsible-body"><span>Arreglamos todo tipo de vehiculos de cualquier modelo y marca.</span></div>
    </li>
    <!--Informacion Relevante-->
    <li>
        <div class="collapsible-header"><i class="material-icons">local_phone</i>¿Cual es nuestro numero de contacto?</div>
        <div class="collapsible-body"><span>Telefono: 2225-9257</span></div>
    </li>
    <!--Informacion Relevante-->
    <li>
        <div class="collapsible-header"><i class="material-icons">access_time</i>¿Cual es nuestro horario de servicio?</div>
        <div class="collapsible-body"><span>De lunes a sabado de 8:00 AM a 4:00 PM</span></div>
    </li>
    </ul>
<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Public_Page::footerTemplate('login.js');
?>