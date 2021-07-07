<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/detalle_reparacion.php');
// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $reparaciones = new reparaciones;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (isset($_SESSION['id_usuario'])) {
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            case 'readAll':
                if ($result['dataset'] = $reparaciones->readAll()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay dettalle de reparacion  ingresados aún';
                    }
                }
                break;
            case 'readAll2':
                if ($result['dataset'] = $reparaciones->readAll2()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay detalle reparacion ingresados aún';
                    }
                }
                break;
            case 'readAll3':
                if ($result['dataset'] = $reparacione->readAll3()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay  detalle reparacion ingresados aún';
                    }
                }
                break;
            case 'search':
                $_POST = $usuarios->validateForm($_POST);
                if ($_POST['search'] != '') {
                    if ($result['dataset'] = $usuarios->searchRows($_POST['search'])) {
                        $result['status'] = 1;
                        $rows = count($result['dataset']);
                        if ($rows > 1) {
                            $result['message'] = 'Se ha encontrado ' . $rows . ' coincidencias';
                        } else {
                            $result['message'] = 'Solo se ha encontrado una coincidencia';
                        }
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'No hay coincidencias';
                        }
                    }
                } else {
                    $result['exception'] = 'Ingrese un valor para buscar';
                }
                break;
            case 'create':
                //print_r($_POST);
                $_POST = $reparaciones rios->validateForm($_POST);
                if ($proveedores->setDetalle($_POST['detalle_rep'])) {
                    if ($proveedores->setRepuesto($_POST['repuesto'])) {
                        
                    } else {
                        $result['exception'] = 'Repuesto incorrecto';
                    }
                } else {
                    $result['exception'] = 'Detalle incorrecto';
                }
                break;
            case 'readOne':
                if ($reparaciones->setId($_POST['id_usid_detalleuario'])) {
                    if ($result['dataset'] = $reparaciones->readOne()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Este detalle de reparaciones no existe';
                        }
                    }
                } else {
                    $result['exception'] = 'El detalle de reparaciones  es incorrecto';
                }
                break;
            case 'update':
                $_POST = $Reparaciones->validateForm($_POST);
                if ($Reparaciones->setId($_POST['id_detalle_rep'])) {

                    if ($data = $Reparaciones->readOne()) {
                        if ($Reparaciones->setDetalle($_POST['detalle_rep'])) {
                            if ($Reparaciones->setRepuesto($_POST['repuesto'])) {
                                if ($Reparaciones->setPrecio($_POST['precio'])) {
                                    if ($Reparaciones->setObra($_POST['obra'])) {
                                
                                    } else {
                                        $result['exception'] = 'La mano de obra del detalle es incorrecto';
                                    }
                                
                                } else {
                                    $result['exception'] = 'El precio del detalle es incorrecto';
                                }
                                
                            } else {
                                $result['exception'] = 'El repuesto del detalle es incorrecto';
                            }
                        } else {
                            $result['exception'] = 'El  detalle  es incorrecto';
                        }
                }
                break;
            case 'delete':
                $_POST = $reparaciones->validateForm($_POST);
                if ($reparaciones->setId($_POST['id_detalle_rep'])) {
                    if ($data = $reparaciones->readOne()) {
                        if ($reparaciones->deleteRow()) {
                            $result['status'] = 1;
                            $result['message'] = 'Reparaciones eliminado correctamente';
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Reparaciones inexistente';
                    }
                } else {
                    $result['exception'] = 'Reparaciones incorrecto';
                }
                break;
            default:
                $result['exception'] = 'Acción no disponible dentro de la sesión';
        }
        // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
        header('content-type: application/json; charset=utf-8');
        // Se imprime el resultado en formato JSON y se retorna al controlador.
        print(json_encode($result));
    } else {
        print(json_encode('Acceso denegado'));
    }
} else {
    print(json_encode('Recurso no disponible'));
}
