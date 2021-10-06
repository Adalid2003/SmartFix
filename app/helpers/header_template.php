<?php

class Public_Page
{

    public static function headerTemplate($title)
    {

        session_start();
        print('<!DOCTYPE html>
        <html lang="es">
        
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>SmartFix - ' . $title . '</title>
            <!-- Compiled and minified CSS -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
            <!--Llamando el css-->
            <link rel="stylesheet" type="text/css" href="../../resource/css/styles.css">
            <!--Apis-->
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <!--Se informa al navegador que el sitio web está optimizado para dispositivos móviles-->
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <link rel="shotcut icon" href="../../resource/img/logo.jpg" type="image/x-icon">
        </head>
        
        <body>');

        // Se obtiene el nombre del archivo de la página web actual.
        $filename = basename($_SERVER['PHP_SELF']);
        // Se comprueba si existe una sesión de cliente para mostrar el menú de opciones, de lo contrario se muestra otro menú.
        if (isset($_SESSION['id_cliente'])) {
            // Se verifica si la página web actual es diferente a login.php y register.php, de lo contrario se direcciona a index.php
            if ($filename != 'login.php' && $filename != 'registrarse.php') {
                print('
                <header>
    <!--Inicio Navbar-->
        <div class="navbar-fixed">
            <nav class="blue-grey darken-4">
                <div class="nav-wrapper">
                    <a href="../../views/public/index.php" class="brand-logo"><img src="../../resource/img/logo.jpg" alt="" weight="100px" height="65px"></a>
                    <a href="#" data-target="mobile-sidenav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                    <!--<a href="../../resource/img/logo.jpg" class="brand-logo"></a>-->
                    <!--Menu en estado de ventana normal-->
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li><a href="../../views/public/nosotros.php">Sobre nosotros</a></li>
                        <li><a href="../../views/public/cita.php">Agendar cita</a></li>
                        <li><a href="../../views/public/cita_cliente.php">Mis citas</a></li>
                        <li><a href="../../views/public/historial.php">Actividad de inicio de sesión</a></li>
                        <li><a href="#" onclick="logOut()"><i class="material-icons left">close</i>Cerrar sesión</a></li>
                    </ul>
                </div>
            </nav>
        </div>
        <!--Navegación lateral para dispositivos móviles-->
        <ul class="sidenav" id="mobile-sidenav">
        <!--Menu Sidevar cuando se hace pequeña la ventana-->
            <li><a href="../../views/public/nosotros.php">Sobre nosotros</a></li>
            <li><a href="../../views/public/cita.php">Agendar cita</a></li>
            <li><a href="#" onclick="logOut()"><i class="material-icons left">close</i>Cerrar sesión</a></li>
        </ul>
    </header>
    <main>');
            } else {
                header('location: index.php');
            }
        } else {
            // Se verifica si la página web actual es diferente a index.php (Iniciar sesión) y a register.php (Crear primer usuario) para direccionar a index.php, de lo contrario se muestra un menú vacío.
            if ($filename != 'prueba.php') {
                print('<header>
                <!--Inicio Navbar-->
                    <div class="navbar-fixed">
                        <nav class="blue-grey darken-4">
                            <div class="nav-wrapper">
                                <a href="../../views/public/index.php" class="brand-logo"><img src="../../resource/img/logo.jpg" alt="" weight="100px" height="65px"></a>
                                <a href="#" data-target="mobile-sidenav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                                <!--<a href="../../resource/img/logo.jpg" class="brand-logo"></a>-->
                                <!--Menu en estado de ventana normal-->
                                <ul id="nav-mobile" class="right hide-on-med-and-down">
                                    <li><a href="../../views/public/nosotros.php">Sobre nosotros</a></li>
                                    <li><a href="../../views/public/cita.php">Agendar cita</a></li>
                                    <li><a href="../../views/public/login.php">Iniciar sesión/Registrarse</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <!--Navegación lateral para dispositivos móviles-->
                    <ul class="sidenav" id="mobile-sidenav">
                    <!--Menu Sidevar cuando se hace pequeña la ventana-->
                        <li><a href="../../views/public/nosotros.php">Sobre nosotros</a></li>
                        <li><a href="../../views/public/cita.php">Agendar cita</a></li>
                        <li><a href="../../views/public/login.php">Iniciar sesión/Registrarse</a></li>
                    </ul>
                </header>
                <main>');
            } else {
                header('location: index.php');
            }
        }
        // Se llama al método que contiene el código de las cajas de dialogo (modals).
        self::modals();
    }

    /*
    *   Método para imprimir la plantilla del pie.
    *
    *   Parámetros: $controller (nombre del archivo que sirve como controlador de la página web).
    *
    *   Retorno: ninguno.
    */
    public static function footerTemplate($controller)
    {
        // Se imprime el código HTML para el pie del documento.
        if (isset($_SESSION['id_cliente'])) {
            $scripts = '
            <script type="text/javascript" src="../../resource/js/materialize.min.js"></script>
            <script type="text/javascript" src="../../resource/js/sweetalert.min.js"></script>
            <script type="text/javascript" src="../../app/helpers/components.js"></script>
            <script type="text/javascript" src="../../app/controllers/dashboard/iniciar.js"></script>
            <script type="text/javascript" src="../../app/controllers/public/account.js"></script>
            <script type="text/javascript" src="../../app/controllers/public/' . $controller . '"></script>';
        } else {
            $scripts = '<script type="text/javascript" src="../../resource/js/materialize.min.js"></script>
            <script type="text/javascript" src="../../resource/js/sweetalert.min.js"></script>
            <script type="text/javascript" src="../../app/helpers/components.js"></script>
            <script type="text/javascript" src="../../app/controllers/dashboard/iniciar.js"></script>
            <script type="text/javascript" src="../../app/controllers/public/' . $controller . '"></script>';
        }
        print('</main>
        <!--Inicio Footer-->
        <footer class="page-footer blue-grey darken-4">
            <div class="container">
                <div class="row">
                <!--Seccion de contacto-->
                    <div class="col l6 s12">
                        <h5 class="white-text">Contactanos</h5>
                        <p class="grey-text text-lighten-4">Contactanos por medio de nuestros medios oficiales</p>
                    </div>
                    <div class="col l4 offset-l2 s12">
                        <h5 class="white-text">Nuestras redes</h5>
                        <ul>
                            <li><a class="grey-text text-lighten-3" href="https://www.facebook.com/smart.fix.357"><i class="material-icons">facebook</i>Facebook</a></li>
                            <li><a class="grey-text text-lighten-3"><i class="material-icons">phone</i>2225-9257</a></li>
                            <li><a href="../../views/dashboard/dashboard.php" class="grey-text text-lighten-3">Dashboard</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--Copyright-->
            <div class="footer-copyright">
                <div class="container">
                    © 2021 SmartFix Derechos reservados
                </div>
            </div>
        </footer>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
      ' . $scripts . '
      </body>
      </html>');
    }

    /*
    *   Método para imprimir las cajas de dialogo (modals).
    */
    private static function modals()
    {
        // Se imprime el código HTML de las cajas de dialogo (modals).
        print('
            <!-- Componente Modal para mostrar los Términos y condiciones -->
            <div id="terminos" class="modal">
                <div class="modal-content">
                    <h4 class="center-align">TÉRMINOS Y CONDICIONES</h4>
                    <p>Nuestra empresa ofrece los mejores productos a nivel nacional con una calidad garantizada y...</p>
                </div>
                <div class="divider"></div>
                <div class="modal-footer">
                    <a href="#!" class="modal-action modal-close btn waves-effect"><i class="material-icons">done</i></a>
                </div>
            </div>

            <!-- Componente Modal para mostrar la Misión -->
            <div id="mision" class="modal">
                <div class="modal-content">
                    <h4 class="center-align">MISIÓN</h4>
                    <p>En NetWorld trabajamos para ofrecer mayoritariamente dispositivos de red, ayudando así a locales de computación, colegios, grandes y pequeñas empresas, a eficientar la conexión entre los dispositivos en cuestión.</p>
                </div>
                <div class="divider"></div>
                <div class="modal-footer">
                    <a href="#!" class="modal-action modal-close btn waves-effect"><i class="material-icons">done</i></a>
                </div>
            </div>

            <!-- Componente Modal para mostrar la Visión -->
            <div id="vision" class="modal">
                <div class="modal-content">
                    <h4 class="center-align">VISIÓN</h4>
                    <p>Ser la compañía líder de habla hispana en proveer productos de red en Latinoamerica.</p>
                </div>
                <div class="divider"></div>
                <div class="modal-footer">
                    <a href="#!" class="modal-action modal-close btn waves-effect"><i class="material-icons">done</i></a>
                </div>
            </div>

            <!-- Componente Modal para mostrar los Valores -->
            <div id="valores" class="modal">
                <div class="modal-content center-align">
                    <h4>VALORES</h4>
                    <p>Responsabilidad</p>
                    <p>Honestidad</p>
                    <p>Seguridad</p>
                    <p>Calidad</p>
                </div>
                <div class="divider"></div>
                <div class="modal-footer">
                    <a href="#!" class="modal-action modal-close btn waves-effect"><i class="material-icons">done</i></a>
                </div>
            </div>
        ');
    }
}
