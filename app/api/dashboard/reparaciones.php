<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/reparaciones.php');
// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $reparacion = new Reparacion;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (isset($_SESSION['id_usuario'])) {
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            //Se ejecuta la accion readAll para leer los datos y llenar la tabla
            case 'readAll':
                if ($result['dataset'] = $reparacion->readAll()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay reparaciones ingresados aún';
                    }
                }
                break;
            case 'readAll2':
                if ($result['dataset'] = $reparacion->readAll2()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay automoviles ingresados aún';
                    }
                }
                break;
            case 'readAll3':
                if ($result['dataset'] = $reparacion->readAll3()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay clases ingresados aún';
                    }
                }
                break;
            case 'search':
                $_POST = $reparacion->validateForm($_POST);
                if ($_POST['search'] != '') {
                    if ($result['dataset'] = $reparacion->searchRows($_POST['search'])) {
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
                $_POST = $reparacion->validateForm($_POST);
                    if (isset($_POST['cita'])) {
                        if ($reparacion->setCita($_POST['cita'])) {
                            if (isset($_POST['estado'])) {
                                if ($reparacion->setEstado($_POST['estado'])) {
                                        if ($reparacion->setRepuesto($_POST['repuesto'])) {
                                            if ($reparacion->setPrecio($_POST['precio_repuesto'])) {
                                                if ($reparacion->setObra($_POST['obra'])) {
                                            if ($reparacion->createRow()) {
                                                $result['status'] = 1;
                                                $result['message'] = 'Reparacion registrada correctamente';
                                            } else {
                                                $result['exception'] = Database::getException();
                                            }
                                        } else {
                                            $result['exception'] = 'Estado incorrecto';
                                        }
                                    } else {
                                        $result['exception'] = 'Precio incorrecto';
                                    }
                                } else {
                                    $result['exception'] = 'Seleccione una hora';
                                }
                            } else {
                                $result['exception'] = 'Fecha incorrecta';
                            }
                        } else {
                        }
                    }else{

                    }
                }else{

                }
                break;
            case 'readOne':
                //print_r($_POST);
                if ($reparacion->setId($_POST['id_reparacion'])) {
                    if ($result['dataset'] = $reparacion->readOne()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Este automovil no existe';
                        }
                    }
                } else {
                    $result['exception'] = 'La reparación es incorrecta';
                }
                break;
            case 'update':
                $_POST = $reparacion->validateForm($_POST);
                if ($reparacion->setId($_POST['id_reparacion'])) {
                    if ($data = $reparacion->readOne()) {
                        if (isset($_POST['cita'])) {
                            if ($reparacion->setCita($_POST['cita'])) {
                                if (isset($_POST['estado'])) {
                                    if ($reparacion->setEstado($_POST['estado'])) {
                                            if ($reparacion->setRepuesto($_POST['repuesto'])) {
                                                if ($reparacion->setPrecio($_POST['precio_repuesto'])) {
                                                    if ($reparacion->setObra($_POST['obra'])) {
                                                if ($reparacion->updateRow()) {
                                                    $result['status'] = 1;
                                                    $result['message'] = 'Reparacion actualizada correctamente';
                                                } else {
                                                    $result['exception'] = Database::getException();
                                                }
                                            } else {
                                                $result['exception'] = 'Estado incorrecto';
                                            }
                                        } else {
                                            $result['exception'] = 'Hora incorrecta';
                                        }
                                    } else {
                                        $result['exception'] = 'Seleccione una hora';
                                    }
                                } else {
                                    $result['exception'] = 'Fecha incorrecta';
                                }
                            } else {
                            }
                        }else{
    
                        }
                    }else{
    
                    }
                    }else{

                    }
                }else{

                }
                break;
            case 'delete':
                $_POST = $reparacion->validateForm($_POST);
                if ($reparacion->setId($_POST['id_reparacion'])) {
                    if ($data = $reparacion->readOne()) {
                        if ($reparacion->deleteRow()) {
                            $result['status'] = 1;
                            $result['message'] = 'Reparación eliminada correctamente';
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Reparacion inexistente';
                    }
                } else {
                    $result['exception'] = 'Reparacion incorrecta';
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
