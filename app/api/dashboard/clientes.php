<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/clientes.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $cliente = new Clientes;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'error' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (isset($_SESSION['id_usuario'])) {
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
                //Se ejecuta la accion readAll para leer los datos y llenar la tabla
            case 'readAll':
                if ($result['dataset'] = $cliente->readAll()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay clientes registrados';
                    }
                }
                break;
                //Se ejecuta la accion de crear un registro
            case 'create':
                $_POST = $cliente->validateForm($_POST);
                if ($cliente->setNombres($_POST['nombres_cliente'])) {
                    if ($cliente->setApellidos($_POST['apellidos_cliente'])) {
                        if ($cliente->setEmail($_POST['correo_cliente'])) {
                            if ($cliente->setAlias($_POST['alias'])) {
                                if ($cliente->setDUI($_POST['dui_cliente'])) {
                                    if ($cliente->setTelefono($_POST['telefono_cliente'])) {
                                        if (isset($_POST['cb_genero'])) {
                                            if ($cliente->setGenero($_POST['cb_genero'])) {
                                                if ($cliente->setNacimineto($_POST['nacimiento_cliente'])) {
                                                    if ($_POST['clave_cliente'] == $_POST['confirmar_clave']) {
                                                        if ($cliente->setPassword($_POST['clave_cliente'])) {
                                                            if ($cliente->createRow()) {
                                                                $result['status'] = 1;
                                                                $result['message'] = 'Cliente creado correctamente';
                                                            } else {
                                                                $result['exception'] = Database::getException();
                                                            }
                                                        } else {
                                                            $result['exception'] = $cliente->getPasswordError();
                                                        }
                                                    } else {
                                                        $result['exception'] = 'Claves diferentes';
                                                    }
                                                } else {
                                                    $result['exception'] = 'Fecha de nacimiento incorrecta';
                                                }
                                            } else {
                                                $result['exception'] = 'Valor incorrecto.';
                                            }
                                            
                                        } else {
                                            $result['exception'] = 'Por favor seleccione un género.';
                                        }
                                        
                                    } else {
                                        $result['exception'] = 'Teléfono incorrecto';
                                    }
                                } else {
                                    $result['exception'] = 'DUI incorrecto';
                                }
                            } else {
                                $result['exception'] = 'Correo incorrecto';
                            }
                        } else {
                            $result['exception'] = 'Apellidos incorrectos';
                        }
                    } else {
                        $result['exception'] = 'Nombres incorrectos';
                    }
                } else {
                }
                break;
            case 'search':
                $_POST = $cliente->validateForm($_POST);
                if ($_POST['search'] != '') {
                    if ($result['dataset'] = $cliente->searchRows($_POST['search'])) {
                        $result['status'] = 1;
                        $rows = count($result['dataset']);
                        if ($rows > 1) {
                            $result['message'] = 'Se encontraron ' . $rows . ' coincidencias';
                        } else {
                            $result['message'] = 'Solo existe una coincidencia';
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
            case 'readOne':
                if ($cliente->setId($_POST['id_cliente'])) {
                    if ($result['dataset'] = $cliente->readOne()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Cliente inexistente';
                        }
                    }
                } else {
                    $result['exception'] = 'Cliente incorrecto';
                }
                break;
            case 'update':
                $_POST = $cliente->validateForm($_POST);
                if ($cliente->setId($_POST['id_cliente'])) {
                    if ($cliente->readOne()) {
                        if ($cliente->setNombres($_POST['nombres_cliente'])) {
                            if ($cliente->setApellidos($_POST['apellidos_cliente'])) {
                                if ($cliente->setEmail($_POST['correo_cliente'])) {
                                    if ($cliente->setDUI($_POST['dui_cliente'])) {
                                        if (isset($_POST['cb_genero'])) {
                                            if ($cliente->setGenero($_POST['cb_genero'])) {
                                                if ($cliente->setTelefono($_POST['telefono_cliente'])) {
                                                    if ($cliente->setNacimineto($_POST['nacimiento_cliente'])) {
                                                        if ($cliente->updateRow()) {
                                                            $result['status'] = 1;
                                                            $result['message'] = 'Cliente actualizado correctamente';
                                                        } else {
                                                            $result['exception'] = Database::getException();
                                                        }
                                                    } else {
                                                        $result['exception'] = $cliente->getPasswordError();
                                                    }
                                                } else {
                                                    $result['exception'] = 'Claves diferentes';
                                                }
                                            } else {
                                                $result['exception'] = 'Valor incorrecto';
                                            }
                                        } else {
                                            $result['exception'] = 'Por favor seleccione un género.';
                                        }
                                        
                                    } else {
                                        $result['exception'] = 'Fecha de nacimiento incorrecta';
                                    }
                                } else {
                                    $result['exception'] = 'Teléfono incorrecto';
                                }
                            } else {
                                $result['exception'] = 'DUI incorrecto';
                            }
                        } else {
                            $result['exception'] = 'Correo incorrecto';
                        }
                    } else {
                        $result['exception'] = 'Apellidos incorrectos';
                    }
                } else {
                    $result['exception'] = 'Nombres incorrectos';
                }
                break;
            case 'delete':
                if ($cliente->setId($_POST['id_cliente'])) {
                    if ($cliente->readOne()) {
                        if ($cliente->deleteRow()) {
                            $result['status'] = 1;
                            $result['message'] = 'Cliente eliminado correctamente';
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Cliente inexistente';
                    }
                } else {
                    $result['exception'] = 'Cliente incorrecto';
                }
                break;
            case 'cantidadCitasCliente':
                if ($cliente->setId($_POST['id_cliente'])) {
                    if ($result['dataset'] = $cliente->cantidadCitasCliente()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'No hay datos disponibles';
                        }
                    }
                }else{
                    $result['exception'] = 'Cliente incorrecto';
                }
                break;
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
