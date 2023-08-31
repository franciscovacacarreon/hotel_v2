<?php
$session = session();
?>

<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h4 class="mt-4"><?= $titulo ?></h4>

      <form id="form-permiso" name="form-permiso" action="<?=base_url() . 'rol/guardaPermiso'?>" method="POST">

        <input type="hidden" name="id_rol" value="<?=$id_rol?>">
        <?php foreach ($permisos as $permiso) {?>

          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" value="<?=$permiso['id_permiso']?>" name="permisos[]" <?php if(isset($asignado[$permiso['id_permiso']])){ echo 'checked';}?>>
            <label class="form-check-label" for="permiso-check-<?=$permiso['id_permiso']?>"><?=$permiso['nombre']?></label>
          </div>

        <?php }?>

        <button type="submit" class="btn btn-primary">Guardar</button>

      </form>

    </div>
  </main>

  <!-- Modal para confirmar eliminación-->
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
          <a class="btn btn-danger btn-ok">Sí</a>
        </div>
      </div>
    </div>
  </div>