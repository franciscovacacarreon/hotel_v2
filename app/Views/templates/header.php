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
    <title>Hotel - SB Admin</title>
    <link href="<?php echo base_url() ?>css/dataTables.bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>css/styles.css" rel="stylesheet" />
    <script src="<?php echo base_url() ?>js/all.js"></script>
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
                <?php echo $user_session->usuario;?><i class="fas fa-user fa-fw"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="<?php echo base_url(); ?>usuario/cambiaPassword">Cambiar contraseña</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
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
                        <!--###################### Gesionar habitaciones-->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Gestionar Habitaciones
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <!--######################-->
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url(); ?>habitacion">Habitaciones</a>
                                <a class="nav-link" href="<?php echo base_url(); ?>categoria">Categorias</a>
                            </nav>
                        </div>
                        <!--###################### GESTIONAR TIPO SERVICIOS-->         
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#subServicio" aria-expanded="false" aria-controls="subServicio">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-bell-concierge"></i></div>
                        Gestionar Servicios
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="subServicio" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url(); ?>servicio">Servicios</a>
                                <a class="nav-link" href="<?php echo base_url(); ?>tipoServicio">Tipo de servicios</a>
                            </nav>
                        </div>

                            <!--###################### Gestionar Recepcionista-->
                        <a class="nav-link" href="<?php echo base_url(); ?>recepcionista">
                            <div class="sb-nav-link-icon">
                                <i class="fa-solid fa-users"></i>
                            </div>
                            Recepcionistas
                        </a>
                        <!-------------------------------------------------------------------------------------->
                        <!--###################### Gestionar administracion-->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#subAdministracion" aria-expanded="false" aria-controls="subAdministracion">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-tools"></i></div>
                            Administración
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="subAdministracion" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url(); ?>configuracion">Configuracion</a>
                                <a class="nav-link" href="<?php echo base_url(); ?>usuario">Usuarios</a>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div>
            </nav>
        </div>