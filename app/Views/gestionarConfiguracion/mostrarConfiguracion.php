<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h4 class="mt-4"><?php  echo $titulo?></h4>

            <?php if(isset($validation)) {?>
                <div class="alert alert-danger">
                    <?php   echo $validation->listErrors();?>
                </div>
            <?php }?>

            <form method="POST" action="<?php echo base_url() ?>configuracion/actualizar" autocomplete="off">
                <?php csrf_field();?>

                <input type="hidden" value="<?=$id_configuracion?>" name="id_configuracion" id="id_configuracion">

                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Nombre del Hotel</label>
                            <input class="form-control" id="hotel_nombre" name="hotel_nombre" 
                            type="text" value="<?php echo $nombre?>" autofocus required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="">RFC</label>
                            <input class="form-control" id="hotel_rfc" name="hotel_rfc" type="text" value="<?php echo $rfc?>" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Teléfono del Hotel</label>
                            <input class="form-control" id="hotel_telefono" name="hotel_telefono" 
                            type="text" value="<?php echo $telefono?>" required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="">Correo del Hotel</label>
                            <input class="form-control" id="hotel_email" name="hotel_email" type="text" value="<?php echo $email?>" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Direccion del Hotel</label>
                            <textarea class="form-control" name="hotel_direccion" id="hotel_direccion" required><?php echo $direccion?></textarea>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="">Leyenda del ticket</label>
                            <textarea class="form-control" name="leyenda_nota" id="leyenda_nota" required><?php echo $leyenda?></textarea>
                        </div>
                    </div>
                </div>

                <a href="<?php echo base_url() ?>administrador" class="btn btn-primary my-3">Regresar</a>
                <button type="submit" class="btn btn-success my-3">Guardar</button>
            </form>
        </div>
    </main>

<!-- Modal -->
<div class="modal fade" id="modal-confirma" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar registro</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>¿Desea eliminar este registro?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <a  class="btn btn-danger btn-ok">Si</a>
      </div>
    </div>
  </div>
</div>


    