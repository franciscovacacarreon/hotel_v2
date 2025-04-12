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
            <form method="post" action="<?php echo base_url(); ?>servicio/insertar" autocomplete="off">
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Nombre</label>
                            <input class="form-control" id="nombre" name="nombre" type="text" autofocus required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="">Precio</label>
                            <input class="form-control" id="precio" name="precio" type="text" required>
                        </div>      
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Descripción</label>
                            <input class="form-control" id="descripcion" name="descripcion" type="text" required>
                        </div>
                        <!-- tipo de servicios -->
                        <div class="col-12 col-sm-6">
                            <label for="">Categorias</label>
                            <select class="form-control" name="id_tipoServicio" id="id_tipoServicio" required>
                                <option value="">Selecionar tipo de servicio</option>
                                <?php foreach ($tipoServicios as $tiposervicio) { ?>

                                    <option value="<?php echo $tiposervicio['id_tipoServicio'] ?>"><?php echo $tiposervicio['nombre'] ?></option>

                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- botón para regresar a la vista habitaciones -->
                <a href="<?php echo base_url();?>servicio" class="btn btn-primary my-3">Regresar</a>
                <button type="submit" class="btn btn-success my-3">Guardar</button>
            </form>

        </div>
    </main>