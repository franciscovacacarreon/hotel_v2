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

            <form method="post" action="<?php echo base_url(); ?>servicio/actualizar" autocomplete="off">

                <input type="hidden" value="<?php echo $servicio['id_servicio'] ?>" name="id_servicio">

                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Nombre</label>
                            <input class="form-control" id="nombre" name="nombre" type="text" autofocus value="<?php echo $servicio['nombre'] ?>" required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="">Precio</label>
                            <input class="form-control" id="precio" name="precio" type="text" value="<?php echo $servicio['precio'] ?>" required>
                        </div>      
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Descripción</label>
                            <input class="form-control" id="descripcion" name="descripcion" type="text" value="<?php echo $servicio['descripcion'] ?>"required>
                        </div>
                        <!-- tipo de servicios -->
                        <div class="col-12 col-sm-6">
                            <label for="">Categorias</label>
                            <select class="form-control" name="id_tipoServicio" id="id_tipoServicio" required>
                                <option value="">Selecionar tipo de servicio</option>
                                <?php foreach ($tipoServicios as $tipoServicio) { ?>

                                    <option value="<?php echo $tipoServicio['id_tipoServicio'] ?>"
                                    <?php
                                        //si la categoria es igual al id de la categoria de la habitacion se selecciona
                                        if ($tipoServicio['id_tipoServicio']  ==
                                            $servicio['id_tipoServicio']) {

                                            echo 'selected';
                                        }
                                    ?>
                                    ><?php echo $tipoServicio['nombre'] ?></option>

                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <a href="<?php echo base_url(); ?>servicio" class="btn btn-primary my-3">Regresar</a>
                <button type="submit" class="btn btn-success my-3">Guardar</button>
            </form>

        </div>
    </main>