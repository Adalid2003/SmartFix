<?php
include("../../app/helpers/private_header_template.php");
?>
<!--Pagina citas-->
<div class="row">
    <div class="col s12 14 offset-14">
        <div class="container">
            <div class="container center">
                <h4>Citas</h4>


                <div class="row">
                    <div class="col s12">
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">find_replace</i>
                                <input type="text" id="autocomplete-input" class="autocomplete">
                                <label for="autocomplete-input">Buscar cita...</label>
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
                        <th>Fecha de la Cita</th>
                        <th>Nombre Cliente</th>
                        <th>Estado de la Cita</th>
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
                            <h4 class="center blue-grey-text">citas</h4>
                            <div class="row">
                                <div class="col s12 14 offset-14">
                                    <div class="card">
                                        <div class="card-action white white-text">
                                            <div class="card-content"></div>
                                            <div class="form-field">
                                                <label for="subname" class="sr-only">Ingrese la fecha de la cita:</label>
                                                <input type="text" id="lastname" class="form-control">
                                            </div><br>
                                            <div class="form-field">
                                                <label for="usuario" class="sr-only">Nombre del cliente:</label>
                                                <input type="text" id="usuario" class="form-control">
                                            </div><br>
                                            <div class="form-field col s12">
                                                <label>Estado de la cita: </label><br>
                                                <select class="browser-default"><br>
                                                    <option value="" disabled selected>Escoga una opción</option><br>
                                                    <option value="1">Nueva</option>
                                                    <option value="2">Sin confirmar</option>
                                                    <option value="3">Confirmada </option>
                                                    <option value="4">No se presento</option>
                                                    <option value="5">Reagendada</option>
                                                    <option value="6">Cancelada</option>
                                                </select>
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
                                <td>10/05/2021</td>
                                <td>Juan Mejia</td>
                                <td>Nueva</td>
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
                <h4>¿Desea eliminar la cita?</h4>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-green btn-flat green">ACEPTAR</a>
                <a href="#!" class="modal-close waves-effect waves-green btn-flat red">CANCELAR</a>
            </div>
        </div>
    </div>
    <?php
    include("../../app/helpers/footer_template.php");
    ?>