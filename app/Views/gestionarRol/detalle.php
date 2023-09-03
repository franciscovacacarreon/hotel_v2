<?php
$session = session();
?>

<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h4 class="mt-4"><?= $titulo ?></h4>

      <form id="form-permiso" name="form-permiso" action="<?= base_url() . 'rol/guardaPermiso' ?>" method="POST">

        <input type="hidden" name="id_rol" value="<?= $id_rol ?>">

        <div class="row row-equal">
          <?php foreach ($modulos as $modulo) {?>

            <div class="col-sm-12 col-md-4 col-lg-3 col-xl-3">
              <div class="card mb-3">
                <div class="card-header text-center">
                  <?=$modulo['nombre']?>
                </div>
                <div class="card-body">

                    <?php 
                    foreach ($permisos as $permiso) { 
                      
                        if ($permiso['id_modulo'] == $modulo['id_modulo']) {
                          
                          if ($permiso['id_tipoPermiso'] == 2) {
                            echo "<label class='fw-bold'>".$permiso['nombre']."</label>" ;
                          }
                    ?>

                            <div class="form-check form-switch">
                              <input class="form-check-input" type="checkbox" value="<?= $permiso['id_permiso'] ?>" name="permisos[]" <?php if (isset($asignado[$permiso['id_permiso']])) { echo 'checked';}?>>
                              <label class="form-check-label"><?= $permiso['nombre'] ?></label>
                            </div>

                    <?php 
                          } //endif 
                      } //endforeach
                    ?>
                </div>
            </div>
          </div>
          <?php }?>
          
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>

      </form>

    </div>
  </main>
