<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h4 class="mt-4"><?php echo $titulo ?></h4>
            
            <!-- para la lista de errores -->
            <?php if(isset($validation)) {?>
                <div class="alert alert-danger">
                    <?php   echo $validation->listErrors();?>
                </div>
            <?php }?>

            <!-- Formulario -->
            <form method="post" action="<?php echo base_url();?>categoria/actualizar" autocomplete="off">

            <!-- input para mandar el id -->
            <input type="hidden" value="<?php  echo $datos['id']?>" name="id">

                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Nombre</label>
                            <input class="form-control" id="nombre" name="nombre" type="text" value="<?php  echo $datos['nombre']?>" autofocus required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="">Descripción</label>
                            <input class="form-control" id="descripcion" name="descripcion" type="text" value="<?php  echo $datos['descripcion']?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Precio</label>
                            <input class="form-control" id="precio" name="precio" type="text" value="<?php  echo $datos['precio']?>" required>
                        </div>
                    </div>
                </div>

                <!-- boton para guardar -->
                <a href="<?php echo base_url();?>categoria" class="btn btn-primary my-3">Regresar</a>
                <button type="submit" class="btn btn-success my-3">Guardar</button>
            </form>

        </div>
    </main>