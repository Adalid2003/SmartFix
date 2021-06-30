<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="../../resource/css/styles.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Se informa al navegador que el sitio web está optimizado para dispositivos móviles-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
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
            <li>
                <div class="user-view">
                    <div class="background">
                        <img src="../../resource/img/fondo/fondo.jpg">
                    </div>
                    <a href="#user"><img class="circle" src="../../resource/img/users/user1.png"></a>
                    <a href="#name"><span class="white-text name">José Jiménez</span></a>
                    <a href="#email"><span class="white-text email">20190119@ricaldone.edu.sv</span></a>
                </div>
            </li>
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

</html>
<main>