<?php
// Se incluye la clase con las plantillas del documento.
require_once('../../app/helpers/header_template.php');
// Se imprime la plantilla del encabezado enviando el título de la página web.
Public_Page::headerTemplate('Index');
?>
<!--Sliders-->
<section class="slider">
    <ul class="slides">
        <li>
        <!-- random image -->
            <img src="../../resource/img/slider/carro.jpg"> 
            <div class="caption center-align">
                <h1 class="grey-text text-lighten-3 s1">Tu taller ideal</h3>
                    <h5 class="white-text text-lighten-3">SmartFix es tu mejor opcion para arreglar tu vehiculo.</h5>
                    <a href="hub_pasivo.php" class="btn btn-large white black-text waves-effect waves-grey">AGENDAR CITA</a>
            </div>
        </li>
        <li>
        <!-- random image -->
            <img src="../../resource/img/slider/s1.jpg"> 
            <div class="caption center-align">
                <h1 class="grey-text text-lighten-3 s1">Tu taller ideal</h3>
                    <h5 class="white-text text-lighten-3">SmartFix es tu mejor opcion para arreglar tu vehiculo.</h5>
                    <a href="hub_pasivo.php" class="btn btn-large white black-text waves-effect waves-grey">AGENDAR CITA</a>
            </div>
        </li>
</section>
  <!--Informacion relevante-->
<div class="row">
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center black-text"><i class="material-icons">directions_car</i></h2>
            <h5 class="center">Mantenimiento agil</h5>

            <h6 class="light">Nos caracterizamos por hacer la reparación de tu vehiculo en el menor tiempo posible. obviamente cuidando cada detalle de manera que tu vehiculo este en buenas condiciones y puedas disfrutar de el.</h6>
          </div>
        </div>
  <!--Informacion relevante-->
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center black-text"><i class="material-icons">group</i></h2>
            <h5 class="center">Muchos nos recomiendan</h5>

            <h6 class="light">Tenemos alta aceptación entre nuestros clientes.</h6>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center black-text"><i class="material-icons">alarm</i></h2>
            <h5 class="center">Programa tu cita</h5>
            <!--Informacion relevante-->
            <p class="light">Programa tu cita y será un gusto atenderte.</p>
          </div>
        </div>
      </div>

    </div>
    <br><br>
  </div>
  <div class="fixed-action-btn">
  <a class="btn-floating btn-large green" href="https://wa.me/50370320267?text=Hola%20,%20buenos%20d%C3%ADas%20necesito%20m%C3%A1s%20informaci%C3%B3n">
    <i class="large material-icons">message</i>
  </a>
  </div>
  <?php
    // Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
    Public_Page::footerTemplate('index.js');
    ?>