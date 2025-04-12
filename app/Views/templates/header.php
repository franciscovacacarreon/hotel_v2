<?php
//para obtener la sesion
$user_session = session();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link href="<?php echo base_url() ?>css/dataTables.bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>css/styles.css" rel="stylesheet" />
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/img/iconoHotel.png" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo base_url() ?>css/jquery.dataTables.min.css">k
    <link rel="stylesheet" href="<?php echo base_url() ?>css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>css/sweetalert2.min.css">
    <script src="<?php echo base_url() ?>js/all.js"></script>
    <script src="<?php echo base_url() ?>js/jquery-3.5.1.min.js"></script>      
    

    <!-- titulo -->
    <title>Hotel - Jaldin Bolivar</title>
</head>


<body class="sb-nav-fixed">

    <!---------------------------- BARRA DE NAVEGACINO SUPERIOR ------------------------->
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">Hotel Jaldin Bolivar</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

        <!-- BARRA DE BUSQUEDA -->
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <!-- nombre de la sesion -->
                    <?php echo $user_session->usuario; ?><i class="fas fa-user fa-fw"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="<?php echo base_url(); ?>usuario/cambiaPassword">Cambiar contraseña</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="<?php echo base_url(); ?>usuario/logout">Cerrar sesión</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <!---------------------------- BARRA DE NAVEGACINO LATERAL ------------------------->
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">

                        <!-------------------------------------------------------------------------------------->

                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <!--###################### Administrador-->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#subAdministrador" aria-expanded="false" aria-controls="subAdministrador">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-bars-progress"></i></div>
                            Administración
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <!--######################-->
                        <div class="collapse" id="subAdministrador" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url(); ?>administrador">Escritorio Admin</a>
                            </nav>
                        </div>
                        <!--###################### Gestionar Hospedaje-->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#subHospedaje" aria-expanded="false" aria-controls="subHospedaje">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-bed"></i></div>
                            Gestionar Hospedaje
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <!--######################-->
                        <div class="collapse" id="subHospedaje" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url(); ?>recepcion">Recepción</a>
                                <a class="nav-link" href="<?php echo base_url(); ?>notahospedaje">Hospedaje</a>
                                <a class="nav-link" href="<?php echo base_url(); ?>notahospedaje/crear">Nuevo Hospedaje</a>
                            </nav>
                        </div>

                        <!--###################### GESTIONAR SERVICIOS-->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#subServicio" aria-expanded="false" aria-controls="subServicio">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-bell-concierge"></i></div>
                            Gestionar Servicios
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="subServicio" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url(); ?>notaservicio">Notas de servicio</a>
                                <a class="nav-link" href="<?php echo base_url(); ?>notaservicio/crear">Nueva nota servicio</a>
                                <a class="nav-link" href="<?php echo base_url(); ?>servicio">Servicios</a>
                                <a class="nav-link" href="<?php echo base_url(); ?>tiposervicio">Tipo de servicios</a>
                            </nav>
                        </div>

                        <!--###################### Gestionar Reserva-->
                        <!-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#subReserva" aria-expanded="false" aria-controls="subReserva">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-calendar"></i></div>
                            Gestionar Reserva
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a> -->
                        <!--######################-->
                        <!-- <div class="collapse" id="subReserva" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php //echo base_url(); 
                                                            ?>reserva/crear">Nueva Reserva</a>
                            </nav>
                        </div> -->

                        <!--###################### Gesionar habitaciones-->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#subHabitacion" aria-expanded="false" aria-controls="subHabitacion">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Gestionar Habitaciones
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <!--######################-->
                        <div class="collapse" id="subHabitacion" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url(); ?>habitacion">Habitaciones</a>
                                <a class="nav-link" href="<?php echo base_url(); ?>categoria">Categorias</a>
                            </nav>
                        </div>

                        <!--###################### Gestionar clientes-->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#subCliente" aria-expanded="false" aria-controls="subCliente">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-people-group"></i></div>
                            Clientes
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="subCliente" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a href="<?php echo base_url(); ?>cliente" id="cliente-a" class="nav-link">Clientes</a>
                            </nav>
                        </div>

                        <?php if ($user_session->id_rol == 1) { ?>
                            <!--###################### Gestionar Recepcionista-->
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#subRecepcionista" aria-expanded="false" aria-controls="subRecepcionista">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-user-group"></i></i></div>
                                Recepcionistas
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="subRecepcionista" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url(); ?>recepcionista">Recepcionistas</a>
                                </nav>
                            </div>

                            <!--###################### Gestionar Reportes-->
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#subReporte" aria-expanded="false" aria-controls="subReporte">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-chart-simple"></i></div>
                                Reportes
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="subReporte" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url(); ?>reporte">Reporte Hospedajes</a>
                                    <a class="nav-link" href="<?php echo base_url(); ?>reporte/servicio">Reporte Servicios</a>
                                </nav>
                            </div>
                            <!-------------------------------------------------------------------------------------->
                            <!--###################### Gestionar administracion-->
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#subAdministracion" aria-expanded="false" aria-controls="subAdministracion">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-tools"></i></div>
                                Configuración
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="subAdministracion" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url(); ?>configuracion">Configuracion</a>
                                    <a class="nav-link" href="<?php echo base_url(); ?>usuario">Usuarios</a>
                                    <a class="nav-link" href="<?php echo base_url(); ?>rol">Roles</a>
                                    <a class="nav-link" href="<?php echo base_url(); ?>permiso">Permisos</a>
                                    <a class="nav-link" href="<?php echo base_url(); ?>submodulo">Módulos y Submódulos</a>
                                </nav>
                            </div>
                    </div>

                <?php } ?>

                </div>
                <div class="sb-sidenav-footer">
                    <!-- <div class="small">Estudiante:</div>
                    <div>Francisco Vaca Carreón</div> -->
                </div>
            </nav>
        </div>

