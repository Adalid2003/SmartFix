<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/usuarios.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $usuario = new Usuarios;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'error' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (isset($_SESSION['id_usuario'])) {
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            //Se ejecuta la accion para cerrar sesión
            case 'logOut':
                if (session_destroy()) {
                    $result['status'] = 1;
                    $result['message'] = 'Sesión eliminada correctamente';
                } else {
                    $result['exception'] = 'Ocurrió un problema al cerrar la sesión';
                }
                break;
                //Se ejecuta la accion de leer el perfil del usuario
            case 'readProfile':
                if ($result['dataset'] = $usuario->readProfile()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'Usuario inexistente';
                    }
                }
                break;
                //Se ejecuta la accion de actualizar el perfil
            case 'editProfile':
                $_POST = $usuario->validateForm($_POST);
                if ($usuario->setNombres($_POST['nombres_perfil'])) {
                    if ($usuario->setApellidos($_POST['apellidos_perfil'])) {
                        if ($usuario->setCorreo($_POST['correo_perfil'])) {
                            if ($usuario->setAlias($_POST['alias_perfil'])) {
                                if ($usuario->editProfile()) {
                                    $result['status'] = 1;
                                    $_SESSION['alias_usuario'] = $usuario->getAlias();
                                    $result['message'] = 'Perfil modificado correctamente';
                                } else {
                                    $result['exception'] = Database::getException();
                                }
                            } else {
                                $result['exception'] = 'Alias incorrecto';
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
                //Se ejecuta la accion de cambiar contraseña
            case 'changePassword':
                if ($usuario->setId($_SESSION['id_usuario'])) {
                    $_POST = $usuario->validateForm($_POST);
                    if ($usuario->checkPassword($_POST['clave_actual'])) {
                        if ($_POST['clave_nueva_1'] == $_POST['clave_nueva_2']) {
                            if ($usuario->setClave($_POST['clave_nueva_1'])) {
                                if ($usuario->changePassword()) {
                                    $result['status'] = 1;
                                    $result['message'] = 'Contraseña cambiada correctamente';
                                } else {
                                    $result['exception'] = Database::getException();
                                }
                            } else {
                                $result['exception'] = $usuario->getPasswordError();
                            }
                        } else {
                            $result['exception'] = 'Claves nuevas diferentes';
                        }
                    } else {
                        $result['exception'] = 'Clave actual incorrecta';
                    }
                } else {
                    $result['exception'] = 'Usuario incorrecto';
                }
                break;
                //Se ejecuta la accion readAll para leer los datos y llenar la tabla
            case 'readAll':
                if ($result['dataset'] = $usuario->readAll()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay usuarios registrados';
                    }
                }
                break;
                //Se ejecuta la accion para llenar el combobox
            case 'readAll2':
                if ($result['dataset'] = $usuario->readAll2()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay tipos de usuario registrados';
                    }
                }
                break;
            case 'readAllEsp':
                if ($result['dataset'] = $usuario->readAllEsp()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay tipos de usuario registrados';
                    }
                }
                break;
                //Se ejecuta la accion de buscar un registro
            case 'search':
                $_POST = $usuario->validateForm($_POST);
                if ($_POST['search'] != '') {
                    if ($result['dataset'] = $usuario->searchRows($_POST['search'])) {
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
            case 'create':
                $_POST = $usuario->validateForm($_POST);
                //print_r($_POST);
                if ($usuario->setNombres($_POST['nombres'])) {
                    if ($usuario->setApellidos($_POST['apellidos'])) {
                        if ($usuario->setCorreo($_POST['correo'])) {
                            if ($usuario->setAlias($_POST['alias'])) {
                                if ($_POST['clave1'] == $_POST['clave2']) {
                                    if ($usuario->setClave($_POST['clave1'])) {
                                        if (isset($_POST['tipo_usuario'])) {
                                            if ($usuario->setTipo($_POST['tipo_usuario'])) {
                                                if ($usuario->setNacimineto($_POST['fecha_nacimiento'])) {
                                                    if ($usuario->setTelefono($_POST['telefono'])) {
                                                        if ($usuario->setSueldo($_POST['sueldo'])) {
                                                            if ($usuario->setEstado(isset($_POST['estado_usuario']) ? 1 : 0)) {
                                                                if (isset($_POST['especialidad'])) {
                                                                    if ($usuario->setEspecialidad($_POST['especialidad'])) {
                                                                        if ($usuario->setDUI($_POST['dui_u'])) {
                                                                            if ($usuario->createRow()) {
                                                                                $result['status'] = 1;
                                                                                $result['message'] = 'Usuario registrado correctamente';
                                                                            } else {
                                                                                $result['exception'] = Database::getException();
                                                                            }
                                                                        } else {
                                                                            $result['exception'] = 'DUI incorrecto';
                                                                        }
                                                                    } else {
                                                                        $result['exception'] = 'Especialidad incorrecta';
                                                                    }
                                                                } else {
                                                                    $result['exception'] = 'Seleccione una especialidad';
                                                                }
                                                            } else {
                                                                $result['exception'] = 'Estado incorrecto';
                                                            }
                                                        } else {
                                                            $result['exception'] = 'Sueldo incorrecto';
                                                        }
                                                    } else {
                                                        $result['exception'] = 'Telefono incorrecto';
                                                    }
                                                } else {
                                                    $result['exception'] = 'Fecha de nacimiento incorrecta';
                                                }
                                            } else {
                                                $result['exception'] = 'Tipo de usuario incorrecto';
                                            }
                                        } else {
                                            $result['exception'] = 'Seleccione un tipo de usuario';
                                        }
                                    } else {
                                        $result['exception'] = $usuario->getPasswordError();
                                    }
                                } else {
                                    $result['exception'] = 'Las contraseñas no coinciden';
                                }
                            } else {
                                $result['exception'] = 'Alias incorrecto';
                            }
                        } else {
                            $result['exception'] = 'Correo incorrecto';
                        }
                    } else {
                        $result['exception'] = 'Apellidos incorrectos';
                    }
                } else {
                    $result['exception'] = 'Nombre incorrecto';
                }
                break;
            case 'readOne':
                if ($usuario->setId($_POST['id_usuario'])) {
                    if ($result['dataset'] = $usuario->readOne()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Usuario inexistente';
                        }
                    }
                } else {
                    $result['exception'] = 'Usuario incorrecto';
                }
                break;
            case 'update':
                $_POST = $usuario->validateForm($_POST);
                if ($usuario->setId($_POST['id_usuario'])) {
                    if ($data = $usuario->readOne()) {
                        if ($usuario->setNombres($_POST['nombres'])) {
                            if ($usuario->setApellidos($_POST['apellidos'])) {
                                if ($usuario->setCorreo($_POST['correo'])) {
                                    if (isset($_POST['tipo_usuario'])) {
                                        if ($usuario->setTipo($_POST['tipo_usuario'])) {
                                            if ($usuario->setNacimineto($_POST['fecha_nacimiento'])) {
                                                if ($usuario->setTelefono($_POST['telefono'])) {
                                                    if ($usuario->setSueldo($_POST['sueldo'])) {
                                                        if ($usuario->setEstado(isset($_POST['estado_usuario']) ? 1 : 0)) {
                                                            if (isset($_POST['especialidad'])) {
                                                                if ($usuario->setEspecialidad($_POST['especialidad'])) {
                                                                    if ($usuario->setDUI($_POST['dui_u'])) {
                                                                        if ($usuario->updateRow()) {
                                                                            $result['status'] = 1;
                                                                            $result['message'] = 'Usuario actualizado correctamente';
                                                                        } else {
                                                                            $result['exception'] = Database::getException();
                                                                        }
                                                                    } else {
                                                                        $result['exception'] = 'DUI incorrecto';
                                                                    }
                                                                } else {
                                                                    $result['exception'] = 'Especialidad incorrecta';
                                                                }
                                                            } else {
                                                                $result['exception'] = 'Seleccione una especialidad';
                                                            }
                                                        } else {
                                                            $result['exception'] = 'Estado incorrecto';
                                                        }
                                                    } else {
                                                        $result['exception'] = 'Sueldo incorrecto';
                                                    }
                                                } else {
                                                    $result['exception'] = 'Telefono incorrectos';
                                                }
                                            } else {
                                                $result['exception'] = 'Fecha de nacimineto incorrecta';
                                            }
                                        } else {
                                            $result['exception'] = 'Tipo de usuario incorrecto';
                                        }
                                    } else {
                                        $result['exception'] = 'Seleccione un tipo de usuario';
                                    }
                                } else {
                                    $result['exception'] = 'Correo incorrecto';
                                }
                            } else {
                                $result['exception'] = 'Apellido incorrecto';
                            }
                        } else {
                            $result['exception'] = 'Nombre incorrecto';
                        }
                    } else {
                        $result['exception'] = 'El usuario no existe';
                    }
                } else {
                    $result['exception'] = 'El usuario es incorrecto';
                }
                break;
            case 'delete':
                if ($_POST['id_usuario'] != $_SESSION['id_usuario']) {
                    if ($usuario->setId($_POST['id_usuario'])) {
                        if ($usuario->readOne()) {
                            if ($usuario->deleteRow()) {
                                $result['status'] = 1;
                                $result['message'] = 'Usuario eliminado correctamente';
                            } else {
                                $result['exception'] = Database::getException();
                            }
                        } else {
                            $result['exception'] = 'Usuario inexistente';
                        }
                    } else {
                        $result['exception'] = 'Usuario incorrecto';
                    }
                } else {
                    $result['exception'] = 'No se puede eliminar a sí mismo';
                }
                break;
            default:
                $result['exception'] = 'Acción no disponible dentro de la sesión';
        }
    } else {
        // Se compara la acción a realizar cuando el administrador no ha iniciado sesión.
        switch ($_GET['action']) {
            case 'readAll':
                if ($usuario->readAll()) {
                    $result['status'] = 1;
                    $result['message'] = 'Existe al menos un usuario registrado';
                } else {
                    if (Database::getException()) {
                        $result['error'] = 1;
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No existen usuarios registrados';
                    }
                }
                break;
            case 'readAllEsp':
                if ($result['dataset'] = $usuario->readAllEsp()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay tipos de usuario registrados';
                    }
                }
                break;
            case 'register':
                $_POST = $usuario->validateForm($_POST);
                //print_r($_POST);
                if ($usuario->setNombres($_POST['nombres'])) {
                    if ($usuario->setApellidos($_POST['apellidos'])) {
                        if ($usuario->setCorreo($_POST['correo'])) {
                            if ($usuario->setAlias($_POST['alias'])) {
                                if ($_POST['clave1'] == $_POST['clave2']) {
                                    if ($usuario->setClave($_POST['clave1'])) {
                                        if ($usuario->setTipo(1)) {
                                            if ($usuario->setNacimineto($_POST['fecha_nacimiento'])) {
                                                if ($usuario->setTelefono($_POST['telefono'])) {
                                                    if ($usuario->setSueldo($_POST['sueldo'])) {
                                                        if ($usuario->setEstado(isset($_POST['estado_usuario']) ? 1 : 0)) {
                                                            if (isset($_POST['especialidad'])) {
                                                                if ($usuario->setEspecialidad($_POST['especialidad'])) {
                                                                    if ($usuario->setDUI($_POST['dui_u'])) {
                                                                        if ($usuario->createRow()) {
                                                                            $result['status'] = 1;
                                                                            $result['message'] = 'Usuario registrado correctamente';
                                                                        } else {
                                                                            $result['exception'] = Database::getException();
                                                                        }
                                                                    } else {
                                                                        $result['exception'] = 'DUI incorrecto';
                                                                    }
                                                                } else {
                                                                    $result['exception'] = 'Especialidad incorrecta';
                                                                }
                                                            } else {
                                                                $result['exception'] = 'Seleccione una especialidad';
                                                            }
                                                        } else {
                                                            $result['exception'] = 'Estado incorrecto';
                                                        }
                                                    } else {
                                                        $result['exception'] = 'Sueldo incorrecto';
                                                    }
                                                } else {
                                                    $result['exception'] = 'Telefono incorrecto';
                                                }
                                            } else {
                                                $result['exception'] = 'Fecha de nacimiento incorrecta';
                                            }
                                        } else {
                                            $result['exception'] = 'Tipo de usuario incorrecto';
                                        }
                                    } else {
                                        $result['exception'] = $usuario->getPasswordError();
                                    }
                                } else {
                                    $result['exception'] = 'Las contraseñas no coinciden';
                                }
                            } else {
                                $result['exception'] = 'Alias incorrecto';
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
            case 'logIn':
                $_POST = $usuario->validateForm($_POST);
                if ($usuario->checkUser($_POST['alias'])) {
                    if ($usuario->getEstado()) {
                    if ($usuario->checkPassword($_POST['clave'])) {
                        $result['status'] = 1;
                        $result['message'] = 'Autenticación correcta';
                        $_SESSION['id_usuario'] = $usuario->getId();
                        $_SESSION['alias_u'] = $usuario->getAlias();
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Clave incorrecta';
                        }
                    }
                } else{
                    $result['exception'] = 'La cuenta ha sido desactivada';
                }
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'Alias incorrecto';
                    }
                }
            
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
