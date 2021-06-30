<?php
include("../../app/helpers/private_header_template.php");
?>
<!--Pagina reparacion-->
<div class="row">
    <div class="col s12 14 offset-14">
        <div class="container">
            <div class="container center">
                <h4>Reparaciones</h4>
                <div class="row">
                    <div class="col s12">
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">find_replace</i>
                                <input type="text" id="autocomplete-input" class="autocomplete">
                                <label for="autocomplete-input">Buscar reparacion...</label>
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
                        <th>Detalle Reparacion</th>
                        <th>Cita</th>
                        <th>Estado Reparacion</th>
                        <th>Encargado de la Reparacion</th>
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
                            <h4 class="center blue-grey-text">Reparaciones</h4>
                            <div class="row">
                                <div class="col s12 14 offset-14">
                                    <div class="card">
                                        <div class="card-action white white-text">
                                            <div class="card-content"></div>
                                            <div class="form-field">
                                                <label for="name" class="sr-only">Ingrese el detalle de la reparacion:</label>
                                                <input type="text" id="nombre" class="form-control">
                                            </div><br>
                                            <div class="form-field">
                                                <label for="subname" class="sr-only">Ingrese la fecha de la cita:</label>
                                                <input type="text" id="lastname" class="form-control">
                                            </div><br>
                                            <div class="form-field col s12">
                                                <label>Seleccione el estado de la reparacion: </label><br>
                                                <select class="browser-default"><br>
                                                    <option value="" disabled selected>Escoga una opción</option><br>
                                                    <option value="1">Sin reparar aun</option>
                                                    <option value="2">Pendiente </option>
                                                    <option value="3">En reparacion </option>
                                                    <option value="4">Ultimos detalles</option>
                                                    <option value="5">Listo</option>
                                                </select>
                                            </div><br>
                                            <div class="form-field">
                                                <label for="email" class="sr-only">Ingrese el Encargado:</label>
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
                                <td>Cambio pastilla de freno</td>
                                <td>10/05/2021</td>
                                <td>En Proceso</td>
                                <td>José Jiménez</td>
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