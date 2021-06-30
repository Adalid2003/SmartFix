<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartFit</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!--Llamando el css-->
    <link rel="stylesheet" type="text/css" href="../../resource/css/styles.css">
    <!--Apis-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Se informa al navegador que el sitio web está optimizado para dispositivos móviles-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
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
    <main>