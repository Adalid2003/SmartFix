<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/modelos.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])){
    //Se crea una sesion actual o se reanuda la actual
    session_start();
    //se instancia la clase corespondiente
    $modelo = new Modelos;
    //Se declara e inicializa un arreglo para guardar el resultado
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    //se verifica si existe una sesion como admin
    if (isset($_SESSION['id_usuario'])){
        switch ($_GET['action']) {
            case 'readAll':
                if ($result['dataset'] = $modelo->readAll()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay modelos ingresados aún';
                    }
                }
                break;

                //Se llama la consulta para llenar el combobox
            case 'readAllMar':
                if ($result['dataset'] = $modelo->readAll2()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay marcas ingresadas aún';
                    }
                }
                break;
                
                 //Se inicia la accion de buscar un registro
            case 'search':
                $_POST = $modelo->validateForm($_POST);
                if ($_POST['search'] != '') {
                    if ($result['dataset'] = $modelo->searchRows($_POST['search'])) {
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
                    $_POST = $modelo->validateForm($_POST);
                    if (isset($_POST['modelo'])){
                        if ($modelo->setModelo($_POST['modelo'])){
                            if (isset($_POST['anio'])){
                                if ($modelo->setAnio($$_POST['anio'])){
                                    if (issets($_POST['marca'])){
                                        if ($modelo->setMarca($_POST['marca'])) {
                                            if ($modelo->createRow()) {
                                                $result['status'] = 1;
                                                $result['message'] = 'Modelo registrado correctamente';
                                            } else {
                                                $result['exception'] = Database::getException();
                                            }
                                        }else {
                                            $result['exception'] = 'Marca incorrecta';
                                        }
                                    }else {
                                        $result['exception'] = 'Seleccione un marca';
                                    }
                                } else {
                                    $result['exception'] = 'Año incorrecto';
                                }
                            } else {
                                $result['exception'] = 'Selecione año';
                            }
                        } else {
                            $result['exception'] = 'Modelo incorrecto';
                        }
                    } else {
                        $result['exception'] = 'Seleccione año';
                    }
                    break;
                    //Se inicia la accion de leer un registro
                case 'readOne':
                    if ($modelo->setId($_POST['id_modelo'])) {
                        if ($result['dataset'] = $modelo->readOne()) {
                            $result['status'] = 1;
                        } else {
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'Este modelo no existe';
                            }
                        }
                    } else {
                        $result['exception'] = 'El modelo es incorrecto';
                    }
                    break;

                    case 'update':
                    //Se inicia la accion de crear un registro
                    $_POST = $modelo->validateForm($_POST);
                    if (isset($_POST['modelo'])){
                        if ($modelo->setModelo($_POST['modelo'])){
                            if (isset($_POST['anio'])){
                                if ($modelo->setAnio($$_POST['anio'])){
                                    if (issets($_POST['marca'])){
                                        if ($modelo->setMarca($_POST['marca'])) {
                                            if ($modelo->updateRow()) {
                                                $result['status'] = 1;
                                                $result['message'] = 'Modelo actualizado correctamente';
                                            } else {
                                                $result['exception'] = Database::getException();
                                            }
                                        }else {
                                            $result['exception'] = 'Marca incorrecta';
                                        }
                                    }else {
                                        $result['exception'] = 'Seleccione un marca';
                                    }
                                } else {
                                    $result['exception'] = 'Año incorrecto';
                                }
                            } else {
                                $result['exception'] = 'Selecione año';
                            }
                        } else {
                            $result['exception'] = 'Modelo incorrecto';
                        }
                    } else {
                        $result['exception'] = 'Seleccione año';
                    }
                    break;

                    case 'delete':
                        $_POST = $modelo->validateForm($_POST);
                        if ($modelo->setId($_POST['id_modelo'])) {
                            if ($data = $modelo->readOne()) {
                                if ($modelo->deleteRow()) {
                                    $result['status'] = 1;
                                    $result['message'] = 'Modelo eliminado correctamente';
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
                        default:
                        $result['exception'] = 'Acción no disponible dentro de la sesión';    
        }
        // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
        header('content-type: application/json; charset=utf-8');
        // Se imprime el resultado en formato JSON y se retorna al controlador.
        print(json_encode($result));
    }else {
        print(json_encode('Acceso denegado'));
    }
}else {
    print(json_encode('Recurso no disponible'));
}