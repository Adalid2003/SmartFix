<?php
include("../../app/helpers/header_template.php");
?>
<!--Registrarse-->
<h1 class="center blue-grey-text">Registrarse</h1>
<!--si ya tiene cuenta pulsa el boton-->
<h6 class="center">Ya esta registrado con nosotros? de <a href="../public/login.php">click aquí</a> para iniciar sesíon ahora</h6>
<div class="row">
    <div class="col s12 14 offset-14">
        <div class="card">
            <div class="card-action white white-text">
                <div class="card-content"></div>
                <!--Nombre-->
                <div class="form-field">
                    <label for="name" class="sr-only">Ingrese su nombre:</label>
                    <input type="text" id="nombre" class="form-control">
                </div><br>
                <!--Apellidos-->
                <div class="form-field">
                    <label for="subname" class="sr-only">Ingrese su apellido:</label>
                    <input type="text" id="lastname" class="form-control">
                </div><br>
                <!--DUI-->
                <div class="form-field">
                    <label for="DUI" class="sr-only">Ingrese su numero de DUI:</label>
                    <input type="text" id="DUI" class="form-control">
                </div><br>
                <!--correo electronico-->
                <div class="form-field">
                    <label for="email" class="sr-only">Ingrese su correo electronico:</label>
                    <input type="email" id="email" class="form-control">
                </div><br>
                <!--Usuario-->
                <div class="form-field">
                    <label for="usuario" class="sr-only">Ingrese un nombre de usuario:</label>
                    <input type="text" id="usuario" class="form-control">
                </div><br>
                <!--Contraseña-->
                <div class="form-field">
                    <label for="contraseña">Ingrese una contraseña:</label>
                    <input type="password" id="pass">
                </div><br>
                <!--Tipo usuario-->
                <!--div class="form-field col s12">
                    <label>Seleccione el tipo de usuario: </label><br>
                    <select class="browser-default"><br>
                        <option value="" disabled selected>Escoga una opción</option><br>
                        <option value="1">Administrador</option>
                        <option value="2">Mecanico</option>
                        <option value="3">Empleado de limpieza</option>
                    </select>
                </div-->
                <!--Telefono-->
                <div class="form-field">
                    <label for="telefono" class="sr-only">Ingrese su numero de telefono:</label>
                    <input type="text" id="telefono" class="form-control">
                </div><br>
                <!--Sueldo del usuario-->
                <!--div class="form-field">
                    <label for="sueldo" class="sr-only">Ingrese el sueldo que ganara el empleado:</label>
                    <input type="text" id="sueldo" class="form-control">
                </div><br-->
               <!--Especialidad--> 
                <!--div class="form-field col s12">
                    <label>Seleccione la especialidad del usuario: </label><br>
                    <select class="browser-default"><br>
                        <option value="" disabled selected>Escoga una opción</option><br>
                        <option value="1">Mecanico general</option>
                        <option value="2">Pintura</option>
                        <option value="3">Limpieza</option>
                    </select>
                </div-->
                <!--estado_usuario-->
                <!--div class="form-field col s12">
                    <label>Seleccione el estado del usuario: </label><br>
                    <select class="browser-default"><br>
                        <option value="" disabled selected>Escoga una opción</option><br>
                        <option value="1">Activo</option>
                        <option value="2">Inactivo</option>
                        <option value="3">Bloqueado</option>
                    </select>
                </div-->
                <!--Registrar-->
                <div class="form-field center-align">
                    <button class="btn-large blue-grey darken-4">Registrarse</button>
                </div><br>
            </div>
        </div>
        <?php
        include("../../app/helpers/footer_template.php");
        ?>