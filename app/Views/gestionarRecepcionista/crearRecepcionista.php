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

            <form method="post" action="<?php echo base_url(); ?>recepcionista/insertar" autocomplete="off">
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <!-- set_value('nombre') para que no se pierda lo que el usuario escribio cuando la página se recargue al presionar el boton guardar -->
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo set_value('nombre')?>" autofocus required>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="paterno" class="form-label">Apellido Paterno:</label>
                            <input type="text" class="form-control" id="paterno" name="paterno" value="<?php echo set_value('paterno')?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="materno" class="form-label">Apellido Materno:</label>
                            <input type="text" class="form-control" id="materno" name="materno" value="<?php echo set_value('materno')?>" required>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="telefono" class="form-label">Teléfono:</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo set_value('telefono')?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo set_value('fecha_nacimiento')?>" required>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="sexo" class="form-label">Sexo:</label>
                            <select class="form-select" id="sexo" name="sexo" required>
                                <option value="">Seleccione una opción</option>
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                                <option value="O">Otro</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="sueldo" class="form-label">Sueldo:</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" step="0.01" class="form-control" id="sueldo" name="sueldo" required>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="<?php echo base_url(); ?>recepcionista" class="btn btn-primary my-3">Regresar</a>
                <button type="submit" class="btn btn-success my-3">Guardar</button>
            </form>

        </div>
    </main>