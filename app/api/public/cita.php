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
    if (isset($_SESSION['id_cliente'])) {
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
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
                if ($automoviles->setMarca($_GET['marca'])) {
                    if ($result['dataset'] = $citas->readAll3()) {
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
                if ($result['dataset'] = $citas->readAll4()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay clases ingresados aún';
                    }
                }
            case 'create':
                //print_r($_POST);
                $_POST = $citas->validateForm($_POST);
                if ($citas->setFecha($_POST['fecha'])) {
                    if (isset($_POST['hora'])) {
                        if ($citas->setHora($_POST['hora'])) {
                            if ($citas->setEstado(1)) {
                                if ($citas->setRazon($_POST['razon'])) {
                                    if ($citas->createRow()) {
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
                    break;
                    $result['exception'] = 'Acción no disponible fuera de la sesión';
                }
        }
    } else {
        // Se compara la acción a realizar cuando un cliente no ha iniciado sesión.
        switch ($_GET['action']) {
            case 'create':
                $result['exception'] = 'Debe iniciar sesión para programar una cita';
                break;
            default:
                $result['exception'] = 'Acción no disponible fuera de la sesión';
        }
    }
    // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
    header('content-type: application/json; charset=utf-8');
    // Se imprime el resultado en formato JSON y se retorna al controlador.
    print(json_encode($result));
} else {
    print(json_encode('Recurso no disponible'));
}
