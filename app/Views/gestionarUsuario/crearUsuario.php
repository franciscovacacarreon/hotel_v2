<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h4 class="mt-4"><?php echo $titulo ?></h4>

            <!-- para la lista de errores -->
            <?php if (isset($validation)) { ?>
                <div class="alert alert-danger">
                    <?php echo $validation->listErrors(); ?>
                </div>
            <?php } ?>

            <div class="row">

                <!-- formulario -->
                <div class="col-lg-8 col-sm-12 col-md-12">
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header text-primary">
                            Datos
                        </div>
                        <div class="car-body p-3">
                            <form method="POST" action="<?php echo base_url() ?>usuario/insertar" autocomplete="off">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <label for="">Usuario</label>
                                            <input class="form-control" id="usuario" name="usuario" type="text" value="<?php echo set_value('usuario') ?>" autofocus required>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <label for="">Contraseña</label>
                                            <!--set_value cuando de actualiza el formulario no se pierde lo que el usuario escribio -->
                                            <input class="form-control" id="password" name="password" type="password" value="<?php echo set_value('password') ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">    
                                        <div class="col-12 col-sm-6">
                                            <label for="">Confirmar Contraseña</label>
                                            <input class="form-control" id="re_password" name="re_password" type="password" value="<?php echo set_value('re_passoword') ?>" required>
                                        </div>

                                        <!-- recepcionistas -->
                                        <div class="col-12 col-sm-6">
                                            <label for="">Recepcionista</label>

                                            <!-- traer los recepcionistas de la base de datos -->
                                            <select class="form-control" name="id_recepcionista" id="id_recepcionista" required>
                                                <option value="">Seleccione un recepcionista</option>
                                                <?php foreach ($recepcionistas as $recepcionista) { ?>

                                                    <option value="<?php echo $recepcionista['id_recepcionista'] ?>">
                                                        <?php echo $recepcionista['nombre'] ?>
                                                        <?php echo $recepcionista['paterno'] ?>
                                                    </option>

                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">

                                        <!-- Roles -->
                                        <div class="col-12 col-sm-6">
                                            <label for="">Rol</label>

                                            <!-- traer los roles de la base de datos -->
                                            <select class="form-control" name="id_rol" id="id_rol" required>
                                                <option value="">Selecionar rol</option>
                                                <?php foreach ($roles as $rol) { ?>

                                                    <option value="<?php echo $rol['id_rol'] ?>"><?php echo $rol['nombre'] ?></option>

                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <a href="<?php echo base_url() ?>usuario" class="btn btn-primary my-3">Regresar</a>
                                <button type="submit" class="btn btn-success my-3">Guardar</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-sm-12 col-md-12">
                    <!-- Profile picture card-->
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header text-primary">Perfil de usuario</div>
                        <div class="card-body text-center">
                            <!-- Profile picture image-->
                            <img class="img-account-profile rounded-circle mb-2" src="" alt="">
                            <!-- Profile picture help block-->
                            <div class="small font-italic text-muted mb-4">PG o PNG de no más de 5 MB</div>
                            <!-- Profile picture upload button-->
                            <button class="btn btn-secondary" type="button">Subir imagen</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>