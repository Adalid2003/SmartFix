<?php
include("../../app/helpers/header_template.php");
?>
<!--Inicio Login-->
<h1 class="center blue-grey-text">Iniciar sesión</h1>
<!--Registro-->
<h6 class="center">Es nuevo? de <a href="../public/registrarse.php">click aquí</a> para registrarse ahora</h6>
<div class="row">
        <div class="col s12 14 offset-14">
            <div class="card">
            <div class="card-action white white-text">
                    <div class="card-content"></div>
                    <!--Ingreso de usuario-->
                    <div class="form-field">
                        <label for="usuario" class="sr-only">Ingrese su usuario:</label>
                        <input type="text" id="usuario" class="form-control">
                    </div><br>
                    <!--Ingreso Contraseña-->
                    <div class="form-field">
                        <label for="contraseña">Ingrese su contraseña:</label>
                        <input type="password" id="pass">
                    </div><br>
                    <!--Boton Login--->
                    <div class="form-field center-align">
                        <button class="btn-large blue-grey darken-4">Inciar sesión</button>
                    </div><br>
                    <!--Olvide mi contraseña-->
                    <div class="form-field center-align">
                        <button class="btn-large blue-grey darken-4">Olvide mi contraseña</button>
                    </div><br>
            </div>
            </div>
<?php
include("../../app/helpers/footer_template.php");
?>