<?php
include("../../app/helpers/private_header_template.php");
?>
<div class="row">
    <div class="col s12 14 offset-14">
        <div class="container">
            <div class="container center">
                <h4>Usuarios</h4>


                <div class="row">
                    <div class="col s12">
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">find_replace</i>
                                <input type="text" id="autocomplete-input" class="autocomplete">
                                <label for="autocomplete-input">Buscar usuario...</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <table class="striped responsive-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Tipo usuario</th>
                        <th>Estado</th>
                        <th>DUI</th>
                        <th>Contraseña</th>
                        <th>Especialidad</th>
                        <th>Correo electronico</th>
                        <th>Salario</th>
                        <th>Acción</th>
                    </tr>
                </thead>

                <tbody>
                    <a id="scale-demo" href="#modal1" class="green btn-floating btn-large scale-transition modal-trigger">
                        <i class="material-icons">add</i>
                    </a>
                    <div id="modal1" class="modal">
                        <div class="modal-content">
                            <h4 class="center blue-grey-text">Usuarios</h4>
                            <div class="row">
                                <div class="col s12 14 offset-14">
                                    <div class="card">
                                        <div class="card-action white white-text">
                                            <div class="card-content"></div>
                                            <div class="form-field">
                                                <label for="name" class="sr-only">Ingrese su nombre:</label>
                                                <input type="text" id="nombre" class="form-control">
                                            </div><br>
                                            <div class="form-field">
                                                <label for="subname" class="sr-only">Ingrese su apellido:</label>
                                                <input type="text" id="lastname" class="form-control">
                                            </div><br>
                                            <div class="form-field">
                                                <label for="usuario" class="sr-only">Ingrese un nombre de usuario:</label>
                                                <input type="text" id="usuario" class="form-control">
                                            </div><br>
                                            <div class="form-field">
                                                <label for="contraseña">Ingrese una contraseña:</label>
                                                <input type="password" id="pass">
                                            </div><br>
                                            <div class="form-field col s12">
                                                <label>Seleccione el tipo de usuario: </label><br>
                                                <select class="browser-default"><br>
                                                    <option value="" disabled selected>Escoga una opción</option><br>
                                                    <option value="1">Administrador</option>
                                                    <option value="2">Mecanico</option>
                                                    <option value="3">Empleado de limpieza</option>
                                                </select>
                                            </div>
                                            <div class="form-field">
                                                <label for="email" class="sr-only">Ingrese su correo electronico:</label>
                                                <input type="email" id="email" class="form-control">
                                            </div><br>
                                            <div class="form-field">
                                                <label for="telefono" class="sr-only">Ingrese su numero de telefono:</label>
                                                <input type="text" id="telefono" class="form-control">
                                            </div><br>
                                            <div class="form-field">
                                                <label for="DUI" class="sr-only">Ingrese su numero de DUI:</label>
                                                <input type="text" id="DUI" class="form-control">
                                            </div><br>
                                            <div class="form-field">
                                                <label for="sueldo" class="sr-only">Ingrese el sueldo que ganara el empleado:</label>
                                                <input type="text" id="sueldo" class="form-control">
                                            </div><br>
                                            <div class="form-field col s12">
                                                <label>Seleccione la espacialidad del usuario: </label><br>
                                                <select class="browser-default"><br>
                                                    <option value="" disabled selected>Escoga una opción</option><br>
                                                    <option value="1">Mecanico general</option>
                                                    <option value="2">Pintura</option>
                                                    <option value="3">Limpieza</option>
                                                </select>
                                            </div>
                                            <div class="form-field col s12">
                                                <label>Seleccione el estado del usuario: </label><br>
                                                <select class="browser-default"><br>
                                                    <option value="" disabled selected>Escoga una opción</option><br>
                                                    <option value="1">Activo</option>
                                                    <option value="2">Inactivo</option>
                                                    <option value="3">Bloqueado</option>
                                                </select>
                                            </div>
                                            <div class="form-field center-align">
                                                <button class="btn-large blue-grey darken-4 modal-close">AGREGAR</button>
                                            </div><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">CANCELAR</a>
                                </div>
                            </div><br>
                            <tr>
                                <td>1</td>
                                <td>José Jiménez</td>
                                <td>Root</td>
                                <td>Activo</td>
                                <td>00123859-7</td>
                                <td>1234</td>
                                <td>Mecanico General</td>
                                <td>20190119@ricaldone.edu.sv</td>
                                <td>$750</td>
                                <td>
                                    <a id="scale-demo" href="#modal1" class="blue btn-floating btn-large scale-transition modal-trigger">
                                        <i class="material-icons">autorenew</i>
                                    </a>
                                    <a id="scale-demo" href="#modal2" class="red btn-floating btn-large scale-transition modal-trigger">
                                        <i class="material-icons">close</i>
                                    </a>
                                </td>
                            </tr>

                </tbody>
            </table>
        </div>
        <div id="modal2" class="modal">
            <div class="modal-content">
                <h4>¿Desea dar de baja al usuario?</h4>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-green btn-flat green">ACEPTAR</a>
                <a href="#!" class="modal-close waves-effect waves-green btn-flat red">CANCELAR</a>
            </div>
            /
        </div>
    </div>
    <?php
    include("../../app/helpers/footer_template.php");
    ?>