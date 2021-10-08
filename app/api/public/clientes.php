<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/clientes.php');



if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $cliente = new Clientes;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'recaptcha' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como cliente para realizar las acciones correspondientes.
    if (isset($_SESSION['id_cliente'])) {
        // Se compara la acción a realizar cuando un cliente ha iniciado sesión.
        switch ($_GET['action']) {

            case 'logOut':
                if (session_destroy()) {
                    $result['status'] = 1;
                    $result['message'] = 'Sesión eliminada correctamente';
                } else {
                    $result['exception'] = 'Ocurrió un problema al cerrar la sesión';
                }
                break;
            case 'readHistorial':
                if ($result['dataset'] = $cliente->readHistorial()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'Usted no tiene sesiones iniciadas.';
                    }
                }
                break;
            default:
                $result['exception'] = 'Acción no disponible dentro de la sesión';
        }
    } else {
        // Se compara la acción a realizar cuando el cliente no ha iniciado sesión.
        switch ($_GET['action']) {
            case 'register':
                $_POST = $cliente->validateForm($_POST);
                //print_r($_POST);
                // Se sanea el valor del token para evitar datos maliciosos.
                $token = filter_input(INPUT_POST, 'g-recaptcha-response', FILTER_SANITIZE_STRING);
                if ($token) {
                    $secretKey = '6LdBzLQUAAAAAL6oP4xpgMao-SmEkmRCpoLBLri-';
                    $ip = $_SERVER['REMOTE_ADDR'];

                    $data = array(
                        'secret' => $secretKey,
                        'response' => $token,
                        'remoteip' => $ip
                    );

                    $options = array(
                        'http' => array(
                            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                            'method'  => 'POST',
                            'content' => http_build_query($data)
                        ),
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false
                        )
                    );

                    $url = 'https://www.google.com/recaptcha/api/siteverify';
                    $context  = stream_context_create($options);
                    $response = file_get_contents($url, false, $context);
                    $captcha = json_decode($response, true);

                    if ($captcha['success']) {
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
                                                                    if ($cliente->setDoble(1)) {
                                                                    if ($cliente->createRow()) {
                                                                        $result['status'] = 1;
                                                                        $result['message'] = 'Cliente registrado correctamente';
                                                                    } else {
                                                                        $result['exception'] = Database::getException();
                                                                    }
                                                                }else{
                                                                    $result['exception'] = 'Verificación invalida';
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
                                                        $result['exception'] = 'dato invalido';
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
                            $result['exception'] = 'Error de ReCaptcha, por favor recargue la pagina.';
                        }
                    }
                }
                break;
            case 'sendCode':
                $_SESSION['codigo_email'] = random_int(100, 999999);
                try {

                    ///Load Composer's autoloader
                    require '../../libraries/phpmailer52/class.phpmailer.php';
                    require '../../libraries/phpmailer52/class.smtp.php';
                    require '../../libraries/phpmailer52/class.phpmaileroauthgoogle.php';

                    //Create an instance; passing `true` enables exceptions
                    $mail = new PHPMailer(true);
                    $mail->CharSet = 'UTF-8';
                    $mail->setLanguage("es");
                    //Ajustes del servidor
                    $mail->SMTPDebug = 0;
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'recuperacionsmartfix@gmail.com';
                    $mail->Password   = 'smartfix123';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port       = 587;

                    //Receptores
                    $mail->setFrom('recuperacionsmartfix@gmail.com', 'Soporte SmartFix');
                    $mail->addAddress($_SESSION['email_c']);

                    //Contenido
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Codigo de Verificación para inicio de sesión';
                    $mail->Body    = 'Tu código de verificación para iniciar sesión es: <b>' . $_SESSION['codigo_email'] . '</b>.';
                    $mail->AltBody = 'Tu código de verificación para iniciar sesión es: ' . $_SESSION['codigo_email'] . '.';

                    if ($mail->send()) {
                        $result['status'] = 1;
                        $result['message'] = 'Se ha enviado un código de recuperación de contraseña a su correo.';
                    }
                } catch (Exception $e) {
                    $result['exception'] = $mail->ErrorInfo;
                }
                break;
            case 'checkCode':
                $_POST = $cliente->validateForm($_POST);
                if ($_POST['codigo'] == $_SESSION['codigo_email']) {
                    unset($_SESSION['codigo_mail']);
                    $_SESSION['id_cliente'] = $_SESSION['id_cliente_temp'];
                    unset($_SESSION['id_cliente_temp']);
                    $result['status'] = 1;
                    $result['message'] = 'Sesión iniciada correctamente.';
                    $cliente->createHistorial();
                } else {
                    $result['exception'] = 'El código ingresado es incorrecto.';
                }

                break;
            case 'logIn':
                $_POST = $cliente->validateForm($_POST);
                if ($cliente->checkClient($_POST['usuario'])) {
                    if ($cliente->getEstado()) {
                        if ($cliente->checkPassword($_POST['clave'])) {
                            if ($cliente->resetAttempts()) {
                                if ($cliente->checkIfPasswordHas90Days()) {
                                    $_SESSION['id_tmp'] = $cliente->getId();
                                    $_SESSION['email_c'] = $cliente->getCorreo();
                                    $result['error'] = 1;
                                } else {
                                    if (Database::getException()) {
                                        $result['exception'] = Database::getException();
                                    } else {
                                        if ($data = $cliente->checkAuth()) {
                                            if ($data['doble'] == 1) {
                                                $_SESSION['id_cliente_temp'] = $cliente->getId();
                                                $_SESSION['email_c'] = $cliente->getCorreo();
                                                unset($_SESSION['id_cliente']);
                                                $result['status'] = 1;
                                                $result['auth'] = 1;
                                                $result['message'] = 'Por su seguridad, se ha enviado un código para que pueda iniciar sesión de una forma segura';
                                            } else {
                                                $result['status'] = 1;
                                                $result['message'] = 'Autenticación correcta';
                                                $cliente->createHistorial();
                                            }
                                        } else {
                                           if (Database::getException()) {
                                               $result['exception'] = Database::getException();
                                           } else {
                                               $result['exception'] = 'Por alguna razón usted no posee ninguna preferencia.';
                                           }
                                        }
                                    } 
                                    
                                }
                            } else {
                                $result['exception'] = Database::getException();
                            }
                        } else {
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                if ($cliente->increaseAttempt()) {
                                    if ($intentos = $cliente->getAttempts()) {
                                        if ($intentos['intentos'] >= 3) {
                                            if ($cliente->updateStateToFalse()) {
                                                $result['exception'] = 'Usuario bloqueado por intentos excedidos. Contacte con su administrador.';
                                            } else {
                                                $result['exception'] = Database::getException();
                                            }
                                        } else {
                                            $result['exception'] = 'Clave incorrecta.';
                                        }
                                    } else {
                                        if (Database::getException()) {
                                            $result['exception'] = Database::getException();
                                        } else {
                                            $result['exception'] = 'No se han podido obtener los intentos de este usuario.';
                                        }
                                    }
                                } else {
                                    $result['exception'] = Database::getException();
                                }
                            }
                        }
                    } else {
                        $result['exception'] = 'Su cuenta ha sido inhabilitada.';
                    }
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'Alias incorrecto';
                    }
                }
                break;
            case 'changePassword90Days':
                $_POST = $cliente->validateForm($_POST);
                if ($cliente->setPassword($_POST['txtNuevaContraseña'])) {
                    if ($_POST['txtNuevaContraseña'] == $_POST['txtConfirmarContraseña']) {
                        $_SESSION['id_cliente'] = $_SESSION['id_tmp'];
                        if ($cliente->changePassword()) {
                            if ($cliente->setNewPassword90Days()) {
                                $result['status'] = 1;
                                $result['message'] = 'Contraseña actualizada. Sesión iniciada correctamente.';
                            } else {
                                $result['exception'] = Database::getException();
                            }
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Las contraseñas no coinciden.';
                    }
                } else {
                    $result['exception'] = 'Su contraseña no cumple con los requisitos.';
                }
                break;
            case 'changePassword':
                if ($cliente->setId($_SESSION['id_cliente_tmp'])) {
                    $_POST = $cliente->validateForm($_POST);
                    if ($cliente->checkPassword($_POST['clave_actual'])) {
                        if (
                            $_POST['clave_actual'] == $_POST['clave_nueva_1'] ||
                            $_POST['clave_actual'] == $_POST['clave_nueva_2']
                        ) {
                            $result['exception'] = 'Su clave no puede ser igual que la anterior.';
                        } else {
                            if ($_POST['clave_nueva_1'] == $_POST['clave_nueva_2']) {
                                if ($cliente->setPassword($_POST['clave_nueva_1'])) {
                                    if ($cliente->changePasswordOut()) {
                                        $result['status'] = 1;
                                        $result['message'] = 'Contraseña cambiada correctamente';
                                        unset($_SESSION['id_cliente_tmp']);
                                        $_SESSION['id_cliente'] = $cliente->getId();
                                        $cliente->actualizarFecha();
                                    } else {
                                        $result['exception'] = Database::getException();
                                    }
                                } else {
                                    $result['exception'] = $cliente->getPasswordError();
                                }
                            } else {
                                $result['exception'] = 'Claves nuevas diferentes';
                            }
                        }
                    } else {
                        $result['exception'] = 'Clave actual incorrecta';
                    }
                } else {
                    $result['exception'] = 'Usuario incorrecto';
                }
                break;
            case 'validateEmail':
                $_POST = $cliente->validateForm($_POST);
                if ($cliente->setEmail($_POST['txtCorreo'])) {
                    if ($correo = $cliente->checkEmail()) {
                        if ($correo['email_c'] == $_POST['txtCorreo']) {
                            $_SESSION['id_cliente_tmp'] = $correo['id_cliente'];
                            $_SESSION['email_c'] = $correo['email_c'];
                            $result['status'] = 1;
                            $result['message'] = 'Correo verificado.';
                        } else {
                            $result['exception'] = 'El correo electrónico ingresado no coincide con su cuenta.';
                        }
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'El correo ingresado no existe en nuestro sistema, por favor verifique su información o vuelva a intentarlo.';
                        }
                    }
                } else {
                    $result['exception'] = 'Id pendiente de ingresar.';
                }
                break;
            case 'sendEmail':
                $_SESSION['codigo_email'] = random_int(100, 999999);
                try {



                    //Load Composer's autoloader
                    require '../../libraries/phpmailer52/class.phpmailer.php';
                    require '../../libraries/phpmailer52/class.smtp.php';
                    require '../../libraries/phpmailer52/class.phpmaileroauthgoogle.php';

                    //Create an instance; passing `true` enables exceptions
                    $mail = new PHPMailer(true);
                    $mail->CharSet = 'UTF-8';
                    $mail->setLanguage("es");
                    //Ajustes del servidor
                    $mail->SMTPDebug = 0;
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'recuperacionsmartfix@gmail.com';
                    $mail->Password   = 'smartfix123';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port       = 587;

                    //Receptores
                    $mail->setFrom('recuperacionsmartfix@gmail.com', 'Soporte SmartFix');
                    $mail->addAddress($_SESSION['email_c']);

                    //Contenido
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Codigo de Verificación';
                    $mail->Body    = 'Tu código de verificación es: <b>' . $_SESSION['codigo_email'] . '</b>.';
                    $mail->AltBody = 'Tu código de verificación es: ' . $_SESSION['codigo_email'] . '.';

                    if ($mail->send()) {
                        $result['status'] = 1;
                        $result['message'] = 'Se ha enviado un código de recuperación de contraseña a su correo.';
                    }
                } catch (Exception $e) {
                    $result['exception'] = $mail->ErrorInfo;
                }
                break;
            case 'validateCode':
                $_POST = $cliente->validateForm($_POST);
                if ($_SESSION['codigo_email'] == $_POST['txtCodigo']) {
                    unset($_SESSION['codigo_email']);
                    $result['status'] = 1;
                    $result['message'] = 'Código verificado correctamente.';
                } else {
                    $result['exception'] = 'El código que usted ha ingresado ya venció o es invalido.';
                }

                break;
            case 'changePasswordOut':
                if ($cliente->setId($_SESSION['id_cliente_tmp'])) {
                    $_POST = $cliente->validateForm($_POST);
                    if ($_POST['clave_nueva_1'] == $_POST['clave_nueva_2']) {
                        if ($cliente->setPassword($_POST['clave_nueva_1'])) {
                            if ($cliente->changePasswordOut()) {
                                $result['status'] = 1;
                                $result['message'] = 'Contraseña cambiada correctamente';
                                unset($_SESSION['id_cliente_tmp']);
                                $cliente->actualizarFecha();
                            } else {
                                $result['exception'] = Database::getException();
                            }
                        } else {
                            $result['exception'] = $cliente->getPasswordError();
                        }
                    } else {
                        $result['exception'] = 'Claves nuevas diferentes';
                    }
                } else {
                    $result['exception'] = 'Usuario incorrecto';
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
