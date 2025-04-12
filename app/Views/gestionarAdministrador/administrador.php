<!-- Las consultas par esta vista están en habitación model -->
<link href="<?php echo base_url() ?>css/style.administrador.css" rel="stylesheet" />
<div id="layoutSidenav_content">
    <!-- Page header start -->
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item active">Admin Dashboard</li>
        </ol>
    </div>
    <!-- Page header end -->

    <!-- Main container start -->
    <div class="main-container">

        <!-- Row start -->
        <div class="row gutters">
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="info-stats4 card text-white" style="background-color: rgb(11, 134, 205);">
                    <div class="info-icon">
                        <i class="icon-file-text"></i>
                    </div>
                    <div class="sale-num d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-white">HABITACIONES</p>
                            <h3><?= $habitacion['cantidad_habitaciones'] ?></h3>
                        </div>
                        <div class="d-flex justify-content-end">
                            <i class="fa-solid fa-bed fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="info-stats4 card bg-success text-white">
                    <div class="info-icon">
                        <i class="icon-tag"></i>
                    </div>
                    <div class="sale-num d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-white">DISPONIBLES</p>
                            <h3><?= $habitacionDisponible['cantidad_disponible'] ?></h3>
                        </div>
                        <div>
                            <i class="fa-solid fa-bed fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="info-stats4 card bg-warning text-dark">
                    <div class="info-icon">
                        <i class="icon-shopping-bag1"></i>
                    </div>
                    <div class="sale-num d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-dark">OCUPADAS</p>
                            <h3><?= $habitacionOcupada['cantidad_ocupada'] ?></h3>
                        </div>
                        <div>
                            <i class="fa-solid fa-bed fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="info-stats4 card bg-danger text-white">
                    <div class="info-icon">
                        <i class="icon-activity"></i>
                    </div>
                    <div class="sale-num d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-white">EN MANTENIMIENTO</p>
                            <h3><?= $habitacionMantenimiento['cantidad_mantenimiento'] ?></h3>
                        </div>
                        <div>
                            <i class="fa-solid fa-bed fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row end -->

        <!-- Row start -->
        <div class="row gutters">
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card bg-light">
                    <div class="card-header">
                        <div class="card-title text-dark">Nuevo</div>
                    </div>
                    <div class="card-body">
                        <div class="customScroll5">
                            <ul class="quick-analytics">
                                <li><a href="#" class="text-dark"><i class="fas fa-mattress-pillow"></i> S/ <?= $cantidadHospedaje['cantidad_hospedaje'] ?> hospedaje</a></li>
                                <li><a href="#" class="text-dark"><i class="fas fa-bell-concierge"></i> <?= $cantidadServicio ?> Servicios</a></li>
                                <li><a href="#" class="text-dark"><i class="fas fa-users"></i> <?= $cantidadCliente ?> Clientes</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Servicios</div>
                    </div>
                    <div class="card-body">
                        <div class="customScroll5">
                            <ul class="project-activity">

                                <?php foreach ($servicios as $servicio) { ?>
                                    <li class="activity-list">
                                        <div class="detail-info">
                                            <p class="date"><?= $servicio['nombre'] ?></p>
                                            <p class="info"><?= $servicio['descripcion'] ?></p>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Tipos de servicios</div>
                    </div>
                    <div class="card-body">
                        <div class="customScroll5">
                            <ul class="project-activity">
                                
                                <?php foreach ($tipoServicios as $tiposervicio) {?>
                                    <li class="activity-list">
                                        <div class="detail-info">
                                            <p class="date"><?=$tiposervicio['nombre']?></p>
                                        </div>
                                    </li>
                                <?php }?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Row end -->

    </div>
    <!-- Main container end -->