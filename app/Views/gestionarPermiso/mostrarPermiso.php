<?php
$session = session();
?>

<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h4 class="mt-4"><?php echo $titulo ?></h4>

      <div class="my-3">
        <!-- botones para agregar y ver eliminados -->
        <?php if ($session->id_rol == 1) { ?>

          <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modal-insertar-permiso" type="button">Insertar</button>
          <a href="<?php echo base_url(); ?>rol/eliminados" class="btn btn-warning">Eliminados</a>

        <?php } ?>
      </div>

      <!-- validaciones -->
      <?php
      if (isset($error)) {
        echo "<div id='error-alert' class='alert alert-danger'>
                $error
                </div>";

        echo "

          <script>
            // Mostrar la etiqueta temporal durante 3 segundos
            var etiquetaTemporal = document.getElementById('error-alert');
            etiquetaTemporal.style.display = 'block'; // Mostrar la etiqueta
            setTimeout(function() {
              etiquetaTemporal.style.display = 'none'; // Ocultar la etiqueta después de 3 segundos
            }, 5000); // 000 milisegundos = 3 segundos
          </script>

          ";
      }
      ?>

      
      <div class="d-flex justify-content-end my-3">
        <div class="col-lg-4 col-sm-12">
          <input class="datatable-input" placeholder="Buscar..." type="search" title="Buscar within table" aria-controls="datatablesSimple" id="searchInput">
        </div>
      </div>

      <!-- tabla para mostrar los registros de la base de datos -->
      <table id="editableTable" class="table table-striped table-bordered tabla">
        <thead>
          <tr>
            <th>Nro</th>
            <th style="width: 300px;">Nombre</th>
            <th style="width: 200px;">Tipo</th>
            <th style="width: 200px;">Submodulo</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($permisos as $permiso) { ?>
            <tr>
              <td><?php echo $permiso['id_permiso'] ?></td>
              <td class="editable" data-field="nombre_td"><?php echo $permiso['nombre'] ?></td>
              <td class="editable" data-field="nombre_tipoPermiso"><?= $permiso['nombre_tipoPermiso'] ?></td>
              <td class="editable" data-field="nombre_submodulo"><?= $permiso['nombre_submodulo'] ?></td>

              <td>
                <!-- botón para editar el registro -->
                <button type="button" class="btn btn-warning btn-sm">
                  <i class="fa fa-pencil"></i> Editar
                </button>
              </td>
              <td>
                <!-- botón para eliminar el registro -->
                <a href="#" data-href="<?php echo base_url() . 'permiso/eliminar/' . $permiso['id_permiso']; ?>" data-bs-toggle="modal" data-bs-target="#modal-confirma" class="btn btn-danger btn-sm">
                  <i class="fa fa-trash"></i> Eliminar
                </a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
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

  <!-- Modal para insertar permiso -->
  <div class="modal fade" id="modal-insertar-permiso" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Insertar Permiso</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="<?= base_url() ?>permiso/insertar" method="POST">
            <div class="row my-3">
              <div class="col-4">
                <label class="form-label" for="nombre">Nombre</label>
                <input class="form-control" name="nombre" id="nombre" type="text">
              </div>
              <div class="col-4">
                <label class="form-label" for="id_tipoPermiso">tipo</label>
                <select class="form-control" name="id_tipoPermiso" id="id_tipoPermiso">
                  <?php foreach ($tipoPermisos as $tipoPermiso) { ?>

                    <option value="<?= $tipoPermiso['id_tipoPermiso'] ?>"><?= $tipoPermiso['nombre'] ?></option>

                  <?php } ?>
                </select>
              </div>
              <div class="col-4">
                <label class="form-label" for="id_submodulo">Submodulo</label>
                <select class="form-control" name="id_submodulo" id="id_submodulo">
                  <?php foreach ($submodulos as $submodulo) { ?>

                    <option value="<?= $submodulo['id_submodulo'] ?>"><?= $submodulo['nombre'] ?></option>

                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    const tipoPermisosJSON = <?=json_encode($tipoPermisos)?>;
    const submodulosJSON = <?=json_encode($submodulos)?>;
  </script>

  <script src="<?=base_url()?>js/permiso.js"></script>