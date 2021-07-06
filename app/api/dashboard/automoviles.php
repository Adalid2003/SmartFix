<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/automoviles.php');
// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $automoviles = new Automoviles;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (isset($_SESSION['id_usuario'])) {
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            case 'readAll':
                if ($result['dataset'] = $automoviles->readAll()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay automoviles ingresados aún';
                    }
                }
                break;
            case 'readAll2':
                if ($result['dataset'] = $automoviles->readAll2()) {
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
                if ($result['dataset'] = $automoviles->readAll3()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay automoviles ingresados aún';
                    }
                }
                break;
            case 'readAll4':
                if ($result['dataset'] = $automoviles->readAll4()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay clases ingresados aún';
                    }
                }
                break;
            case 'readAll5':
                if ($result['dataset'] = $automoviles->readAll5()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay clientes ingresados aún';
                    }
                }
                break;
            case 'search':
                $_POST = $proveedores->validateForm($_POST);
                if ($_POST['search'] != '') {
                    if ($result['dataset'] = $proveedores->searchRows($_POST['search'])) {
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
                $_POST = $proveedores->validateForm($_POST);
                if ($proveedores->setNombre_proveedor($_POST['nombre_proveedor'])) {
                    if ($proveedores->setTelefono_proveedor($_POST['telefono_proveedor'])) {
                        if ($proveedores->setDireccion_proveedor($_POST['direccion_proveedor'])) {
                            if ($proveedores->createRow()) {
                                $result['status'] = 1;
                            } else {
                                $result['exception'] = Database::getException();
                            }
                        } else {
                            $result['exception'] = 'Direccion incorrecta';
                        }
                    } else {
                        $result['exception'] = 'Telefono incorrecto';
                    }
                } else {
                    $result['exception'] = 'Nombre incorrecto';
                }
                break;
            case 'readOne':
                if ($proveedores->setId($_POST['id_proveedor'])) {
                    if ($result['dataset'] = $proveedores->readOne()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Este Proveedor no existe';
                        }
                    }
                } else {
                    $result['exception'] = 'El Proveedor es incorrecto';
                }
                break;
            case 'update':
                $_POST = $proveedores->validateForm($_POST);
                if ($proveedores->setId($_POST['id_proovedor'])) {

                    if ($data = $proveedores->readOne()) {
                        if ($proveedores->setNombre_proveedor($_POST['nombre_proveedor'])) {
                            if ($proveedores->setTelefono_proveedor($_POST['telefono_proveedor'])) {
                                if ($proveedores->setDireccion_proveedor($_POST['direccion_proveedor'])) {
                                    if ($proveedores->updateRow()) {
                                        $result['status'] = 1;
                                        $result['message'] = 'Proveedor modificado correctamente';
                                    } else {
                                        $result['exception'] = Database::getException();
                                    }
                                } else {
                                    $result['exception'] = 'La direccion del Proveedor es incorrecta';
                                }
                            } else {
                                $result['exception'] = 'El telefono del Proveedor es incorrecto';
                            }
                        } else {
                            $result['exception'] = 'El  Nombre del Proveedor es incorrecto';
                        }
                    } else {
                        $result['exception'] = 'El Proveedor no existe';
                    }
                }
                break;
            case 'delete':
                $_POST = $proveedores->validateForm($_POST);
                if ($proveedores->setId($_POST['id_proveedor'])) {
                    if ($data = $proveedores->readOne()) {
                        if ($proveedores->deleteRow()) {
                            $result['status'] = 1;
                            $result['message'] = 'Proveedor eliminado correctamente';
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Proveedor inexistente';
                    }
                } else {
                    $result['exception'] = 'Proveedor incorrecto';
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
