<?php
/*
*	Clase para definir las plantillas de las páginas web del sitio privado.
*/
class Dashboard_Page
{
    /*
    *   Método para imprimir la plantilla del encabezado.
    *
    *   Parámetros: $title (título de la página web y del contenido principal).
    *
    *   Retorno: ninguno.
    */
    public static function headerTemplate($title)
    {
         // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en las páginas web.
         session_start();
         // Se imprime el código HTML de la cabecera del documento.
         print('
         <!DOCTYPE html>
         <html lang="es">
         
         <head>
             <meta charset="UTF-8">
             <meta http-equiv="X-UA-Compatible" content="IE=edge">
             <meta name="viewport" content="width=device-width, initial-scale=1.0">
             <title>Dashboard - ' . $title . '</title>
             <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
             <link rel="stylesheet" type="text/css" href="../../resource/css/styles.css">
             <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
             <!--Se informa al navegador que el sitio web está optimizado para dispositivos móviles-->
             <meta name="viewport" content="width=device-width, initial-scale=1.0" />
             <link rel="shotcut icon" href="../../resource/img/logo.jpg" type="image/x-icon">
         </head>
         
         <body>');
         // Se obtiene el nombre del archivo de la página web actual.
        $filename = basename($_SERVER['PHP_SELF']);
        // Se comprueba si existe una sesión de administrador para mostrar el menú de opciones, de lo contrario se muestra un menú vacío.
        if (isset($_SESSION['id_usuario'])) {
            // Se verifica si la página web actual es diferente a index.php (Iniciar sesión) y a register.php (Crear primer usuario) para no iniciar sesión otra vez, de lo contrario se direcciona a main.php
            if ($filename != 'index.php' && $filename != 'register.php') {
                // Se llama al método que contiene el código de las cajas de dialogo (modals).
                self::modals();
                // Se imprime el código HTML para el encabezado del documento con el menú de opciones.
                print('
                <header>
                <!--Inicio Navabar--> 
                 <div class="navbar-fixed">
                 
                     <nav class="blue-grey darken-4">
                         <div class="nav-wrapper">
                             <a href= "../../views/dashboard/main.php" class="brand-logo center"><img src="../../resource/img/logo.jpg" alt="" weight="100px" height="65px"></a>
                             <a href="#" data-target="mobile-sidenav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                                 <ul id="nav-mobile" class="right hide-on-med-and-down">
                                     <li><a href="#"><i class="material-icons left">verified_user</i>Usuario: <b>' . $_SESSION['alias_u'] . '</b></a></li>
                                     <li><a href="#" onclick="openProfileDialog()"><i class="material-icons left">person</i>Editar cuenta</a></li>
                                     <li><a href="#" onclick="openPasswordDialog()"><i class="material-icons left">replay</i>Cambiar contraseña</a></li>
                                     <li><a href="#" onclick="logOut()"><i class="material-icons left">clear</i>Cerrar Sesión</a></li>
                                 </ul>
                                 <ul id="dropdown" class="dropdown-content">
                                        
                                        <li><a href="#" onclick="openPasswordDialog()"><i class="material-icons">lock</i>Cambiar clave</a></li>
                                        
                                </ul>
                         </div>
                     </nav>
                 </div>
                 <!--Navegación lateral para dispositivos móviles-->
                 <ul class="sidenav" id="mobile-sidenav">
                     <!--Menu Sidevar cuando se hace pequeña la ventana-->
                         <li><a href="../../views/public/nosotros.php">Mi perfil</a></li>
                         <li><a href="../../views/public/index.php">Cerrar Sesion</a></li>
                         <li><a href="#" class="dropdown-trigger" data-target="dropdown"><i class="material-icons left">verified_user</i>Cuenta: <b>' . $_SESSION['alias_u'] . '</b></a></li>
                     </ul>
             
                     <ul id="slide-out" class="sidenav">
                     <li><a class="subheader">Mantenimientos</a></li>
                         <!--Enlaces otras paginas--> 
                         <li><a href="../../views/dashboard/usuarios.php"><i class="material-icons">person</i>Usuarios</a></li>
                         <li><a href="../../views/dashboard/automovil.php"><i class="material-icons">directions_car</i>Automoviles</a></li>
                         <li><a href="../../views/dashboard/marcas.php"><i class="material-icons">widgets</i>Marcas Automoviles</a></li>
                         <li><a href="../../views/dashboard/citas.php"><i class="material-icons">date_range</i>Citas</a></li>
                         <li><a href="../../views/dashboard/reparaciones.php"><i class="material-icons">build</i>Reparaciones</a></li>
                         <li><a href="../../views/dashboard/clientes.php"><i class="material-icons">contacts</i>Clientes</a></li>
                         <li><a class="subheader">Detalles de su cuenta</a></li>
                         <li><a class="dropdown-trigger" href="#" data-target="dropdown-mobile"><i class="material-icons">verified_user</i>Usuario: <b>' . $_SESSION['alias_u'] . '</b></a></li>
                         <li><a href="#" onclick="openPasswordDialog()"><i class="material-icons">security</i>Cambiar contraseña</a></li>
                         <li><a href="#" onclick="openProfileDialog()"><i class="material-icons">person</i>Editar perfil</a></li>
                         <li><a href="#" onclick="logOut()"><i class="material-icons">clear</i>Cerrar sesión</a></li>
                     </ul>
                     <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                 </header>
             </body>
             <main >
                        <h3 class="center-align">' . $title . '</h3>
                ');
            } else {
                header('location: main.php');
            }
        } else {
            // Se verifica si la página web actual es diferente a index.php (Iniciar sesión) y a register.php (Crear primer usuario) para direccionar a index.php, de lo contrario se muestra un menú vacío.
            if ($filename != 'index.php' && $filename != 'register.php') {
                header('location: index.php');
            } else {
                // Se imprime el código HTML para el encabezado del documento con un menú vacío cuando sea iniciar sesión o registrar el primer usuario.
                print('
                <header>
                <!--Inicio Navabar--> 
                 <div class="navbar-fixed">
                 
                     <nav class="blue-grey darken-4">
                         <div class="nav-wrapper">
                             <a href= "../../views/dashboard/dashboard.php" class="brand-logo center"><img src="../../resource/img/logo.jpg" alt="" weight="100px" height="65px"></a>
                             <a href="#" data-target="mobile-sidenav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                                 <ul id="nav-mobile" class="right hide-on-med-and-down">
                                     <li><a href="../../views/public/cita.php">Mi perfil</a></li>
                                     <li><a href="../../views/public/login.php">Cerrar Sesión</a></li>
                                 </ul>
                         </div>
                     </nav>
                 </div>
                 <!--Navegación lateral para dispositivos móviles-->
                 <ul class="sidenav" id="mobile-sidenav">
                     <!--Menu Sidevar cuando se hace pequeña la ventana-->
                         <li><a href="../../views/public/nosotros.php">Mi perfil</a></li>
                         <li><a href="../../views/public/index.php">Cerrar Sesion</a></li>
                     </ul>
             
                     <ul id="slide-out" class="sidenav">
                         <!--Enlaces otras paginas--> 
                         <li><a href="../../views/dashboard/usuarios.php"><i class="material-icons">person</i>Usuarios</a></li>
                         <li><a href="../../views/dashboard/automovil.php"><i class="material-icons">directions_car</i>Automoviles</a></li>
                         <li><a href="../../views/dashboard/citas.php"><i class="material-icons">date_range</i>Citas</a></li>
                         <li><a href="../../views/dashboard/reparaciones.php"><i class="material-icons">build</i>Reparaciones</a></li>
                         <li><a href="../../views/dashboard/facturacion.php"><i class="material-icons">receipt</i>Facturación</a></li>
                         <li><a href="../../views/dashboard/clientes.php"><i class="material-icons">contacts</i>Clientes</a></li>
                         <li><a href="../../views/dashboard/reportes.php"><i class="material-icons">insert_chart</i>Reportes</a></li>
                     </ul>
                     <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                 </header>
             </body>
             <main >
                        <h3 class="center-align">' . $title . '</h3>
                ');
            }
        }
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
        // Se comprueba si existe una sesión de administrador para imprimir el pie respectivo del documento.
        if (isset($_SESSION['id_usuario'])) {
            $scripts = '
                <script type="text/javascript" src="../../resource/js/materialize.min.js"></script>
                <script type="text/javascript" src="../../resource/js/sweetalert.min.js"></script>
                <script type="text/javascript" src="../../app/helpers/components.js"></script>
                <script type="text/javascript" src="../../app/controllers/dashboard/iniciar.js"></script>
                <script type="text/javascript" src="../../app/controllers/dashboard/account.js"></script>
                <script type="text/javascript" src="../../app/controllers/dashboard/' . $controller . '"></script>
            ';
        } else {
            $scripts = '
                <script type="text/javascript" src="../../resource/js/materialize.min.js"></script>
                <script type="text/javascript" src="../../resource/js/sweetalert.min.js"></script>
                <script type="text/javascript" src="../../app/helpers/components.js"></script>
                <script type="text/javascript" src="../../app/controllers/dashboard/iniciar.js"></script>
                <script type="text/javascript" src="../../app/controllers/dashboard/' . $controller . '"></script>
            ';
        }
        print('
        </main>
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
                    ' . $scripts . '
                </body>
            </html>
        ');
    }

         /*
    *   Método para imprimir las cajas de dialogo (modals) de editar pefil y cambiar contraseña.
    */
    private static function modals()
    {
        // Se imprime el código HTML de las cajas de dialogo (modals).
        print('
            <!-- Componente Modal para mostrar el formulario de editar perfil -->
            <div id="profile-modal" class="modal">
                <div class="modal-content">
                    <h4 class="center-align">Editar perfil</h4>
                    <form method="post" id="profile-form">
                        <div class="row">
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">person</i>
                                <input id="nombres_perfil" type="text" name="nombres_perfil" class="validate" required/>
                                <label for="nombres_perfil">Nombres</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">person</i>
                                <input id="apellidos_perfil" type="text" name="apellidos_perfil" class="validate" required/>
                                <label for="apellidos_perfil">Apellidos</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">email</i>
                                <input id="correo_perfil" type="email" name="correo_perfil" class="validate" required/>
                                <label for="correo_perfil">Correo</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">person_pin</i>
                                <input id="alias_perfil" type="text" name="alias_perfil" class="validate" required/>
                                <label for="alias_perfil">Alias</label>
                            </div>
                        </div>
                        <div class="row center-align">
                            <a href="#" class="btn waves-effect grey tooltipped modal-close" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a>
                            <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar"><i class="material-icons">save</i></button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Componente Modal para mostrar el formulario de cambiar contraseña -->
            <div id="password-modal" class="modal">
                <div class="modal-content">
                    <h4 class="center-align">Cambiar contraseña</h4>
                    <form method="post" id="password-form">
                        <div class="row">
                            <div class="input-field col s12 m6 offset-m3">
                                <i class="material-icons prefix">security</i>
                                <input id="clave_actual" type="password" name="clave_actual" class="validate" required/>
                                <label for="clave_actual">Clave actual</label>
                            </div>
                        </div>
                        <div class="row center-align">
                            <label>CLAVE NUEVA</label>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">security</i>
                                <input id="clave_nueva_1" type="password" name="clave_nueva_1" class="validate" required/>
                                <label for="clave_nueva_1">Clave</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">security</i>
                                <input id="clave_nueva_2" type="password" name="clave_nueva_2" class="validate" required/>
                                <label for="clave_nueva_2">Confirmar clave</label>
                            </div>
                        </div>
                        <div class="row center-align">
                            <a href="#" class="btn waves-effect grey tooltipped modal-close" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a>
                            <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar"><i class="material-icons">save</i></button>
                        </div>
                    </form>
                </div>
            </div>
        ');
    }
}
    