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

          <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modal-insertar-rol" type="button">Insertar</button>
          <a href="<?php echo base_url(); ?>rol/eliminados" class="btn btn-warning">Eliminados</a>
        <?php } ?>
      </div>


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



      <!-- tabla para mostrar los registros de la base de datos -->
      <table id="datatablesSimple" class="table table-striped">
        <thead>
          <tr>
            <th>Nro</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th width="10%">Acción</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($datos as $dato) { ?>
            <tr>
              <td><?php echo $dato['id_rol'] ?></td>
              <td><?php echo $dato['nombre'] ?></td>
              <td><?php echo $dato['descripcion'] ?></td>
              <td>
                  <a href="<?=base_url() . 'rol/detalle/' . $dato['id_rol']?>" class="btn btn-success btn-sm" title="Asignar permisos">
                    <i class="fa-solid fa-edit"></i>
                  </a>

                  <!-- botón para editar el registro -->
                  <button type="button" onclick="editarRol(<?=$dato['id_rol']?>)" class="btn btn-warning btn-sm" title="Editar registro">
                    <i class="fa fa-pencil"></i>
                  </button>

                  <!-- botón para eliminar el registro -->
                  <a href="#" data-href="<?php echo base_url() . 'rol/eliminar/' . $dato['id_rol']; ?>" data-bs-toggle="modal" data-bs-target="#modal-confirma" class="btn btn-danger btn-sm" title="Eliminar Registro">
                    <i class="fa fa-trash"></i>
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

  <!-- Modal para insertar roles -->
  <div class="modal fade" id="modal-insertar-rol" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Insertar Rol</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="<?= base_url() ?>rol/insertar" method="POST">
            <div class="row my-3">
              <div class="col-5">
                <label class="form-label" for="nombre">Nombre</label>
                <input class="form-control" name="nombre" id="nombre" type="text">
              </div>
              <div class="col-7">
                <label class="form-label" for="descripcion">Descripción</label>
                <input class="form-control" name="descripcion" id="descripcion" type="text">
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


    <!-- Modal para editar roles -->
    <div class="modal fade" id="modal-editar-rol" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar Rol</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="<?= base_url() ?>rol/actualizar" method="POST">
            <input type="hidden" id="id_rol" name="id_rol">
            <div class="row my-3">
              <div class="col-5">
                <label class="form-label" for="nombre-edit">Nombre</label>
                <input class="form-control" name="nombre-edit" id="nombre-edit" type="text">
              </div>
              <div class="col-7">
                <label class="form-label" for="descripcion-edit">Descripción</label>
                <input class="form-control" name="descripcion-edit" id="descripcion-edit" type="text">
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

    function editarRol(id_rol) {
            $.ajax({
                url: '<?php echo base_url(); ?>/rol/editar/' + id_rol,
                success: function(resultado) {
                    if (resultado == 0) {
                        //$(tagCodigo).val('');
                    } else {
                        console.log(resultado);
                        var resultado = JSON.parse(resultado);
                        $('#id_rol').val(resultado.datos.id_rol);
                        $('#nombre-edit').val(resultado.datos.nombre);
                        $('#descripcion-edit').val(resultado.datos.descripcion);

                        $('#modal-editar-rol').modal('show');
                    }
                }
            });
    }
  </script>