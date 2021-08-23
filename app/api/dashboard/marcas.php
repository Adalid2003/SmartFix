<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/marcas.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if(isset($_GET['action'])){
    //Se crea una sesion actual o se reanuda la actual
    session_start();
    //se instancia la clase corespondiente
    $marca = new Marcas;
    //Se declara e inicializa un arreglo para guardar el resultado
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    //se verifica si existe una sesion como admin
    if(isset($_SESSION['id_usuario'])){
        //se compara la accion a realizar
        switch ($_GET['action']){
        //Se ejecuta la accion readAll para leer todos los datos y llenar la tabla
            case 'readAll':
                if($result['dataset'] = $marca->readAll()){
                    $result['status'] = 1;
                } else {
                    if(Database::getException()){
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay marcas ingresadas aún';
                    }
                }
                break;
            //se inicia la accion de buscar un registro
            case 'search':
                $_POST = $marca->validateForm($_POST);
                if ($_POST['search'] != ''){
                    if($result['dataset'] = $marca->searchRows($_POST['search'])){
                        $result['status'] = 1;
                        $rows = count($result['dataset']);
                        if ($rows > 1){
                            $result['message'] = 'Se ha encontrado ' . $rows . ' coincidencias';
                        } else {
                            $result['message'] = 'Solo se ha encontrado una coincidencia';
                        }
                    } else {
                        if (Database::getException()){
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
                //se crea un registro
                $_POST = $marca->validateForm($_POST);
                if (isset($_POST['marca'])){
                    if ($marca->setMarca($_POST['marca'])){
                        if ($marca->createRow()) {
                            $result['status'] = 1;
                            $result['message'] = 'Marca registrada correctamente';
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Marca incorrecta';
                    }
                } else {
                    $result['exception'] = 'Seleccione una marca';
                }
                break;
            //se inicia la accion de leer registro
            case 'readOne':
                if ($marca->setId($_POST['id_marca'])){
                    if ($result['dataset'] = $marca->readOne()){
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Esta marca no existe en el sistema';
                        }
                    }
                } else {
                    $result['exception'] = 'la marca es incorrecta';
                }
                break;
            //Actualizar la marca
            case 'update':
                $_POST = $marca->validateForm($_POST);
                if ($marca->setId($_POST['id_marca'])){
                    if (isset($_POST['marca'])){
                        if ($marca->setMarca($_POST['marca'])){
                            if ($marca->updateRow()) {
                                $result['status'] = 1;
                                $result['message'] = 'Marca registrada correctamente';
                            } else {
                                $result['exception'] = Database::getException();
                            }
                        } else {
                            $result['exception'] = 'Marca incorrecta';
                        }
                    } else {
                        $result['exception'] = 'Seleccione una marca';
                    }
                }
                break;
            //Eliminar registro
            case 'delete':
                $_POST = $marca->validateForm($_POST);
                if ($marca->setId($_POST['id_marca'])) {
                    if ($data = $marca->readOne()) {
                        if ($marca->deleteRow()) {
                            $result['status'] = 1;
                            $result['message'] = 'Marca eliminada correctamente';
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Marca inexistente';
                    }
                } else {
                    $result['exception'] = 'Marca incorrecto';
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