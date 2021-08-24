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
                //Se ejecuta la accion readAll para leer los datos y llenar la tabla
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
                //Se llama la consulta para llenar el combobox
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
                //Se llama a la consulta para llenar el combobox
            case 'readAll3':
                if ($automoviles->setMarca($_GET['marca'])) {
                    if ($result['dataset'] = $automoviles->readAll3()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'No hay automoviles ingresados aún';
                        }
                    }
                } else {
                    $result['exception'] = 'Marca incorrecta';
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
            case 'readAll6':
                if ($result['dataset'] = $automoviles->readAll6()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay detalles ingresados aún';
                    }
                }
                break;
                //Se inicia la accion de buscar un registro
            case 'search':
                $_POST = $automoviles->validateForm($_POST);
                if ($_POST['search'] != '') {
                    if ($result['dataset'] = $automoviles->searchRows($_POST['search'])) {
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
                //Se inicia la accion de crear un registro
                //print_r($_POST);
                $_POST = $automoviles->validateForm($_POST);
                if (isset($_POST['marca'])) {
                    if ($automoviles->setMarca($_POST['marca'])) {
                        if (isset($_POST['modelo'])) {
                            if ($automoviles->setModelo($_POST['modelo'])) {
                                if ($automoviles->setColor($_POST['color'])) {
                                    if ($automoviles->setMotor($_POST['motor'])) {
                                        if (isset($_POST['clase'])) {
                                            if ($automoviles->setClase($_POST['clase'])) {
                                                if ($automoviles->setPlaca($_POST['placa'])) {
                                                    if (isset($_POST['cliente'])) {
                                                        if ($automoviles->setCliente($_POST['cliente'])) {
                                                            if ($automoviles->createRow()) {
                                                                $result['status'] = 1;
                                                                $result['message'] = 'Automovil registrado correctamente';
                                                            } else {
                                                                $result['exception'] = Database::getException();
                                                            }
                                                        } else {
                                                            $result['exception'] = 'Cliente incorrecto';
                                                        }
                                                    } else {
                                                        $result['exception'] = 'Seleccione un cliente';
                                                    }
                                                } else {
                                                    $result['exception'] = 'Placa incorrecta';
                                                }
                                            } else {
                                                $result['exception'] = 'Clase incorrecta';
                                            }
                                        } else {
                                            $result['exception'] = 'Seleccione una clase';
                                        }
                                    } else {
                                        $result['exception'] = 'Motor incorrecto';
                                    }
                                } else {
                                    $result['exception'] = 'Color incorrecto';
                                }
                            } else {
                                $result['exception'] = 'Modelo incorrecto';
                            }
                        } else {
                            $result['exception'] = 'Seleccione un modelo';
                        }
                    } else {
                        $result['exception'] = 'Marca incorrecta';
                    }
                } else {
                    $result['exception'] = 'Seleccione una marca';
                }
                break;
                //Se inicia la accion de leer un registro
            case 'readOne':
                if ($automoviles->setId($_POST['id_automovil'])) {
                    if ($result['dataset'] = $automoviles->readOne()) {
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
                //Se inicia la accion de actualizar un registro
            case 'update':
                $_POST = $automoviles->validateForm($_POST);
                if ($automoviles->setId($_POST['id_automovil'])) {
                    if ($data = $automoviles->readOne()) {
                        if (isset($_POST['marca'])) {
                            if ($automoviles->setMarca($_POST['marca'])) {
                                if (isset($_POST['modelo'])) {
                                    if ($automoviles->setModelo($_POST['modelo'])) {
                                        if ($automoviles->setColor($_POST['color'])) {
                                            if ($automoviles->setMotor($_POST['motor'])) {
                                                if (isset($_POST['clase'])) {
                                                    if ($automoviles->setClase($_POST['clase'])) {
                                                        if ($automoviles->setPlaca($_POST['placa'])) {
                                                            if (isset($_POST['cliente'])) {
                                                                if ($automoviles->setCliente($_POST['cliente'])) {
                                                                    if ($automoviles->updateRow()) {
                                                                        $result['status'] = 1;
                                                                        $result['message'] = 'Automovil actualizado correctamente';
                                                                    } else {
                                                                        $result['exception'] = Database::getException();
                                                                    }
                                                                } else {
                                                                    $result['exception'] = 'Cliente incorrecto';
                                                                }
                                                            } else {
                                                                $result['exception'] = 'Seleccione un cliente';
                                                            }
                                                        } else {
                                                            $result['exception'] = 'Placa incorrecta';
                                                        }
                                                    } else {
                                                        $result['exception'] = 'Clase incorrecta';
                                                    }
                                                } else {
                                                    $result['exception'] = 'Seleccione una clase';
                                                }
                                            } else {
                                                $result['exception'] = 'Motor incorrecto';
                                            }
                                        } else {
                                            $result['exception'] = 'Color incorrecto';
                                        }
                                    } else {
                                        $result['exception'] = 'Modelo incorrecto';
                                    }
                                } else {
                                    $result['exception'] = 'Seleccione un modelo';
                                }
                            } else {
                                $result['exception'] = 'Marca incorrecta';
                            }
                        } else {
                            $result['exception'] = 'Seleccione una marca';
                        }
                    } else {
                    }
                } else {
                }
                break;
                //Se inicia la accion de eliminar un registro
            case 'delete':
                $_POST = $automoviles->validateForm($_POST);
                if ($automoviles->setId($_POST['id_automovil'])) {
                    if ($data = $automoviles->readOne()) {
                        if ($automoviles->deleteRow()) {
                            $result['status'] = 1;
                            $result['message'] = 'Automovil eliminado correctamente';
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Automovil inexistente';
                    }
                } else {
                    $result['exception'] = 'Automovil incorrecto';
                }
                break;
            case 'cantidadAutoCliente':
                if ($result['dataset'] = $automoviles->clientesConMasAutomovil()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay datos disponibles';
                    }
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
