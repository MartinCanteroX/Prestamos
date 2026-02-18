<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mis Prestamos 6.0.0</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?php echo BASE_URL_VIEWS ?>plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL_VIEWS ?>plugins/fontawesome-free-5.15.4-web/css/all.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo BASE_URL_VIEWS ?>css/adminlte.min.css">
    <!-- CSS School 3W -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- CSS MisCuentas -->
    <link rel="stylesheet" href="<?php echo BASE_URL_VIEWS ?>css/prestamos.css">
    <!-- toastify -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!--BARRA SUPERIOR (NavBar) -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>

                <!-- HOME -->
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?php echo BASE_URL ?>index" class="nav-link">Home</a>
                </li>

                <!-- CONTACT -->
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- -- -->
            <!-- BARRA DE MENU -->
            <!-- -- -->
            <ul class="navbar-nav ml-auto">

                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge" id="main-mensajes-cantidad"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="<?php echo BASE_URL_IMG ?>avatar5.png" alt="User Avatar"
                                    class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="<?php echo BASE_URL_IMG ?>avatar5.png" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="<?php echo BASE_URL_IMG ?>avatar5.png" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i
                                                class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <!-- <a class="nav-link" data-toggle="dropdown" href="<?php echo BASE_URL ?>Vencimientos"> -->
                    <a class="nav-link" href="<?php echo BASE_URL ?>Vencimientos">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge" id="main-notif-cant-icono"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?php echo BASE_URL ?>" class="brand-link">
                <img src="<?php echo BASE_URL_IMG ?>MisCuentasLogoPequeno.png" alt="MisCuentas Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Mis Cuentas</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar USER panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?php echo BASE_URL_IMG ?>avatar4.png" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Martin</a>
                    </div>
                </div>

                <!-- Sidebar MENU -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview"
                        role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

                        <!-- Menu de opciones 'Archivos'
                        ------------------- -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-list"></i>
                                <p>
                                    Archivos...
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview nav-child-indent">
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>Clientes" class="nav-link">
                                        <i class="fas fa-upload nav-icon"></i>
                                        <p>Clientes</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>Entidades" class="nav-link">
                                        <i class="fas fa-download nav-icon"></i>
                                        <p>Entidades</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>Comerciales" class="nav-link">
                                        <i class="fas fa-random nav-icon"></i>
                                        <p>Comerciales</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>Inversores" class="nav-link">
                                        <i class="fas fa-calendar-alt nav-icon"></i>
                                        <p>Inversores</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>Proveedores" class="nav-link">
                                        <i class="fas fa-calendar-alt nav-icon"></i>
                                        <p>Proveedores</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>Empleadores" class="nav-link">
                                        <i class="fas fa-calendar-alt nav-icon"></i>
                                        <p>Empleadores</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>Conceptos" class="nav-link">
                                        <i class="fas fa-calendar-alt nav-icon"></i>
                                        <p>Conceptos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>Tipo de Prestamos" class="nav-link">
                                        <i class="fas fa-calendar-alt nav-icon"></i>
                                        <p>Tipo de Prestamos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>Otras Tablas" class="nav-link">
                                        <i class="nav-icon fas fa-list"></i>
                                        <p>Otras Tablas
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview nav-child-indent">
                                        <li class="nav-item">
                                            <a href="<?php echo BASE_URL ?>Localidades" class="nav-link">
                                                <i class="fas nav-icon"></i>
                                                <p>Localidades</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <!-- Menu de opciones 'Operaciones'
                        ------------------- -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-list"></i>
                                <p>
                                    Operaciones...
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview nav-child-indent">
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>Solicitudes" class="nav-link">
                                        <i class="fas fa-indent nav-icon"></i>
                                        <p>Solicitudes</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>Prestamos" class="nav-link">
                                        <i class="fas fa-outdent nav-icon"></i>
                                        <p>Prestamos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>Cobranzas" class="nav-link">
                                        <i class="fas fa-tasks nav-icon"></i>
                                        <p>Cobranzas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>Ventas" class="nav-link">
                                        <i class="fas fa-random nav-icon"></i>
                                        <p>Ventas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>Devengamiento" class="nav-link">
                                        <i class="fas fa-calendar-check nav-icon"></i>
                                        <p>Devengamiento</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>Gestion Cobros" class="nav-link">
                                        <i class="fas fa-calendar-alt nav-icon"></i>
                                        <p>Gestion Cobros</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>Liquidaciones" class="nav-link">
                                        <i class="fas fa-file-alt nav-icon"></i>
                                        <p>Liquidaciones</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>Proveedores" class="nav-link">
                                        <p>Proveedores</p>
                                        <i class="fas fa-file-alt nav-icon"></i>
                                        <p>Plantillas</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Menu de opciones 'Informes'
                        ------------------- -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Informes...
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview nav-child-indent">
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>Clientes" class="nav-link">
                                        <i class="fas fa-outdent nav-icon"></i>
                                        <p>Clientes
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview nav-child-indent">
                                        <li class="nav-item">
                                            <a href="<?php echo BASE_URL ?>Operaciones" class="nav-link">
                                                <i class="fas nav-icon"></i>
                                                <p>Operaciones</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>Prestamos" class="nav-link">
                                        <i class="fas fa-outdent  nav-icon"></i>
                                        <p>Prestamos
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview nav-child-indent">
                                        <li class="nav-item">
                                            <a href="<?php echo BASE_URL ?>Otorgados" class="nav-link">
                                                <i class="fas nav-icon"></i>
                                                <p>Otorgados</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo BASE_URL ?>Proyeccion" class="nav-link">
                                                <i class="fas nav-icon"></i>
                                                <p>Proyeccion</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo BASE_URL ?>Pendientes" class="nav-link">
                                                <i class="fas nav-icon"></i>
                                                <p>Pendientes</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>Cuotas" class="nav-link">
                                        <i class="fas fa-outdent  nav-icon"></i>
                                        <p>Cuotas
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview nav-child-indent">
                                        <li class="nav-item">
                                            <a href="<?php echo BASE_URL ?>Vencimientos" class="nav-link">
                                                <i class="fas nav-icon"></i>
                                                <p>Vencimientos</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo BASE_URL ?>Cobradas" class="nav-link">
                                                <i class="fas nav-icon"></i>
                                                <p>Cobradas</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo BASE_URL ?>Pendientes" class="nav-link">
                                                <i class="fas nav-icon"></i>
                                                <p>Pendientes</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo BASE_URL ?>Vendidas" class="nav-link">
                                                <i class="fas nav-icon"></i>
                                                <p>Vendidas</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo BASE_URL ?>A Presentar" class="nav-link">
                                                <i class="fas nav-icon"></i>
                                                <p>A Presentar</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo BASE_URL ?>Vtos Vs Cobranzas" class="nav-link">
                                                <i class="fas nav-icon"></i>
                                                <p>Vtos Vs Cobranzas</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>Analisis Mora" class="nav-link">
                                        <i class="fas fa-outdent nav-icon"></i>
                                        <p>Analisis Mora</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>Comisiones" class="nav-link">
                                        <i class="fas fa-outdent nav-icon"></i>
                                        <p>Comisiones</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>Op.Comerciales" class="nav-link">
                                        <i class="fas fa-outdent nav-icon"></i>
                                        <p>Op.Comerciales</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Menu de opciones 'Organismos'
                        ------------------- -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-list"></i>
                                <p>
                                    Organismos...
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview nav-child-indent">
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>ARCA" class="nav-link">
                                        <i class="fas fa-outdent  nav-icon"></i>
                                        <p>ARCA
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview nav-child-indent">
                                        <li class="nav-item">
                                            <a href="<?php echo BASE_URL ?>Factura Electronica" class="nav-link">
                                                <i class="fas nav-icon"></i>
                                                <p>F. Electronica</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo BASE_URL ?>CitiVentas/Compras" class="nav-link">
                                                <i class="fas nav-icon"></i>
                                                <p>CitiVentas</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>BCRA" class="nav-link">
                                        <i class="fas fa-outdent  nav-icon"></i>
                                        <p>BCRA
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview nav-child-indent">
                                        <li class="nav-item">
                                            <a href="<?php echo BASE_URL ?>Deudores S.F." class="nav-link">
                                                <i class="fas nav-icon"></i>
                                                <p>Deudores S.F.</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>RENTAS" class="nav-link">
                                        <i class="fas fa-outdent  nav-icon"></i>
                                        <p>RENTAS
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview nav-child-indent">
                                        <li class="nav-item">
                                            <a href="<?php echo BASE_URL ?>Devengamiento" class="nav-link">
                                                <i class="fas nav-icon"></i>
                                                <p>Devengamiento</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>INAES" class="nav-link">
                                        <i class="fas fa-outdent  nav-icon"></i>
                                        <p>INAES
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview nav-child-indent">
                                        <li class="nav-item">
                                            <a href="<?php echo BASE_URL ?>Padron Asociados" class="nav-link">
                                                <i class="fas nav-icon"></i>
                                                <p>Padron Asociados</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo BASE_URL ?>Resolucion 7207" class="nav-link">
                                                <i class="fas nav-icon"></i>
                                                <p>Resolucion 7207</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo BASE_URL ?>Libro Asociados" class="nav-link">
                                                <i class="fas nav-icon"></i>
                                                <p>Libro Asociados</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo BASE_URL ?>Consejo Adm" class="nav-link">
                                                <i class="fas nav-icon"></i>
                                                <p>Consejo Adm</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <!-- Menu de opciones 'Contabilidad'
                        ------------------- -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Contabilidad...
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview nav-child-indent">
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>Cuentas" class="nav-link">
                                        <i class="fas fa-outdent nav-icon"></i>
                                        <p>Cuentas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>Asientos" class="nav-link">
                                        <i class="fas fa-outdent  nav-icon"></i>
                                        <p>Asientos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>Informes" class="nav-link">
                                        <i class="fas fa-outdent  nav-icon"></i>
                                        <p>Informes
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview nav-child-indent">
                                        <li class="nav-item">
                                            <a href="<?php echo BASE_URL ?>Plan de Cuentas" class="nav-link">
                                                <i class="fas nav-icon"></i>
                                                <p>Plan de Cuentas</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo BASE_URL ?>Diario" class="nav-link">
                                                <i class="fas nav-icon"></i>
                                                <p>Diario</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo BASE_URL ?>Mayores" class="nav-link">
                                                <i class="fas nav-icon"></i>
                                                <p>Mayores</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo BASE_URL ?>Copiativo" class="nav-link">
                                                <i class="fas nav-icon"></i>
                                                <p>Copiativo</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo BASE_URL ?>Balance General" class="nav-link">
                                                <i class="fas nav-icon"></i>
                                                <p>Balance General</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo BASE_URL ?>Balance Parcial" class="nav-link">
                                                <i class="fas nav-icon"></i>
                                                <p>Balance Parcial</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo BASE_URL ?>Balance Periodos" class="nav-link">
                                                <i class="fas nav-icon"></i>
                                                <p>Balance Periodos</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo BASE_URL ?>Balance Comparativo" class="nav-link">
                                                <i class="fas nav-icon"></i>
                                                <p>Balance Comparativo</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo BASE_URL ?>Saldo Rubros" class="nav-link">
                                                <i class="fas nav-icon"></i>
                                                <p>Saldo Rubros</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo BASE_URL ?>Sumas y Saldos" class="nav-link">
                                                <i class="fas nav-icon"></i>
                                                <p>Sumas y Saldos</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>Herramientas" class="nav-link">
                                        <i class="fas fa-outdent  nav-icon"></i>
                                        <p>Herramientas
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview nav-child-indent">
                                        <li class="nav-item">
                                            <a href="<?php echo BASE_URL ?>Cierre/Apertura" class="nav-link">
                                                <i class="fas nav-icon"></i>
                                                <p>Cierre/Apertura</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo BASE_URL ?>Congelamiento" class="nav-link">
                                                <i class="fas nav-icon"></i>
                                                <p>Congelamiento</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <!-- Menu de opciones 'Operaciones'
                        ------------------- -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-list"></i>
                                <p>
                                    Herramientas...
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview nav-child-indent">
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>Numeradores" class="nav-link">
                                        <i class="fas fa-indent nav-icon"></i>
                                        <p>Numeradores</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>Usuarios" class="nav-link">
                                        <i class="fas fa-outdent nav-icon"></i>
                                        <p>Usuarios</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>Mi Clave" class="nav-link">
                                        <i class="fas fa-tasks nav-icon"></i>
                                        <p>Mi Clave</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>Opciones" class="nav-link">
                                        <i class="fas fa-calendar-check nav-icon"></i>
                                        <p>Opciones</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>Generar CUIT" class="nav-link">
                                        <i class="fas fa-calendar-alt nav-icon"></i>
                                        <p>Generar CUIT</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>Interfaces" class="nav-link">
                                        <i class="fas fa-file-alt nav-icon"></i>
                                        <p>Interfaces</p>
                                    </a>
                                </li>
                           </ul>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- /. aside -->