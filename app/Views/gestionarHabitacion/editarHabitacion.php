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

            <form method="post" action="<?php echo base_url(); ?>habitacion/actualizar" autocomplete="off">

                <input type="hidden" value="<?php echo $habitacion['nro_habitacion'] ?>" name="nro_habitacion">

                <div class="form-group">
                    <div class="row">
                        <!-- <div class="col-12 col-sm-6">
                            <label for="">Numero de camas</label>
                            <input class="form-control" id="numero_camas" name="numero_camas" type="number" value="<?php //echo $habitacion['numero_camas']; ?>" autofocus required>
                        </div> -->

                        <!-- categorias -->
                        <div class="col-12 col-sm-6">
                            <label for="">Categorias</label>
                            <select class="form-control" name="id_categoria" id="id_categoria" required>
                                <option value="">Selecionar categoria</option>

                                <?php foreach ($categorias as $categoria) { ?>

                                    <option value="<?php echo $categoria['id']; ?>" 
                                    <?php
                                        //si la categoria es igual al id de la categoria de la habitacion se selecciona
                                        if ($categoria['id']  ==
                                            $habitacion['id_categoria']) {

                                            echo 'selected';
                                        }
                                    ?>
                                    >

                                    <?php echo $categoria['nombre'] ?>
                                    </option>

                                <?php } ?>

                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Estado habitacion</label>
                            <select class="form-control" name="estado_habitacion" id="estado_habitacion" required>
                                <option value="">Selecionar estado</option>
                                <?php
                                //si la categoria es igual al id de la categoria de la habitacion
                                //se selecciona
                                $array = ['Disponible', 'Ocupada', 'Reservada', 'En mantenimiento'];
                                $selected = ['', '', '', ''];

                                for ($i=0; $i < 4; $i++) { 
                                    if ($habitacion['estado_habitacion'] == $array[$i]) {
                                        $selected[$i] = 'selected';
                                    }                
                                }
                                echo '<option value="Disponible" '.$selected[0].'>Disponible</option>';
                                echo '<option value="Ocupada" '.$selected[1].'>Ocupada</option>';
                                echo '<option value="Reservada" '.$selected[2].'>Reservada</option>';
                                echo '<option value="En mantenimiento" '.$selected[3].'>En mantenimiento</option>';
                                ?>
                            </select>
                        </div>
                    </div>
                </div>

                <a href="<?php echo base_url(); ?>habitacion" class="btn btn-primary my-3">Regresar</a>
                <button type="submit" class="btn btn-success my-3">Guardar</button>
            </form>

        </div>
    </main>