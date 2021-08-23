<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/cita.php');
// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $citas = new Cita;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (isset($_SESSION['id_usuario'])) {
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
                //Se ejecuta la accion readAll para leer los datos y llenar la tabla
            case 'readAll':
                if ($result['dataset'] = $citas->readAll()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay citas ingresados aún';
                    }
                }
                break;
                //Se ejecuta la accion para llenar el combobox
            case 'readAll2':
                if ($result['dataset'] = $citas->readAll2()) {
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
                if ($result['dataset'] = $citas->readAll3()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay clases ingresados aún';
                    }
                }
                break;
            case 'readAll4':
                if ($result['dataset'] = $citas->readAll4()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay clases ingresados aún';
                    }
                }
                break;
                //Se ejecuta la accion para buscar un registro
            case 'search':
                $_POST = $citas->validateForm($_POST);
                if ($_POST['search'] != '') {
                    if ($result['dataset'] = $citas->searchRows($_POST['search'])) {
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
                //Se ejecuta la accion para crear un registro
            case 'create':
                //print_r($_POST);
                $_POST = $citas->validateForm($_POST);
                if ($citas->setFecha($_POST['fecha'])) {
                    if (isset($_POST['hora'])) {
                        if ($citas->setHora($_POST['hora'])) {
                            if (isset($_POST['estado'])) {
                                if ($citas->setEstado($_POST['estado'])) {
                                    if (isset($_POST['cliente'])) {
                                        if ($citas->setCliente($_POST['cliente'])) {
                                            if ($citas->setRazon($_POST['razon'])) {
                                                if ($citas->createRowP()) {
                                                    $result['status'] = 1;
                                                    $result['message'] = 'Cita programada correctamente';
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
                        } else {
                        }
                    } else {
                    }
                }
                break;
            case 'readOne':
                if ($citas->setId($_POST['id_cita'])) {
                    if ($result['dataset'] = $citas->readOne()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Este automovil no existe';
                        }
                    }
                } else {
                    $result['exception'] = 'El automovil es incorrecto';
                }
                break;
            case 'update':
                $_POST = $citas->validateForm($_POST);
                if ($citas->setId($_POST['id_cita'])) {
                    if ($data = $citas->readOne()) {
                        if ($citas->setFecha($_POST['fecha'])) {
                            if (isset($_POST['hora'])) {
                                if ($citas->setHora($_POST['hora'])) {
                                    if (isset($_POST['estado'])) {
                                        if ($citas->setEstado($_POST['estado'])) {
                                            if (isset($_POST['cliente'])) {
                                                if ($citas->setCliente($_POST['cliente'])) {
                                                    if ($citas->setRazon($_POST['razon'])) {
                                                        if ($citas->updateRow()) {
                                                            $result['status'] = 1;
                                                            $result['message'] = 'Cita actualizada correctamente';
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
                                } else {
                                }
                            } else {
                            }
                        } else {
                        }
                    } else {
                    }
                }
                break;
            case 'delete':
                $_POST = $citas->validateForm($_POST);
                if ($citas->setId($_POST['id_cita'])) {
                    if ($data = $citas->readOne()) {
                        if ($citas->deleteRow()) {
                            $result['status'] = 1;
                            $result['message'] = 'Cita eliminada correctamente';
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Cita inexistente';
                    }
                } else {
                    $result['exception'] = 'Cita incorrecto';
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
