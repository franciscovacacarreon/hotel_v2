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

            <!-- formulario -->
            <form method="post" action="<?php echo base_url(); ?>habitacion/insertar" autocomplete="off">
                <div class="form-group">

                    <div class="row">
                        <!-- <div class="col-12 col-sm-6">
                            <label for="">Numero de camas</label>
                            <input class="form-control" id="numero_camas" name="numero_camas" type="number" autofocus required>
                        </div> -->

                        <!-- categorias activas -->
                        <div class="col-12 col-sm-6">
                            <label for="">Categorias</label>
                            <select class="form-control" name="id_categoria" id="id_categoria" required>
                                <option value="">Selecionar categoria</option>
                                <?php foreach ($categorias as $categoria) { ?>

                                    <option value="<?php echo $categoria['id'] ?>"><?php echo $categoria['nombre'] ?></option>

                                <?php } ?>
                            </select>
                        </div>

                        <!-- estado de las habitaciones -->
                        <div class="col-12 col-sm-6">
                            <label for="">Estado habitacion</label>
                            <select class="form-control" name="estado_habitacion" id="estado_habitacion" required>
                                <option value="">Selecionar estado</option>
                                <option value="Disponible">Disponible</option>
                                <option value="Ocupada">Ocupada</option>
                                <option value="Reservada">Reservada</option>
                                <option value="En mantenimiento">En mantenimiento</option>
                            </select>
                        </div>
                    </div>

                    
                </div>

                <!-- botón para regresar a la vista habitaciones -->
                <a href="<?php echo base_url(); ?>habitacion" class="btn btn-primary my-3">Regresar</a>
                <button type="submit" class="btn btn-success my-3">Guardar</button>
            </form>

        </div>
    </main>