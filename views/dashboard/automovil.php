<?php
include("../../app/helpers/private_header_template.php");
?>
<!--Pagina Automoviles-->
<div class="row">
    <div class="col s12 14 offset-14">
        <div class="container">
            <div class="container center">
                <h4>Automoviles</h4>


                <div class="row">
                    <div class="col s12">
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">find_replace</i>
                                <input type="text" id="autocomplete-input" class="autocomplete">
                                <label for="autocomplete-input">Buscar automovil...</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Encabezado tablas-->
            <table class="striped responsive-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Año</th>
                        <th>Color</th>
                        <th>N° Motor</th>
                        <th>Clase de automovil</th>
                        <th>Detalle de reparacion</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <!--Boton agregar-->
                <tbody>
                    <a id="scale-demo" href="#modal1" class="green btn-floating btn-large scale-transition modal-trigger">
                        <i class="material-icons">add</i>
                    </a>
                    <!--Inicio modal-->
                    <div id="modal1" class="modal">
                        <div class="modal-content">
                            <h4 class="center blue-grey-text">Automoviles</h4>
                            <div class="row">
                                <div class="col s12 14 offset-14">
                                    <div class="card">
                                        <div class="card-action white white-text">
                                            <div class="card-content"></div>
                                            <div class="form-field">
                                                <label for="name" class="sr-only">Ingrese la marca del automovil:</label>
                                                <input type="text" id="nombre" class="form-control">
                                            </div><br>
                                            <div class="form-field">
                                                <label for="subname" class="sr-only">Ingrese el modelo:</label>
                                                <input type="text" id="lastname" class="form-control">
                                            </div><br>
                                            <div class="form-field">
                                                <label for="usuario" class="sr-only">Ingrese el año:</label>
                                                <input type="text" id="usuario" class="form-control">
                                            </div><br>
                                            <div class="form-field">
                                                <label for="contraseña">Ingrese el color:</label>
                                                <input type="text" id="pass">
                                            </div><br>
                                            <div class="form-field">
                                                <label for="email" class="sr-only">Ingrese el numero de motor:</label>
                                                <input type="text" id="email" class="form-control">
                                            </div><br>
                                            <div class="form-field col s12">
                                                <label>Seleccione la clase de automovil: </label><br>
                                                <select class="browser-default"><br>
                                                    <option value="" disabled selected>Escoga una opción</option><br>
                                                    <option value="1">Sedan</option>
                                                    <option value="2">Hatchback </option>
                                                    <option value="3">SUV </option>
                                                    <option value="4">Deportivos</option>
                                                    <option value="5">Vehículos Comerciales</option>
                                                    <option value="6">Van</option>
                                                    <option value="7">Pick Up</option>
                                                    <option value="8">Camioneta</option>
                                                </select>
                                            </div><br>
                                            <div class="form-field">
                                                <label for="email" class="sr-only">Detalle reparacion:</label>
                                                <input type="text" id="email" class="form-control">
                                            </div><br>
                                            <!--Botones Modal-->
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
                            <!--datos de tabla-->
                                <td>1</td>
                                <td>Nissan</td>
                                <td>Juke</td>
                                <td>2015</td>
                                <td>Vino</td>
                                <td>LM165FMMQQ215080</td>
                                <td>Camioneta</td>
                                <td>Cambio pastilla de freno</td>
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
        <!--Modal de eliminar-->
        <div id="modal2" class="modal">
            <div class="modal-content">
                <h4>¿Desea eliminar este vehiculo de la reparacion?</h4>
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